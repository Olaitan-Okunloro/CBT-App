<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Models\Subscription;
use App\Models\Commission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class BulkPaymentController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->schoolDetail->school_id;

        $students = StudentDetail::where('school_id', $schoolId)
            ->where('has_paid', 0)
            ->with('user')
            ->get();

        return view('school.bulk-payment', compact('students'));
    }

    public function create(Request $request)
    {
        $ids = $request->student_ids ?? [];

        if (count($ids) == 0) {
            return back()->with('error', 'Select students');
        }

        $price = Subscription::first()->sub_amount ?? 0;

        $count = count($ids);

        $amount = $count * $price;

        $reference = 'BULK-' . strtoupper(Str::random(8));

        $bulkId = DB::table('bulk_payments')->insertGetId([
            'school_id' => auth()->user()->schoolDetail->school_id,
            'student_count' => $count,
            'amount' => $amount,
            'reference' => $reference,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($ids as $studentId) {
            DB::table('bulk_payment_students')->insert([
                'bulk_payment_id' => $bulkId,
                'student_id' => $studentId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('bulk.payment.pay', $bulkId);
    }

    public function pay($id)
    {
        $bulk = DB::table('bulk_payments')->where('id', $id)->first();

        if (!$bulk) {
            return back()->with('error', 'Bulk payment not found');
        }

        $user = auth()->user();

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://api.paystack.co/transaction/initialize', [

            'email' => $user->email,
            'amount' => intval($bulk->amount * 100),
            'reference' => $bulk->reference,
            'callback_url' => route('bulk.payment.callback')
        ]);

        $data = $response->json();

        if ($response->successful() && $data['status']) {
            return redirect($data['data']['authorization_url']);
        }

        return back()->with('error', 'Unable to initialize payment');
    }

    public function callback(Request $request)
    {
        $reference = $request->reference;

        $bulk = DB::table('bulk_payments')
            ->where('reference', $reference)
            ->first();

        if (!$bulk) {
            return redirect()->route('bulk.payment')
                ->with('error', 'Payment not found');
        }

        DB::table('bulk_payments')
            ->where('id', $bulk->id)
            ->update([
                'status' => 'success',
                'paid_at' => now(),
                'updated_at' => now()
            ]);

        $students = DB::table('bulk_payment_students')
            ->where('bulk_payment_id', $bulk->id)
            ->pluck('student_id');

        DB::table('student_details')
            ->whereIn('id', $students)
            ->update([
                'has_paid' => 1,
                'payment_reference' => $reference,
                'payment_date' => now(),
                'payment_expiry' => now()->addYear()
            ]);

        foreach ($students as $studentId) {

            $student = StudentDetail::find($studentId);

            if ($student) {
                $this->creditReferralCommission($student, $bulk);
            }
        }

        return redirect()->route('school.dashboard')
            ->with('success', 'Bulk payment successful. Students activated.');
    }

    public function history()
    {
        $schoolId = auth()->user()->schoolDetail->school_id;

        $payments = DB::table('bulk_payments')
            ->where('school_id', $schoolId)
            ->latest()
            ->paginate(10);

        return view('school.bulk-payment-history', compact('payments'));
    }

    public function receipt($id)
    {
        $payment = DB::table('bulk_payments')->where('id', $id)->first();

        if (!$payment) {
            return back()->with('error', 'Receipt not found');
        }

        $pdf = Pdf::loadView('school.bulk-payment-receipt', compact('payment'));

        return $pdf->download('bulk-receipt-' . $payment->reference . '.pdf');
    }

    public function analytics()
    {
        $schoolId = auth()->user()->schoolDetail->school_id;

        $payments = DB::table('bulk_payments')
            ->where('school_id', $schoolId)
            ->where('status', 'success')
            ->get();

        $totalAmount = $payments->sum('amount');
        $totalStudents = $payments->sum('student_count');
        $totalPayments = $payments->count();

        $monthly = DB::table('bulk_payments')
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->where('school_id', $schoolId)
            ->where('status', 'success')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('school.bulk-payment-analytics', compact(
            'totalAmount',
            'totalStudents',
            'totalPayments',
            'monthly'
        ));
    }

    private function creditReferralCommission($student, $bulk)
    {
        $subscription = Subscription::first();

        $mainAmount = $subscription->sub_amount ?? 0;

        $commission = ($mainAmount * 20) / 100;

        $referrerId = null;
        $type = null;

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

        if (!$referrerId) {
            return;
        }

        $wallet = DB::table('wallets')
            ->where('user_id', $referrerId)
            ->first();

        if ($wallet) {

            DB::table('wallets')
                ->where('user_id', $referrerId)
                ->increment('balance', $commission);

        } else {

            DB::table('wallets')->insert([
                'user_id' => $referrerId,
                'balance' => $commission,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        Commission::create([
            'referrer_id' => $referrerId,
            'student_id' => $student->id,
            'payment_id' => $bulk->id,
            'amount' => $commission,
            'type' => $type
        ]);
    }
}