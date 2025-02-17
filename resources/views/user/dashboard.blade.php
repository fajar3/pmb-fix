@extends('user.db')

@section('db')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Status Card -->
        <div class="dashboard-card">
            <h3 class="text-center mb-4">Status Pendaftaran</h3>
            @if($student && $student->form_status)
                <p class="text-success text-center">✅ Formulir sudah diisi.</p>
                        @else
                <p class="text-danger text-center">Silahkan Mengisi Formulir Terlebih Dahulu</p>
                <a href="{{ route('user.registerForm') }}" class="btn btn-warning w-100">Isi Formulir</a>
            @endif
        </div>

        <!-- Payment Section -->
        <div class="payment-details">
            <div class="payment-header">
                <h2>Rincian Biaya Pendaftaran</h2>
                <p>Pondok Pesantren Assalam - Tahun Pelajaran 2024/2025</p>
            </div>
            
            <!-- Biaya Bulanan -->
            <h3>Biaya Perbulan</h3>
            <table class="payment-table">
                <tr>
                    <td>Syariah Pondok + Tabungan Wajib</td>
                    <td>Rp 80.000</td>
                </tr>
                <tr>
                    <td>Syariah Madrasah Diniyah</td>
                    <td>Rp 30.000</td>
                </tr>
                <tr>
                    <td>Kos Makan 2x Sehari</td>
                    <td>Rp 280.000</td>
                </tr>
                <tr>
                    <td>Kos Makan 3x Sehari</td>
                    <td>Rp 400.000</td>
                </tr>
            </table>

            <!-- Total Keseluruhan -->
            <div class="payment-total">
                Total Keseluruhan: Rp 985.000
            </div>
        </div>
        <!-- Account Settings -->
        
</div>
@endsection