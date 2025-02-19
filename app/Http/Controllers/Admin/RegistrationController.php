<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use App\Notifications\RegistrationStatusChanged;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $registrations = StudentRegistration::with('user')
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(StudentRegistration $registration)
    {
        $registration->load(['user', 'documents', 'payments']);
        return view('admin.registrations.show', compact('registration'));
    }

    public function approve(StudentRegistration $registration)
    {
        $registration->update(['status' => 'approved']);
        $registration->user->notify(new RegistrationStatusChanged($registration));
        
        return back()->with('success', 'Registration approved successfully');
    }

    public function reject(StudentRegistration $registration)
    {
        $registration->update(['status' => 'rejected']);
        $registration->user->notify(new RegistrationStatusChanged($registration));
        
        return back()->with('success', 'Registration rejected successfully');
    }
}