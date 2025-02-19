@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulir Pendaftaran Santri Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Identitas Peserta Didik -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Identitas Peserta Didik</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" 
                                       value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror" 
                                       value="{{ old('birth_place') }}" required>
                                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                                       value="{{ old('birth_date') }}" required>
                                @error('birth_place')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kewarganegaraan</label>
                                <select name="nationality" class="form-select @error('nationality') is-invalid @enderror" required>
                                    <option value="WNI" {{ old('nationality') == 'WNI' ? 'selected' : '' }}>Indonesia (WNI)</option>
                                    <option value="WNA" {{ old('nationality') == 'WNA' ? 'selected' : '' }}>Asing (WNA)</option>
                                </select>
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Ayah Kandung -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Data Ayah Kandung</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="father_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="number" name="father_birth_year" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Riwayat Hidup</label>
                                <select name="father_status" class="form-select">
                                    <option value="alive">Masih Hidup</option>
                                    <option value="deceased">Sudah Meninggal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Ibu Kandung -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Data Ibu Kandung</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="mother_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="number" name="mother_birth_year" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Riwayat Hidup</label>
                                <select name="mother_status" class="form-select">
                                    <option value="alive">Masih Hidup</option>
                                    <option value="deceased">Sudah Meninggal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Kirim Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
