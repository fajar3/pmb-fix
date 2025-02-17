@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edituser.css') }}">
<div class="container">
    <h2>Edit User</h2>
    <form method="POST" action="{{ route('admin.updateUser', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="banned" {{ $user->status === 'banned' ? 'selected' : '' }}>Banned</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
<div class="buton">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memperbarui data user ini?')">Update</button>

        
    </form>

    
    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus User</button>
        </form>

        </div>
</div>
@endsection
