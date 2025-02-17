<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminBankController;
use Illuminate\Support\Facades\Route;


// Route Authentication
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);

// Route User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/register', [UserController::class, 'registerForm'])->name('user.registerForm');
    Route::post('/register', [UserController::class, 'register'])->name('user.register');
    Route::get('/payment', [UserController::class, 'payment'])->name('user.payment');
    Route::post('/payment', [UserController::class, 'uploadPayment'])->name('user.uploadPayment');
    Route::get('/settings', function () {
        return view('user.settings');
    })->name('settings');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');

    

});

// Route Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showUsers'])->name('admin.dashboard');
    Route::get('/admin/keuangan', [AdminController::class, 'keuangan'])->name('admin.keuangan');
    Route::get('/admin/pendaftar', [AdminController::class, 'pendaftar'])->name('admin.pendaftar');
    Route::post('/admin/confirm-payment/{id}', [AdminController::class, 'confirmPayment'])->name('admin.confirmPayment');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::delete('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
Route::put('/admin/users/update/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
Route::get('/admin/users/{id}/banned', [AdminController::class, 'banned'])->name('admin.banned');
Route::get('/admin/payments/manage', [AdminController::class, 'managePayments'])->name('admin.managePayments');
Route::post('/admin/payments/store', [AdminController::class, 'storePayment'])->name('admin.payments.store');
Route::get('/admin/paymentsputra', [AdminController::class, 'paymentsPutra'])->name('admin.payments.putra');
Route::get('/admin/paymentsputri', [AdminController::class, 'paymentsPutri'])->name('admin.payments.putri');
Route::get('/admin/bank', [AdminBankController::class, 'index'])->name('admin.bank.index');
Route::post('/admin/bank/putra', [AdminBankController::class, 'storePutra'])->name('admin.bank.putra.store');
Route::put('/admin/bank/putra/{id}', [AdminBankController::class, 'updatePutra'])->name('admin.bank.putra.update');
Route::post('/admin/bank/putri', [AdminBankController::class, 'storePutri'])->name('admin.bank.putri.store');
Route::put('/admin/bank/putri/{id}', [AdminBankController::class, 'updatePutri'])->name('admin.bank.putri.update');
Route::post('/admin/bank/update', [AdminBankController::class, 'updateAll'])->name('admin.bank.update');
Route::get('/admin/pendaftar/{id}', [AdminController::class, 'detailpendaftar'])
    ->name('admin.detailpendaftar');

Route::get('/pendaftar/{id}', [AdminController::class, 'showpendaftar'])
    ->name('pendaftar.show');

    Route::get('/admin/pendaftar/{id}/edit', [AdminController::class, 'editPendaftar'])->name('admin.editPendaftar');
Route::put('/admin/pendaftar/{id}', [AdminController::class, 'updatePendaftar'])->name('admin.updatePendaftar');
Route::get('/admin/payment-details/{userId}/{type}', [AdminController::class, 'paymentDetails'])
    ->name('admin.payment.details');

});
