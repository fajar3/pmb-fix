@extends('admin.dashboard')

@section('admin-content')
<style>
    .data-container {
        max-height: 800px; /* Atur tinggi maksimal */
        overflow-y: auto; /* Tambahkan scroll vertikal */
        border: 1px solid #ddd; /* Opsional, agar terlihat lebih rapi */
    }
    .data-container::-webkit-scrollbar {
    display: none; /* Untuk Chrome, Safari, dan Edge */
}
</style>
<div class="data-container">
    <h2 class="page-title">Pendaftar</h2>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari berdasarkan nama..." onkeyup="searchTable()">
    </div>

    <div class="table-container">
        <table class="table" id="studentsTable">
        <thead>
    <tr>
        <th>Nama</th>
        <th>Status Pembayaran</th>
        <th>Genre</th>
        <th>Aksi</th> <!-- Tambahkan kolom aksi -->
    </tr>
</thead>
<tbody>
    @foreach ($students as $student)
    <tr>
        <td>{{ $student->full_name }}</td>
        <td>
            <span class="status-badge 
                @if($student->payment_status == 'paid') status-verified 
                @elseif($student->payment_status == 'pending') status-pending 
                @else status-unpaid 
                @endif">
                {{ ucfirst($student->payment_status) }}
            </span>
        </td>
        <td>{{ $student->gender }}</td>
        <td>
            <a href="{{ route('admin.detailpendaftar', $student->id) }}" class="btn btn-primary">Detail</a>
        </td>
    </tr>
    @endforeach
</tbody>



        </table>
    </div>
</div>

<!-- JavaScript untuk Pencarian -->
<script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("studentsTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let nameCell = rows[i].getElementsByTagName("td")[0]; // Kolom Nama
            if (nameCell) {
                let name = nameCell.textContent.toLowerCase();
                rows[i].style.display = name.includes(input) ? "" : "none";
            }
        }
    }
</script>

@endsection
 