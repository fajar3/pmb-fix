// resources/views/admin/settings/index.blade.php
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan Pembayaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Bank</label>
                            <input type="text" name="settings[bank_name]" class="form-control" 
                                   value="{{ $settings['bank_name'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Rekening</label>
                            <input type="text" name="settings[bank_account]" class="form-control" 
                                   value="{{ $settings['bank_account'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Atas Nama</label>
                            <input type="text" name="settings[bank_account_name]" class="form-control" 
                                   value="{{ $settings['bank_account_name'] ?? '' }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan Footer</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.footer.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Informasi Kontak</label>
                            <textarea name="contact_info" class="form-control" rows="3">{{ $settings['contact_info'] ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Google Maps Embed Link</label>
                            <input type="text" name="map_embed" class="form-control" 
                                   value="{{ $settings['map_embed'] ?? '' }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection