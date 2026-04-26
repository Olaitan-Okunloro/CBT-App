<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentDetail;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Commission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    /**
     * Show the payment page
     */

    public function showPaymentPage()
    {
        $user = Auth::user();

        $sub = Subscription::first();

        $type = session('payment_type', 'main');

        if ($type == 'email_subscription') {

            $amount = $sub->email_sub ?? 0;
            $title  = 'Email Notification Subscription';

        } else {

            $amount = $sub->sub_amount ?? 200;
            $title  = 'Main Registration Subscription';
        }

        if (
            $user->studentDetail &&
            $user->studentDetail->has_paid &&
            $type != 'email_subscription'
        ) {
            return redirect()->route('dashboard')
                ->with('info', 'Your payment is already completed.');
        }

        return view('payment.index', compact(
            'user',
            'amount',
            'title'
        ));
    }

    public function initialize(Request $request)
    {
        try {

            $user = Auth::user();

            $sub = Subscription::first();

            $type = session('payment_type', 'main');

            // Determine amount
            if ($type == 'email_subscription') {
                $amount = $sub->email_sub ?? 0;
            } else {
                $amount = $sub->sub_amount ?? 200;
            }

            // Prevent duplicate MAIN payment only
            if (
                $user->studentDetail &&
                $user->studentDetail->has_paid &&
                $type != 'email_subscription'
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Main subscription already completed.'
                ], 400);
            }

            // Prevent duplicate EMAIL payment
            if (
                $user->studentDetail &&
                $user->studentDetail->email_sub == 1 &&
                $type == 'email_subscription'
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email subscription already active.'
                ], 400);
            }

            $reference = 'PAY-' . Str::random(8) . '-' . time();

            Payment::where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();

            $payment = Payment::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'reference' => $reference,
                'status' => 'pending',
                'payment_method' => 'Paystack',
                'metadata' => json_encode([
                    'payment_type' => $type
                ])
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.paystack.co/transaction/initialize', [
                'email' => $user->email,
                'amount' => intval($amount * 100),
                'reference' => $reference,
                'callback_url' => route('payment.callback'),
                'metadata' => [
                    'user_id' => $user->id,
                    'payment_id' => $payment->id,
                    'payment_type' => $type
                ]
            ]);

            $data = $response->json();

            if ($response->successful() && $data['status']) {

                return response()->json([
                    'success' => true,
                    'authorization_url' => $data['data']['authorization_url']
                ]);
            }

            $payment->update(['status' => 'failed']);

            return response()->json([
                'success' => false,
                'message' => $data['message'] ?? 'Payment initialization failed'
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function initializePaystackPayment($amount, $user)
    {
        $reference = 'PAY-' . \Illuminate\Support\Str::random(8) . '-' . time();

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
            'Content-Type' => 'application/json'
        ])->post('https://api.paystack.co/transaction/initialize', [
            'email' => $user->email,
            'amount' => $amount * 100, // Paystack uses kobo
            'reference' => $reference,
            'callback_url' => route('payment.callback')
        ]);

        if (!$response->successful()) {
            \Log::error('Paystack initialization failed', [
                'response' => $response->body()
            ]);

            return back()->with('error', 'Unable to initialize payment');
        }

        return $response->json();
    }

    /**
     * Handle Paystack callback
     */
    public function callback(Request $request)
    {
        $reference = $request->reference;
        
        \Log::info('Callback received for reference: ' . $reference);

        try {
            // Find the payment record
            $payment = Payment::where('reference', $reference)->first();
            
            if (!$payment) {
                \Log::error('Payment not found for reference: ' . $reference);
                return redirect()->route('payment.cancel')
                    ->with('error', 'Payment record not found');
            }

            if ($payment->status === 'success') {
                return redirect()->route('dashboard')
                    ->with('info', 'Payment already verified.');
            }

            // Verify with Paystack
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            ])->get('https://api.paystack.co/transaction/verify/' . $reference);

            $responseData = $response->json();

            if ($response->successful() && $responseData['data']['status'] === 'success') {

                $payment->update([
                    'status' => 'success',
                    'transaction_id' => $responseData['data']['id'],
                    'paid_at' => now()
                ]);

                $user = $payment->user;

                $user->update([
                    'is_active' => true
                ]);

                $student = $user->studentDetail;

                $meta = json_decode($payment->metadata, true);

                $type = $meta['payment_type']
                    ?? session('payment_type')
                    ?? 'main';

                if ($student) {

                    if ($type == 'email_subscription') {

                        $student->update([
                            'email_sub' => 1
                        ]);

                    } else {

                        $student->update([
                            'has_paid' => 1,
                            'payment_reference' => $reference,
                            'payment_date' => now(),
                            'payment_expiry' => now()->addYear()
                        ]);

                        $this->creditReferralCommission($student, $payment);
                    }
                }

                session()->forget('payment_type');

                return redirect()->route('payment.success')
                    ->with('success', 'Payment successful!')
                    ->with('reference', $reference);
            } else {
                $payment->update(['status' => 'failed']);
                return redirect()->route('payment.cancel')
                    ->with('error', 'Payment verification failed');
            }

        } catch (\Exception $e) {
            \Log::error('Callback error: ' . $e->getMessage());
            return redirect()->route('payment.cancel')
                ->with('error', 'An error occurred');
        }
    }

    /**
     * Payment success page
     */
    public function success()
    {
        return view('payment.success');
    }

    /**
     * Payment cancel page
     */
    public function cancel()
    {
        return view('payment.cancel');
    }

    /**
     * Paystack webhook (for handling payment events)
     */
    public function webhook(Request $request)
    {
        $signature = $request->header('x-paystack-signature');
        $payload = $request->getContent();

        // Verify webhook signature
        $computedSignature = hash_hmac(
            'sha512',
            $payload,
            env('PAYSTACK_SECRET_KEY')
        );

        if ($signature !== $computedSignature) {

            \Log::warning('Invalid Paystack webhook signature.');

            \Log::info('Paystack Webhook Received', [
                'event' => $request->input('event')
            ]);

            return response()->json([
                'status' => 'invalid signature'
            ], 400);
        }

        $event = $request->input('event');
        $data = $request->input('data');

        \Log::info('Paystack Webhook Event: ' . $event);

        if ($event === 'charge.success') {

            $reference = $data['reference'];

            $payment = Payment::where('reference', $reference)->first();

            if (!$payment) {
                \Log::error('Webhook payment not found: ' . $reference);
                return response()->json(['status' => 'error'], 404);
            }

            if ($payment->status === 'success') {
                return response()->json(['status' => 'already processed']);
            }

            DB::transaction(function () use ($payment, $data) {

                $payment->update([
                    'status' => 'success',
                    'transaction_id' => $data['id'],
                    'paid_at' => now()
                ]);

                $this->creditReferralCommission($user->studentDetail, $payment);

                $user = $payment->user;

                $user->update([
                    'is_active' => true
                ]);

                if ($user->studentDetail) {
                    $meta = json_decode($payment->metadata, true);

                    $type = $meta['payment_type'] ?? 'main';

                    if ($type == 'email_subscription') {

                        $user->studentDetail->update([
                            'email_sub' => 1
                        ]);

                    } else {

                        $user->studentDetail->update([
                            'has_paid' => 1,
                            'payment_reference' => $payment->reference,
                            'payment_date' => now(),
                            'payment_expiry' => now()->addYear()
                        ]);
                    }
                }
            });
        }

        return response()->json(['status' => 'success']);
    }

    public function downloadReceipt($reference)
    {
        $payment = Payment::where('reference',$reference)->firstOrFail();

        $pdf = Pdf::loadView('payment.receipt',[
            'payment'=>$payment
        ]);

        return $pdf->download('receipt-'.$reference.'.pdf');
    }

    public function emailToggle()
    {
        $student = auth()->user()->studentDetail;

        if (!$student) {
            return back()->with('error', 'Student record not found');
        }

        if ($student->email_sub == 1) {

            $student->update([
                'email_sub' => 0
            ]);

            return back()->with('success', 'Email subscription disabled');
        }

        session([
            'payment_type' => 'email_subscription'
        ]);

        return redirect('/payment');
    }


    public function emailActivate()
    {
        session(['payment_type' => 'email_subscription']);

        return redirect('/payment');
    }

        public function emailDisable()
        {
            auth()->user()->studentDetail->update([
                'email_sub' => 0
            ]);

            return back()->with('success', 'Email subscription disabled');
        }

    private function creditReferralCommission($student, $payment)
    {
        $sub = \App\Models\Subscription::first();

        $mainAmount = $sub->sub_amount ?? 0;

        $commission = ($mainAmount * 20) / 100;

        $referrerId = null;

        $type = null;

        // Direct student referral
        if (!empty($student->referral_user_id)) {

            $referrerId = $student->referral_user_id;
            $type = 'student';

        } elseif ($student->school_id) {

            $school = \App\Models\School::find($student->school_id);

            if ($school && !empty($school->referral_user_id)) {

                $referrerId = $school->referral_user_id;
                $type = 'school';
            }
        }

        if ($referrerId) {

            \Illuminate\Support\Facades\DB::table('wallets')
                ->where('user_id', $referrerId)
                ->increment('balance', $commission);

            \App\Models\Commission::create([
                'referrer_id' => $referrerId,
                'student_id' => $student->id,
                'payment_id' => $payment->id,
                'amount' => $commission,
                'type' => $type
            ]);
        }
    }

    public function schoolFees()
    {
        $student = DB::table('student_details')
            ->where('user_id', auth()->id())
            ->first();

        $fee = DB::table('school_fees')
            ->where('class_id', $student->class_id)
            ->latest()
            ->first();

        $totalFee =
            ($fee->tuition ?? 0) +
            ($fee->uniforms ?? 0) +
            ($fee->sports_wear ?? 0) +
            ($fee->books ?? 0) +
            ($fee->exam_fee ?? 0) +
            ($fee->pta_levy ?? 0) +
            ($fee->other_fee ?? 0);

        $paid = DB::table('school_fee_payments')
            ->where('student_id', $student->user_id)
            ->where('status', 'confirmed')
            ->sum('amount');

        $balance = $totalFee - $paid;

        return view('student.school-fees', compact(
            'student',
            'totalFee',
            'paid',
            'balance'
        ));
    }

    public function submitSchoolFees(Request $request)
    {
        $student = DB::table('student_details')
            ->where('user_id', auth()->id())
            ->first();

        $proof = null;

        if ($request->hasFile('proof')) {

            $file = $request->file('proof');

            $proof = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('storage/fees'), $proof);
        }

        DB::table('school_fee_payments')->insert([
            'student_id' => $student->user_id,
            'school_id' => $student->school_id,
            'class_id' => $student->class_id,
            'amount' => $request->amount,
            'reference_no' => $request->reference_no,
            'payment_date' => $request->payment_date,
            'proof' => $proof,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Payment submitted successfully');
    }

    public function feesReceipt($id)
    {
        $row = DB::table('school_fee_payments')
            ->join(
                'student_details',
                'school_fee_payments.student_id',
                '=',
                'student_details.user_id'
            )
            ->join(
                'users',
                'student_details.user_id',
                '=',
                'users.id'
            )
            ->join(
                'schools',
                'school_fee_payments.school_id',
                '=',
                'schools.id'
            )
            ->select(
                'school_fee_payments.*',
                'users.name',
                'student_details.registration_number',
                'schools.name as school_name'
            )
            ->where('school_fee_payments.id', $id)
            ->first();

        if (!$row) {
            return back()->with('error', 'Receipt not found');
        }

        return view('student.fees-receipt', compact('row'));
    }

    public function feesHistory()
    {
        $student = DB::table('student_details')
            ->where('user_id', auth()->id())
            ->first();

        $rows = DB::table('school_fee_payments')
            ->where('student_id', $student->user_id)
            ->latest()
            ->paginate(10);

        return view('student.fees-history', compact('rows'));
    }

    public function financeDashboard()
    {
        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();

        $confirmed = DB::table('school_fee_payments')
            ->where('school_id', $school->school_id)
            ->where('status', 'confirmed')
            ->sum('amount');

        $studentsPaid = DB::table('school_fee_payments')
            ->where('school_id', $school->school_id)
            ->where('status', 'confirmed')
            ->distinct('student_id')
            ->count('student_id');

        $totalStudents = DB::table('student_details')
            ->where('school_id', $school->school_id)
            ->count();

        $totalDebt = 0;

        $students = DB::table('student_details')
            ->where('school_id', $school->school_id)
            ->get();

        foreach ($students as $student) {

            $fee = DB::table('school_fees')
                ->where('school_id', $school->school_id)
                ->where('class_id', $student->class_id)
                ->latest()
                ->first();

                if ($fee) {

                    $expected =
                        ($fee->tuition ?? 0) +
                        ($fee->uniforms ?? 0) +
                        ($fee->sports_wear ?? 0) +
                        ($fee->books ?? 0) +
                        ($fee->exam_fee ?? 0) +
                        ($fee->pta_levy ?? 0) +
                        ($fee->other_fee ?? 0);

                    $paid = DB::table('school_fee_payments')
                        ->where('student_id', $student->school_id)
                        ->where('status', 'confirmed')
                        ->sum('amount');

                    $balance = $expected - $paid;

                    if ($balance > 0) {
                        $totalDebt += $balance;
                    }
                }
            }

        $monthly = DB::table('school_fee_payments')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as month_key,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('school_id', $school->school_id)
            ->where('status', 'confirmed')
            ->groupByRaw("
                DATE_FORMAT(created_at, '%Y-%m'),
                DATE_FORMAT(created_at, '%b')
            ")
            ->orderBy('month_key')
            ->get();

        return view('school.finance-dashboard', compact(
            'confirmed',
            'studentsPaid',
            'totalStudents',
            'totalDebt',
            'monthly'
        ));
    }
}