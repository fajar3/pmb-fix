@extends('layouts.admin')

@section('content')
<style>
    /* Admin Layout Styles */
    .container-fluid {
    padding: 0;
    overflow: hidden; /* Mencegah scroll horizontal */
}

.page-title::before {
        content: '\f09d'; /* Ganti icon dengan ikon uang koin */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 1.2rem;
        background: var(--primary-green);
        color: white;
        padding: 8px;
        border-radius: 10px;
    }
    .search-container .search-box {
        border-radius: 20px;
        margin-bottom: 10px;
        padding: 6px ;
        border: none;
        background: rgba(13, 196, 0, 0.09);
        font-size: 15px
    }


.row {
    display: flex;
    flex-wrap: nowrap; /* Hindari wrapping elemen ke bawah */
    height: 100vh; /* Pastikan elemen utama memenuhi layar */
    align-items: stretch; /* Pastikan elemen menempel ke atas */
}

    /* Fixed Sidebar Styling */
    .sidebar {
        background: white;
    backdrop-filter: blur(3px);
    height: 100vh; /* Pastikan sidebar memenuhi tinggi layar */
    box-shadow: 4px 0 15px rgb(180, 180, 180);
    padding: 20px 15px;
    position: fixed;
    top: 0;
    left: 0;
    width: 16.666667%; /* Sesuai dengan col-md-2 */
    border-right: 1px solid rgba(76, 175, 80, 0.1);
    z-index: 1000;
}


    .sidebar .position-sticky {
        top: 25px;
    }

    .nav-item {
        margin-bottom: 12px;
        background:rgba(13, 196, 0, 0.09);
        border-radius: 16px;
    }

    .nav-link {
        color: #2c3e50;
        padding: 15px 20px;
        border-radius: 16px;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
    }

    .nav-link:hover {
        background: rgba(76, 175, 80, 0.08);
        color: var(--primary-green);
        transform: translateX(5px);
    }

    .nav-link.active {
        background: linear-gradient(135deg, var(--primary-green), var(--hover-green));
        color: white;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.2);
    }

    /* Main Content Area */
    .main-wrapper {
    flex-grow: 1;
    height: 100vh;
    margin-left: 16.666667%;
    display: flex;
    flex-direction: column;
    padding-top: 0; /* Hilangkan jarak atas */
    border-radius: 0; /* Pastikan menempel ke atas */
}

.main-header {
    padding: 15px 30px;
    border-bottom: 1px solid rgba(76, 175, 80, 0.1);
    background: white; /* Pastikan header terlihat */
}

.main-content {
    flex-grow: 1;
    padding: 20px;
    overflow-y: auto;
}


    .main-title {
        font-size: 1.5rem;
        color: #2c3e50;
        font-weight: 600;
        margin: 0;
    }

    /* Icons Styling */
    .nav-link::before {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 1.1rem;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(76, 175, 80, 0.1);
        border-radius: 8px;
        padding: 8px;
        transition: all 0.3s ease;
    }

   

    /* Responsive adjustments */
    @media (max-width: 768px) {
    .sidebar {
        display: none;
    }
    .main-wrapper {
        margin-left: 0;
    }
    }
</style>


<div class="container-fluid">
    <div class="row">
        <!-- Fixed Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="position-sticky">
            <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" 
           href="{{ route('admin.users') }}">
            <i class="fa-solid fa-user"></i> Users
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}" 
           href="{{ route('admin.pendaftar') }}">
            <i class="fa-solid fa-file-signature"></i> Pendaftaran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.payments.putra') ? 'active' : '' }}" 
           href="{{ route('admin.payments.putra') }}">
            <i class="fa-solid fa-coins"></i> Keuangan Putra
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.payments.putri') ? 'active' : '' }}" 
           href="{{ route('admin.payments.putri') }}">
            <i class="fa-solid fa-wallet"></i> Keuangan Putri
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bank.index') ? 'active' : '' }}" 
           href="{{ route('admin.bank.index') }}">
            <i class="fa-solid fa-building-columns"></i> Settings Bank
        </a>
    </li>
    <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
</ul>


            </div>
            
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 main-wrapper">
           @yield('admin-content')
        </main>
    </div>
    
</div>
@endsection