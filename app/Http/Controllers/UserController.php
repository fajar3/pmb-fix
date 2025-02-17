<?php

namespace App\Http\Controllers;
use App\Models\PaymentPutra;
use App\Models\PaymentPutri;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        // Menambahkan pesan notifikasi sukses
        return redirect()->back()->with('success', 'Akun berhasil diperbarui.');
    }
    


    public function dashboard()
    {
        $user = Auth::user();
        $student = $user->student;

        return view('user.dashboard', compact('student'));
    }

    public function registerForm()
    {
        // Cek apakah user sudah mengisi formulir
        if (Auth::user()->student) {
            return redirect()->route('user.dashboard')->with('warning', 'Anda sudah mengisi formulir.');
        }

        return view('user.register');
    }

    public function register(Request $request)
    {
        $user = Auth::user();
    
        // Cek apakah user sudah memiliki data student
        if ($user->student) {
            return redirect()->route('user.dashboard')->with('error', 'Anda sudah mengisi formulir.');
        }
    
        // Validasi input
        $request->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'citizenship' => 'required',
            'address' => 'required',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'dusun' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'father_name' => 'required',
            'father_birth_year' => 'required|integer|min:1900|max:2099',
            'father_status' => 'required',
            'father_education' => 'required',
            'father_job' => 'required',
            'father_phone' => 'required',
            'mother_name' => 'required',
            'mother_birth_year' => 'required|integer|min:1900|max:2099',
            'mother_status' => 'required',
            'mother_education' => 'required',
            'mother_job' => 'required',
            'mother_phone' => 'required',
            'guardian_name' => 'nullable',
            'guardian_birth_year' => 'nullable|integer|min:1900|max:2099',
            'guardian_status' => 'nullable',
            'guardian_education' => 'nullable',
            'guardian_job' => 'nullable',
            'guardian_phone' => 'nullable',
            'agreement_lillah' => 'nullable',
            'agreement_parent' => 'nullable',
            'agreement_rules' => 'nullable',
            'agreement_administration' => 'nullable',
            'agreement_no_return' => 'nullable',
        ]);
    
        // Buat objek Student baru
        $student = new Student();
        $student->fill($request->all());
        $student->user_id = $user->id;
        $student->form_status = 1; // ✅ Simpan form_status dengan benar
    
        // Proses file Kartu Keluarga (KK)
        if ($request->hasFile('kk_copy')) {
            $file = $request->file('kk_copy');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/kk', $filename, 'public');
            $student->kk_copy = $path;
        }
    
        // Proses file Akta Kelahiran
        if ($request->hasFile('birth_certificate_copy')) {
            $file = $request->file('birth_certificate_copy');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/birth_certificates', $filename, 'public');
            $student->birth_certificate_copy = $path;
        }
    
        // Simpan data student
        $student->save();
    
        return redirect()->route('user.payment')->with('success', 'Pendaftaran berhasil. Silakan lakukan pembayaran.');
    }
    
    public function payment()
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
        return back()->with('error', 'Data siswa tidak ditemukan.');
    }

    // Get all payments for the student based on gender
    $payments = ($student->gender == 'Laki-laki') 
        ? PaymentPutra::where('user_id', $user->id)->orderBy('created_at', 'desc')->get()
        : PaymentPutri::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

    // Get bank details based on gender
    $bankDetails = ($student->gender == 'Laki-laki')
        ? \App\Models\AdminBankPutra::first()
        : \App\Models\AdminBankPutri::first();

    return view('user.payment', compact('payments', 'bankDetails', 'student'));
}
    
public function uploadPayment(Request $request)
{
    $request->validate([
        'bank_type' => 'required',
        'account_name' => 'required',
        'payment_number' => 'required|unique:payments_putra,payment_number|unique:payments_putri,payment_number',
        'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'nominal' => 'required|numeric|min:1',
        'description' => 'nullable',
    ]);

    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
        return back()->with('error', 'Data siswa tidak ditemukan.');
    }

    if ($request->hasFile('proof')) {
        $file = $request->file('proof');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('payments', $filename, 'public');
    } else {
        return back()->with('error', 'Bukti pembayaran wajib diunggah.');
    }

    $paymentData = [
        'user_id' => $user->id,
        'bank_type' => $request->bank_type,
        'account_name' => $request->account_name,
        'payment_number' => $request->payment_number,
        'proof' => $filePath,
        'description' => $request->description,
        'status' => 'pending',
        'nominal' => $request->nominal,
    ];

    DB::beginTransaction();
    try {
        if ($student->gender == 'Laki-laki') {
            PaymentPutra::create($paymentData);
        } else {
            PaymentPutri::create($paymentData);
        }
        DB::commit();
        return redirect()->route('user.payment')->with('success', 'Bukti pembayaran berhasil diunggah.');
    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Payment upload error: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan saat mengunggah pembayaran. Silakan coba lagi.');
    }
}}
