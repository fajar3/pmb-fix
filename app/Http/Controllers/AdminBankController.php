<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminBankPutra;
use App\Models\AdminBankPutri;

class AdminBankController extends Controller
{
    public function index()
    {
        $bankPutra = AdminBankPutra::first();
        $bankPutri = AdminBankPutri::first();

        return view('admin.bank', compact('bankPutra', 'bankPutri'));
    }

    public function updateAll(Request $request)
    {
        $request->validate([
            'bank_type_putra' => 'required|string',
            'account_name_putra' => 'required|string',
            'account_number_putra' => 'required|string',
            'nominal_putra' => 'required|numeric|min:0',

            'bank_type_putri' => 'required|string',
            'account_name_putri' => 'required|string',
            'account_number_putri' => 'required|string',
            'nominal_putri' => 'required|numeric|min:0',
        ]);

        // Simpan atau update rekening Putra
        AdminBankPutra::updateOrCreate(
            ['id' => 1], // Sesuaikan ID jika ada
            [
                'bank_type' => $request->bank_type_putra,
                'account_name' => $request->account_name_putra,
                'account_number' => $request->account_number_putra,
                'nominal' => $request->nominal_putra,
            ]
        );

        // Simpan atau update rekening Putri
        AdminBankPutri::updateOrCreate(
            ['id' => 1], // Sesuaikan ID jika ada
            [
                'bank_type' => $request->bank_type_putri,
                'account_name' => $request->account_name_putri,
                'account_number' => $request->account_number_putri,
                'nominal' => $request->nominal_putri,
            ]
        );

        return redirect()->route('admin.bank.index')->with('success', 'Data rekening berhasil diperbarui.');
    }
}
