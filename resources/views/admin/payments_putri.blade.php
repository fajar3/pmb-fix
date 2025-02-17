@extends('admin.dashboard')

@section('admin-content')
<div class="data-container">
    <h2 class="page-title">Keuangan - Pembayaran Putri</h2>
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari berdasarkan nama..." onkeyup="searchTable()">
    </div>
    <div class="table-container">
        <table class="table" id="studentsTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
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
                @foreach($payments_putri as $key => $payment)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $payment->user->name }}</td>
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
<script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("studentsTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let nameCell = rows[i].getElementsByTagName("td")[1]; // Kolom Nama
            if (nameCell) {
                let name = nameCell.textContent.toLowerCase();
                rows[i].style.display = name.includes(input) ? "" : "none";
            }
        }
    }
</script>
@endsection
