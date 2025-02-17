@extends('user.db')

@section('db')
<div class="container">
    <div class="card payment-container">
        <div class="card-body">
            <h3 class="text-center mb-4 gg">📌 Informasi Pembayaran</h3>

            @if($student && $bankDetails)
                <div class="rekening-box mb-4">
                    <h5>Rekening Pembayaran ({{ $student->gender }})</h5>
                    
                    <label>Bank</label>
                    <input type="text" class="form-control" value="{{ $bankDetails->bank_type ?? 'Bank Tidak Ditemukan' }}" readonly>

                    <label>Nama Rekening</label>
                    <input type="text" class="form-control" value="{{ $bankDetails->account_name ?? 'Nama Rekening Tidak Ditemukan' }}" readonly>

                    <label>Nomor Rekening</label>
                    <input type="text" class="form-control" value="{{ $bankDetails->account_number ?? 'No. Rekening Tidak Ditemukan' }}" readonly>
                </div>

                <!-- Tombol Tambah Pembayaran Baru -->
                <button type="button" class="btn btn-primary w-100 mb-4" data-bs-toggle="modal" data-bs-target="#paymentModal">
                    💰 Tambah Pembayaran Baru
                </button>
                @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

                <!-- Riwayat Pembayaran -->
                <div class="payment-history mb-4">
                    <h5>Riwayat Pembayaran</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                <tr>
                                    <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        @if($payment->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($payment->status == 'verified')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $payment->proof) }}" target="_blank" class="btn btn-sm btn-info">
                                            📄 Lihat Bukti
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada pembayaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Form Pembayaran -->
                <div class="modal fade" id="paymentModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Form Pembayaran Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.uploadPayment') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Nama Rekening</label>
                                        <input type="text" name="account_name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Bank</label>
                                        <input type="text" name="bank_type" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Pembayaran</label>
                                        <input type="text" name="payment_number" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nominal Pembayaran</label>
                                        <input type="number" name="nominal" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Upload Bukti Pembayaran</label>
                                        <input type="file" name="proof" class="form-control" required>
                                        <img id="previewImage" class="mt-2 preview-image">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">📤 Upload Pembayaran</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-danger">Data rekening belum tersedia.</p>
            @endif
        </div>
    </div>
</div>

<script>
document.querySelector('input[name="proof"]').addEventListener('change', function(event) {
    let reader = new FileReader();
    reader.onload = function(e) {
        let preview = document.getElementById('previewImage');
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>

<style>
.preview-image {
    max-width: 100%;
    height: 200px;
    object-fit: contain;
    display: none;
}

.payment-container {
    max-width: 800px;
    margin: 20px auto;
}

.table {
    background: white;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5em 1em;
}
</style>
@endsection