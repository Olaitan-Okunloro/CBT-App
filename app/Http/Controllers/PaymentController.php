<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentDetail;
use App\Models\Subscription;
use App\Models\User;
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

        $main_sub = Subscription::first();

        if ($user->studentDetail && $user->studentDetail->has_paid) {
            return redirect()->route('dashboard')
                ->with('info', 'Your payment is already completed.');
        }

        return view('payment.index', [
            'user' => $user,
            'publicKey' => config('paystack.publicKey'),
            'amount' => $main_sub->sub_amount ?? 200,
            'email' => $user->email,
            'main_sub' => $main_sub
        ]);
    }

    public function initialize(Request $request)
    {
        // Log the start of initialization
        \Log::info('========== INITIALIZE METHOD CALLED ==========');
        \Log::info('Request data:', $request->all());
        
        $user = Auth::user();
        \Log::info('User:', ['id' => $user->id, 'email' => $user->email]);

        // 🔒 Prevent duplicate payment
        if ($user->studentDetail && $user->studentDetail->has_paid) {
            return response()->json([
                'success' => false,
                'message' => 'You have already completed your registration payment.'
            ], 400);
        }

        // Check if a pending payment already exists
        $existingPayment = Payment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingPayment) {

            return response()->json([
                'success' => true,
                'authorization_url' => $this->initializePaystackPayment($user, $existingPayment->reference, $request->amount)
            ]);
        }

        try {
            // Generate reference
            $reference = 'PAY-' . Str::random(8) . '-' . time();
            \Log::info('Generated reference:', ['reference' => $reference]);

            // ATTEMPT TO CREATE PAYMENT RECORD
            \Log::info('Attempting to create payment record...');
            
            $paymentData = [
                'user_id' => $user->id,
                'amount' => $request->amount,
                'reference' => $reference,
                'status' => 'pending',
                'payment_method' => 'Paystack',
                'metadata' => json_encode(['init_time' => now()->toDateTimeString()])
            ];
            
            \Log::info('Payment data:', $paymentData);
            
            $payment = Payment::create($paymentData);
            
            \Log::info('✓ PAYMENT RECORD CREATED:', [
                'id' => $payment->id,
                'reference' => $payment->reference
            ]);
        
        // Call Paystack API
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                    'Content-Type' => 'application/json',
                ])->post('https://api.paystack.co/transaction/initialize', [
                    'email' => $user->email,
                    'amount' => intval($request->amount * 100),
                    'reference' => $reference,
                    'callback_url' => route('payment.callback'),
                    'metadata' => [
                        'user_id' => $user->id,
                        'payment_id' => $payment->id
                    ]
                ]);

                $responseData = $response->json();

                if ($response->successful() && $responseData['status']) {
                    return response()->json([
                        'success' => true,
                        'authorization_url' => $responseData['data']['authorization_url'],
                        'reference' => $reference
                    ]);
                } else {
                    $payment->update(['status' => 'failed']);
                    return response()->json([
                        'success' => false,
                        'message' => $responseData['message'] ?? 'Payment initialization failed'
                    ], 422);
                }
            
        } catch (\Exception $e) {
            \Log::error('✗ ERROR in initialize:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
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
                
                // Update payment record
                $payment->update([
                    'status' => 'success',
                    'transaction_id' => $responseData['data']['id'],
                    'paid_at' => now()
                ]);

                // Update user and student details
                $user = $payment->user;
                $user->update(['is_active' => true]);
                
                
                if ($user->studentDetail) {
                    $user->studentDetail->update([
                        'has_paid' => true,
                        'payment_reference' => $reference,
                        'payment_date' => now(),
                        'payment_expiry' => now()->addYear()
                    ]);
                }

                return redirect()->route('payment.success')
                    ->with('success', 'Payment successful!')
                    ->with('reference',$reference);
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

                $user = $payment->user;

                $user->update([
                    'is_active' => true
                ]);

                if ($user->studentDetail) {

                    $user->studentDetail->update([
                        'has_paid' => true,
                        'payment_reference' => $payment->reference,
                        'payment_date' => now(),
                        'payment_expiry' => now()->addYear()
                    ]);
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

        if ($student->email_sub == 1) {

            $student->update([
                'email_sub' => 0
            ]);

            return back()->with('success', 'Email subscription disabled');
        }

        session([
            'payment_type' => 'email_subscription'
        ]);

        return redirect()->route('payment.show');
    }
}