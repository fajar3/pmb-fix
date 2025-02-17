@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/editdftr.css') }}">
@section('content')
<div class="container">
    <div class="edit-container">
        <h2>Edit Data Pendaftar</h2>
        <form action="{{ route('admin.updatePendaftar', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h3>Data Peserta Didik</h3>
            <label>Nama Lengkap:</label>
            <input type="text" name="full_name" value="{{ $student->full_name }}" required>

            <label>Jenis Kelamin:</label>
            <select name="gender" required>
                <option value="Laki-laki" {{ $student->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <label>Tempat, Tanggal Lahir:</label>
            <input type="text" name="birth_place" value="{{ $student->birth_place }}" required>
            <input type="date" name="birth_date" value="{{ $student->birth_date }}" required>

            <label>Kewarganegaraan:</label>
            <input type="text" name="citizenship" value="{{ $student->citizenship }}" required>

            <h3>Alamat</h3>
            <input type="text" name="address" value="{{ $student->address }}" required>
            <input type="number" name="rt" value="{{ $student->rt }}" required>
            <input type="number" name="rw" value="{{ $student->rw }}" required>

            <h3>Data Orang Tua</h3>
            <label>Nama Ayah:</label>
            <input type="text" name="father_name" value="{{ $student->father_name }}" required>

            <label>Nama Ibu:</label>
            <input type="text" name="mother_name" value="{{ $student->mother_name }}" required>

            <h3>Data Wali</h3>
            <label>Nama Wali:</label>
            <input type="text" name="guardian_name" value="{{ $student->guardian_name }}">

            <button type="submit" class="btn-save">Simpan</button>
            <a href="{{ route('admin.detailpendaftar', $student->id) }}" class="btn-cancel">Batal</a>
        </form>
    </div>
</div>
@endsection
