@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/reg.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Pendaftaran</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                        @csrf

                        <h5>Data Peserta Didik</h5>
                        <div class="form-group">
                            <label for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="birth_place">Tempat Lahir</label>
                            <input type="text" class="form-control" id="birth_place" name="birth_place" required>
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        </div>

                        <div class="form-group">
                            <label for="citizenship">Kewarganegaraan</label>
                            <select class="form-control" id="citizenship" name="citizenship" required>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                        </div>

                        <h5>Alamat</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="address">Alamat Lengkap</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="rt">RT</label>
                                <input type="number" class="form-control" id="rt" name="rt">
                            </div>
                            <div class="col-md-3">
                                <label for="rw">RW</label>
                                <input type="number" class="form-control" id="rw" name="rw">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="dusun">Dusun</label>
                                <input type="text" class="form-control" id="dusun" name="dusun">
                            </div>
                            <div class="col-md-4">
                                <label for="kelurahan">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                            </div>
                            <div class="col-md-4">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="kabupaten">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="kabupaten" name="kabupaten">
                            </div>
                            <div class="col-md-6">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi">
                            </div>
                        </div>

                        <h5>Data Orang Tua</h5>
                        <h6>Ayah</h6>
                        <div class="form-group">
                            <label for="father_name">Nama Ayah</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" required>
                        </div>
                        <div class="form-group">
                            <label for="father_birth_year">Tahun Lahir</label>
                            <input type="number" class="form-control" id="father_birth_year" name="father_birth_year" required>
                        </div>
                        <div class="form-group">
                            <label for="father_status">Status Wali</label>
                            <select class="form-control" id="father_status" name="father_status">
                                <option value="Masih Hidup">Masih Hidup</option>
                                <option value="Sudah Meninggal">Sudah Meninggal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="father_education">Pendidikan</label>
                            <input type="text" class="form-control" id="father_education" name="father_education" required>
                        </div>
                        <div class="form-group">
                            <label for="father_job">Pekerjaan</label>
                            <input type="text" class="form-control" id="father_job" name="father_job" required>
                        </div>
                        <div class="form-group">
                            <label for="father_phone">No. Telepon</label>
                            <input type="text" class="form-control" id="father_phone" name="father_phone" required>
                        </div>

                        <h6>Ibu</h6>
                        <div class="form-group">
                            <label for="mother_name">Nama Ibu</label>
                            <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_birth_year">Tahun Lahir</label>
                            <input type="number" class="form-control" id="mother_birth_year" name="mother_birth_year" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_status">Status Ibu</label>
                            <select class="form-control" id="mother_status" name="mother_status">
                                <option value="Masih Hidup">Masih Hidup</option>
                                <option value="Sudah Meninggal">Sudah Meninggal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mother_education">Pendidikan</label>
                            <input type="text" class="form-control" id="mother_education" name="mother_education" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_job">Pekerjaan</label>
                            <input type="text" class="form-control" id="mother_job" name="mother_job" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_phone">No. Telepon</label>
                            <input type="text" class="form-control" id="mother_phone" name="mother_phone" required>
                        </div>

                        <h5>Data Wali (Opsional)</h5>
                        <div class="form-group">
                            <label for="guardian_name">Nama Wali</label>
                            <input type="text" class="form-control" id="guardian_name" name="guardian_name">
                        </div>
                        <div class="form-group">
                            <label for="guardian_birth_year">Tahun Lahir Wali</label>
                            <input type="number" class="form-control" id="guardian_birth_year" name="guardian_birth_year">
                        </div>
                        <div class="form-group">
                            <label for="guardian_status">Status Wali</label>
                            <select class="form-control" id="guardian_status" name="guardian_status">
                                <option value="Masih Hidup">Masih Hidup</option>
                                <option value="Sudah Meninggal">Sudah Meninggal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guardian_education">Pendidikan Wali</label>
                            <input type="text" class="form-control" id="guardian_education" name="guardian_education">
                        </div>
                        <div class="form-group">
                            <label for="guardian_job">Pekerjaan Wali</label>
                            <input type="text" class="form-control" id="guardian_job" name="guardian_job">
                        </div>
                        <div class="form-group">
                            <label for="guardian_phone">Nomor Telepon Wali</label>
                            <input type="text" class="form-control" id="guardian_phone" name="guardian_phone">
                        </div>

                        <h5>Berkas Persyaratan</h5>
                        <div class="form-group">
                            <label for="kk_copy">Unggah Fotokopi KK</label>
                            <input type="file" class="form-control" id="kk_copy" name="kk_copy" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>

                        <div class="form-group">
                            <label for="birth_certificate_copy">Unggah Fotokopi Akta Kelahiran</label>
                            <input type="file" class="form-control" id="birth_certificate_copy" name="birth_certificate_copy" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>

                        <h5>Persetujuan</h5>
                        <div class="form-check">
                            <p>1. Niat lillahi ta'ala	</p>																							
 <p>2. Diantar / didampingi oleh orang tua atau wali calon santri</p>
 <p>3. Mengisi formulir yang sudah disediakan dengan lengkap dan benar		</p>
 <p>4. Siap mengikuti dan mentaati peraturan yang sudah ditetapkan di pondok</p>
 <p>5. Membayar administrasi pondok pesantren	</p>
 <p>6. Santri baru, dilarang pulang selama masa adaptasi (40 hari)	</p>																								
																						
																								
																							
								<div class="check">
                                <input class="form-check-input" type="checkbox" id="agreement_lillah" name="agreement_lillah" value="1" required>
                                <label class="form-check-label" for="agreement_lillah">Setuju</label>
                                </div>															

                           
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


                        
