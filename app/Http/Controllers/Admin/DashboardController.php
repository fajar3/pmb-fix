<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_registrations' => StudentRegistration::count(),
            'pending_registrations' => StudentRegistration::where('status', 'pending')->count(),
            'total_payments' => Payment::count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $recent_registrations = StudentRegistration::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recent_payments = Payment::with(['registration.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_registrations', 'recent_payments'));
    }
}