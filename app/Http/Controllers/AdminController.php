<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaymentPutra;
use App\Models\PaymentPutri;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $students = Student::all();
        return view('admin.dashboard', compact('students'));
    }

    public function paymentsPutra()
    {
        $payments_putra = PaymentPutra::all();
        return view('admin.payments_putra', compact('payments_putra'));
    }
    
    public function paymentsPutri()
    {
        $payments_putri = PaymentPutri::all();
        return view('admin.payments_putri', compact('payments_putri'));
    }
    
    public function pendaftar()
    {
        $students = Student::all()->map(function ($student) {
            $payment = null;
            if (!empty($student->user_id)) {
                if ($student->gender == 'Laki-laki') {
                    $payment = PaymentPutra::where('user_id', $student->user_id)->latest()->first();
                } else {
                    $payment = PaymentPutri::where('user_id', $student->user_id)->latest()->first();
                }
            }
    
            // Jika pembayaran ditemukan, periksa statusnya
            $student->payment_status = $payment ? ($payment->status == 'verified' ? 'paid' : 'pending') : 'unpaid';
    
            return $student;
        });
    
        return view('admin.pendaftar', compact('students'));
    }
    

    public function confirmPayment($id)
{
    $payment = PaymentPutra::where('id', $id)->first() ?? PaymentPutri::where('id', $id)->first();

    if (!$payment) {
        return back()->with('error', 'Pembayaran tidak ditemukan.');
    }

    $payment->status = 'verified';
    $payment->save();

    $student = Student::where('user_id', $payment->user_id)->first();
    if ($student) {
        $student->payment_status = 'paid';
        $student->save();
    }

    return back()->with('success', 'Pembayaran dikonfirmasi.');
}

    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function banned($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'banned';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User berhasil dibanned.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'status' => 'required|in:active,banned',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui.');
    }

    public function showUpdatePaymentForm()
    {
        $paymentsPutra = PaymentPutra::all();
        $paymentsPutri = PaymentPutri::all();
        return view('admin.managePayments', compact('paymentsPutra', 'paymentsPutri'));
    }
    
    public function updatePayment(Request $request)
    {
        $request->validate([
            'bank_type' => 'required|string',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'nominal' => 'required|numeric',
            'gender' => 'required|in:Laki-laki,Perempuan'
        ]);

        $model = $request->gender == 'Laki-laki' ? PaymentPutra::class : PaymentPutri::class;

        $model::updateOrCreate(
            [],
            $request->only('bank_type', 'account_name', 'account_number', 'nominal')
        );

        return redirect()->back()->with('success', 'Rekening berhasil diperbarui!');
    }

    public function detailpendaftar($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.detailpendaftar', compact('student'));
    }
    public function editPendaftar($id)
{
    $student = Student::findOrFail($id);
    return view('admin.editpendaftar', compact('student'));
}

public function updatePendaftar(Request $request, $id)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'birth_place' => 'required|string|max:255',
        'birth_date' => 'required|date',
        'citizenship' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'rt' => 'required|integer',
        'rw' => 'required|integer',
        'dusun' => 'nullable|string|max:255',
        'kelurahan' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kabupaten' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'father_birth_year' => 'required|integer',
        'father_status' => 'required|string|max:255',
        'father_education' => 'required|string|max:255',
        'father_job' => 'required|string|max:255',
        'father_phone' => 'required|string|max:15',
        'mother_name' => 'required|string|max:255',
        'mother_birth_year' => 'required|integer',
        'mother_status' => 'required|string|max:255',
        'mother_education' => 'required|string|max:255',
        'mother_job' => 'required|string|max:255',
        'mother_phone' => 'required|string|max:15',
        'guardian_name' => 'nullable|string|max:255',
        'guardian_birth_year' => 'nullable|integer',
        'guardian_status' => 'nullable|string|max:255',
        'guardian_education' => 'nullable|string|max:255',
        'guardian_job' => 'nullable|string|max:255',
        'guardian_phone' => 'nullable|string|max:15',
    ]);

    $student = Student::findOrFail($id);
    $student->update($request->all());

    return redirect()->route('admin.detailpendaftar', $id)->with('success', 'Data berhasil diperbarui!');
}

}
