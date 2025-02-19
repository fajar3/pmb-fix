<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(StudentRegistration $registration)
    {
        $this->authorize('create', [Payment::class, $registration]);
        $bankAccounts = Setting::where('type', 'bank_account')->get();
        return view('payment.create', compact('registration', 'bankAccounts'));
    }

    public function store(Request $request, StudentRegistration $registration)
    {
        $this->authorize('create', [Payment::class, $registration]);
        
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:online,offline',
            'proof_of_payment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $path = $request->file('proof_of_payment')->store('payment_proofs');

        $payment = $registration->payments()->create([
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'proof_of_payment' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('payment.show', $payment)
            ->with('success', 'Payment submitted successfully');
    }

    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);
        $payment->load('registration');
        return view('payment.show', compact('payment'));
    }
}