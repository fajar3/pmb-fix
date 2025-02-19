<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    UserController,
    PaymentController,
    RegistrationController as AdminRegistrationController,
    SettingController
};
use App\Http\Controllers\{
    AuthController,
    HomeController,
    RegistrationController,
    PaymentController as UserPaymentController,
    ProfileController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// User routes
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::prefix('registration')->name('registration.')->group(function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('index');
        Route::get('/create', [RegistrationController::class, 'create'])->name('create');
        Route::post('/store', [RegistrationController::class, 'store'])->name('store');
        Route::get('/{registration}', [RegistrationController::class, 'show'])->name('show');
    });

    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/{registration}/create', [UserPaymentController::class, 'create'])->name('create');
        Route::post('/{registration}/store', [UserPaymentController::class, 'store'])->name('store');
        Route::get('/{payment}', [UserPaymentController::class, 'show'])->name('show');
        Route::post('/{payment}/upload-proof', [UserPaymentController::class, 'uploadProof'])->name('upload-proof');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });
});

// Admin routes
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('registrations', AdminRegistrationController::class);
    Route::post('/registrations/{registration}/approve', [AdminRegistrationController::class, 'approve'])
        ->name('registrations.approve');
    Route::post('/registrations/{registration}/reject', [AdminRegistrationController::class, 'reject'])
        ->name('registrations.reject');
    Route::resource('payments', PaymentController::class);
});
