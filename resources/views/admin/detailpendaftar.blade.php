@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/pendaftar.css') }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detail Pendaftar</span>
                    <a href="{{ route('admin.editPendaftar', $student->id) }}" class="btn btn-warning">Edit</a>

                           </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <h5>Data Peserta Didik</h5>
                            <p><strong>Nama Lengkap:</strong> {{ $student->full_name }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $student->gender }}</p>
                            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $student->birth_place }}, {{ $student->birth_date }}</p>
                            <p><strong>Kewarganegaraan:</strong> {{ $student->citizenship }}</p>
                            
                            <h5>Alamat</h5>
                            <p><strong>Alamat:</strong> {{ $student->address }}</p>
                            <p><strong>RT/RW:</strong> {{ $student->rt }}/{{ $student->rw }}</p>
                            <p><strong>Dusun:</strong> {{ $student->dusun }}</p>
                            <p><strong>Kelurahan:</strong> {{ $student->kelurahan }}</p>
                            <p><strong>Kecamatan:</strong> {{ $student->kecamatan }}</p>
                            <p><strong>Kabupaten/Kota:</strong> {{ $student->kabupaten }}</p>
                            <p><strong>Provinsi:</strong> {{ $student->provinsi }}</p>
                        </div>
                        
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <h5>Data Orang Tua</h5>
                            <h6>Ayah</h6>
                            <p><strong>Nama Ayah:</strong> {{ $student->father_name }}</p>
                            <p><strong>Tahun Lahir:</strong> {{ $student->father_birth_year }}</p>
                            <p><strong>Status:</strong> {{ $student->father_status }}</p>
                            <p><strong>Pendidikan:</strong> {{ $student->father_education }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $student->father_job }}</p>
                            <p><strong>No. Telepon:</strong> {{ $student->father_phone }}</p>
                            
                            <h6>Ibu</h6>
                            <p><strong>Nama Ibu:</strong> {{ $student->mother_name }}</p>
                            <p><strong>Tahun Lahir:</strong> {{ $student->mother_birth_year }}</p>
                            <p><strong>Status:</strong> {{ $student->mother_status }}</p>
                            <p><strong>Pendidikan:</strong> {{ $student->mother_education }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $student->mother_job }}</p>
                            <p><strong>No. Telepon:</strong> {{ $student->mother_phone }}</p>
                            
                            @if($student->guardian_name)
                            <h5>Data Wali</h5>
                            <p><strong>Nama Wali:</strong> {{ $student->guardian_name }}</p>
                            <p><strong>Tahun Lahir:</strong> {{ $student->guardian_birth_year }}</p>
                            <p><strong>Status:</strong> {{ $student->guardian_status }}</p>
                            <p><strong>Pendidikan:</strong> {{ $student->guardian_education }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $student->guardian_job }}</p>
                            <p><strong>No. Telepon:</strong> {{ $student->guardian_phone }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <h5 class="mt-4">Berkas Persyaratan</h5>
                    <p><strong>Fotokopi KK:</strong> <a href="{{ asset('storage/' . $student->kk_copy) }}" target="_blank">Lihat Berkas</a></p>
                    <p><strong>Fotokopi Akta Kelahiran:</strong> <a href="{{ asset('storage/' . $student->birth_certificate_copy) }}" target="_blank">Lihat Berkas</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
