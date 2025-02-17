@extends('user.db')

@section('db')
<link rel="stylesheet" href="{{ asset('css/userdashboard1.css') }}">

<div class="settings-section">
    <div class="settings-header">
        <h2>Pengaturan Akun</h2>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form class="settings-form" method="POST" action="{{ route('user.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
