{{-- admin/payment_details.blade.php --}}
@extends('admin.dashboard')

@section('admin-content')
<div class="data-container">
    <div class="header-section">
        <h2 class="page-title">Detail Pembayaran - {{ $user->name }}</h2>
        <a href="{{ route('admin.payments.' . $type) }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Rekening</th>
                    <th>Nama Rekening</th>
                    <th>Nomor Rekening</th>
                    <th>Nomor Pembayaran</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $key => $payment)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                    <td>{{ $payment->bank_type }}</td>
                    <td>{{ $payment->account_name }}</td>
                    <td>{{ $payment->account_number }}</td>
                    <td>{{ $payment->payment_number }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $payment->proof) }}" target="_blank">Lihat Bukti</a>
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower($payment->status) }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>
                        @if($payment->status == 'pending')
                            <form action="{{ route('admin.confirmPayment', $payment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action">Verifikasi</button>
                            </form>
                        @else
                            <span class="text-success">Terverifikasi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection