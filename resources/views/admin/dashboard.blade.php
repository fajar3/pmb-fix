// resources/views/admin/dashboard.blade.php
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_registrations'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pembayaran Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_payments'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Registrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pendaftaran Terbaru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Reg</th>
                            <th>Nama</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_registrations as $registration)
                        <tr>
                            <td>{{ $registration->id }}</td>
                            <td>{{ $registration->full_name }}</td>
                            <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $registration->status == 'pending' ? 'warning' : ($registration->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ $registration->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.registrations.show', $registration) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection