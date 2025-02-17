@extends('admin.dashboard')

@section('admin-content')
<style>
    .table-container::-webkit-scrollbar {
    display: none; /* Untuk Chrome, Safari, dan Edge */
}
    .table-container {
        max-height: 400px; /* Atur tinggi maksimal */
        overflow-y: auto; /* Tambahkan scroll vertikal */
        border: 1px solid #ddd; /* Opsional, agar terlihat lebih rapi */
    }
</style>

<div class="data-container">
    <h2 class="page-title">Data User</h2>
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari berdasarkan nama..." onkeyup="searchTable()">
    </div>
    <div class="table-container">
        <table class="table" id="dd">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-badge role-{{ strtolower($user->role) }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower($user->status) }}">
                            {{ $user->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.editUser', $user->id) }}" class="btn-action">
                            Action
                        </a>
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
        let table = document.getElementById("dd");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let nameCell = rows[i].getElementsByTagName("td")[1]; // Kolom Nama
            let emailCell = rows[i].getElementsByTagName("td")[2]; // Kolom Email

            if (nameCell && emailCell) {
                let name = nameCell.textContent.toLowerCase();
                let email = emailCell.textContent.toLowerCase();

                // Tampilkan jika input cocok dengan nama ATAU email
                rows[i].style.display = (name.includes(input) || email.includes(input)) ? "" : "none";
            }
        }
    }
</script>

@endsection