<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Notifications\PaymentStatusChanged;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['registration.user'])
            ->latest()
            ->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['registration.user']);
        return view('admin.payments.show', compact('payment'));
    }

    public function verify(Payment $payment)
    {
        $payment->update(['status' => 'verified']);
        $payment->registration->user->notify(new PaymentStatusChanged($payment));
        
        return back()->with('success', 'Payment verified successfully');
    }

    public function reject(Payment $payment)
    {
        $payment->update(['status' => 'rejected']);
        $payment->registration->user->notify(new PaymentStatusChanged($payment));
        
        return back()->with('success', 'Payment rejected successfully');
    }
}