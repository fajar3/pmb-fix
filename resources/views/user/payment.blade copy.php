<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Times New Roman', sans-serif;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(191, 255, 222, 0.6), rgba(0, 0, 0, 0.6)),
    url("../img/8270280.jpg") no-repeat center/cover;
}

.form-label{
    color:white;
}

        .payment-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(150, 150, 150, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
        }
        .bank-info {
            background: rgb(255, 255, 255);
            padding: 15px;
            border-radius: 10px;
        }
        .preview-image {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            display: none;
        }
        .slip .form-label{
            color: black;
        }
        .slip{
            width: 100%;
            height: 200px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background:rgb(255, 255, 255);
            cursor: pointer;
        }
        .card-body .gg{
            color: white;
        }
        .btn{
            background:rgb(0, 192, 93);
            border: none;
        }
        .btn:hover{
            background:rgb(187, 255, 220);
        }
        
    </style>
</head>
<body>

<div class="container">
    <div class="card payment-container">
        <div class="card-body">
            <h3 class="text-center mb-4 gg">📌 Informasi Pembayaran</h3>
            @php
    $user = Auth::user();
    $student = \App\Models\Student::where('user_id', $user->id)->first();
    $payment = null;
    $bankDetails = null;

    if ($student) {
        if ($student->gender == 'Laki-laki') {
            $payment = \App\Models\PaymentPutra::where('user_id', $user->id)->latest()->first();
            $bankDetails = \App\Models\AdminBankPutra::first();
        } else {
            $payment = \App\Models\PaymentPutri::where('user_id', $user->id)->latest()->first();
            $bankDetails = \App\Models\AdminBankPutri::first();
        }
    }
@endphp

@if($student && $bankDetails)
    <div class="rekening-box">
        <h5>Rekening Pembayaran ({{ $student->gender }})</h5>
        
        <label>Bank</label>
        <input type="text" class="form-control" value="{{ $bankDetails->bank_type ?? 'Bank Tidak Ditemukan' }}" readonly>

        <label>Nama Rekening</label>
        <input type="text" class="form-control" value="{{ $bankDetails->account_name ?? 'Nama Rekening Tidak Ditemukan' }}" readonly>

        <label>Nomor Rekening</label>
        <input type="text" class="form-control" value="{{ $bankDetails->account_number ?? 'No. Rekening Tidak Ditemukan' }}" readonly>

        @isset($payment)
            <label>Nominal Pembayaran</label>
            <input type="text" class="form-control" value="Rp {{ number_format($payment->nominal, 0, ',', '.') }}" readonly>
        @endisset
    </div>
@else
    <p class="text-danger">Data rekening belum tersedia.</p>
@endif

            

            @if($payment)
                <div class="text-center">
                    <p class="text-success">✅ Pembayaran sudah dilakukan.</p>
                    <p>Status: <strong>{{ ucfirst($payment->status) }}</strong></p>
                    <a href="{{ asset('storage/' . $payment->proof) }}" target="_blank" class="btn btn-info">
                        📄 Lihat Bukti Pembayaran
                    </a>
                </div>
            @else
                <form action="{{ route('user.uploadPayment') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Rekening</label>
                            <input type="text" name="account_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Rekening</label>
                            <input type="text" name="account_number" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Bank</label>
                            <input type="text" name="bank_type" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Pembayaran</label>
                            <input type="text" name="payment_number" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3 text-center slip">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="proof" class="form-control" required>
                        <img id="previewImage" class="mt-2 preview-image">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">📤 Upload Pembayaran</button>
                </form>
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

</body>
</html>
