@extends('admin.dashboard')

@section('admin-content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.bank.update') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Rekening Bank Putra -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Rekening Bank Putra</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="bank_type_putra" class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" name="bank_type_putra" 
                                value="{{ old('bank_type_putra', $bankPutra->bank_type ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="account_name_putra" class="form-label">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" name="account_name_putra" 
                                value="{{ old('account_name_putra', $bankPutra->account_name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="account_number_putra" class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control" name="account_number_putra" 
                                value="{{ old('account_number_putra', $bankPutra->account_number ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nominal_putra" class="form-label">Nominal</label>
                            <input type="number" class="form-control" name="nominal_putra" 
                                value="{{ old('nominal_putra', $bankPutra->nominal ?? 0) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekening Bank Putri -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Rekening Bank Putri</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="bank_type_putri" class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" name="bank_type_putri" 
                                value="{{ old('bank_type_putri', $bankPutri->bank_type ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="account_name_putri" class="form-label">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" name="account_name_putri" 
                                value="{{ old('account_name_putri', $bankPutri->account_name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="account_number_putri" class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control" name="account_number_putri" 
                                value="{{ old('account_number_putri', $bankPutri->account_number ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nominal_putri" class="form-label">Nominal</label>
                            <input type="number" class="form-control" name="nominal_putri" 
                                value="{{ old('nominal_putri', $bankPutri->nominal ?? 0) }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Simpan Semua</button>
        </div>
    </form>
</div>
@endsection
