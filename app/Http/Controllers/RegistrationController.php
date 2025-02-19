<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registration = auth()->user()->registrations()->latest()->first();
        return view('registration.index', compact('registration'));
    }

    // Create and Store methods were provided in the previous message

    public function show(StudentRegistration $registration)
    {
        $this->authorize('view', $registration);
        $registration->load(['documents', 'payments']);
        return view('registration.show', compact('registration'));
    }
}