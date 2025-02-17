@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/userdashboard1.css') }}">

<div class="dashboard-container">
    <!-- Sidebar Navigation -->
    <nav class="dashboard-nav">
        <div class="nav-profile">
            <div class="profile-image">👤</div>
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <div class="profile-role">Santri</div>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : ''}}">
                <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : ''}}">
                    <i>📊</i> Dashboard
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('user.payment') ? 'active' : ''}}">
                <a href="{{ route('user.payment') }}" class="nav-link {{ request()->routeIs('user.payment') ? 'active' : ''}}">
                    <i>💰</i> Pembayaran
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('settings') ? 'active' : ''}}">
                <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : ''}}">
                    <i>⚙️</i> Pengaturan Akun
                </a>
            </li>
        </ul>
        
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </nav>

    <!-- Content Section -->
    <div class="content-section">
        @yield('db')
    </div>
</div>

@endsection
