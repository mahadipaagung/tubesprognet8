{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')
@endsection
@section('content')
    <div class="nk-fmg-body-head d-none d-lg-flex">
        <div class="nk-fmg-search">
            <!-- <em class="icon ni ni-search"></em> -->
            <!-- <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> -->
            <h4 class="card-title text-primary"><i class='{{ $icon }}' data-toggle='tooltip' data-placement='bottom'
                    title='{{ $subtitle }}'></i> {{ strtoupper($subtitle) }}</h4>
        </div>
        <div class="nk-fmg-actions">
            <div class="btn-group">
                <!-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button> -->
                <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
                <a href="{{ route('keluarga.index', ['id' => $data->pegawai_id]) }}" class="btn btn-sm btn-primary"
                    onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
            </div>
        </div>

    </div>
    <div class="row gy-3 d-none" id="loaderspin">
        <div class="col-md-12">
            <div class="col-md-12" align="center">
                &nbsp;
            </div>
            <div class="d-flex align-items-center">
                <div class="col-md-12" align="center">
                    <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>
            <div class="col-md-12" align="center">
                <strong>Loading...</strong>
            </div>
        </div>
    </div>
    <div class="card d-none" id="filterrow">
        <div class="card-body" style="background:#f7f9fd">
            <div class="row gy-3">

            </div>
        </div>
        <!-- <div class="card-footer" style="background:#fff" align="right"> -->
        <div class="card-footer" style="background:#f7f9fd; padding-top:0px !important;">
            <div class="btn-group">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-dark" onclick="filterclear()"><em class="icon ti-eraser"></em> <span>Clear Filter</span></a> -->
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="filterdata()"><em
                        class="icon ti-reload"></em> <span>Submit Filter</span></a>
            </div>
        </div>
    </div>

    <!-- <div class="nk-fmg-body-content"> -->
    <div class="nk-fmg-quick-list nk-block">
        <div class="card">
            <div class="card-body">
                Elemen form edit data mahasiswa "{{ $data->nama }}"
                <form method="POST" action="{{ route('keluarga.update', $data->id_anggota_keluarga) }}" id='form1'
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control" name="pegawai_id" value="{{ $data->pegawai_id }}">

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                    required autofocus value="{{ old('nik', $data->nik) }}">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" required autofocus value="{{ old('nama', $data->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Agama</label>
                                <select name="agama_id" id="agama" class="form-control" autofocus>
                                    <option value="{{ $data->agama_id }}">{{ $data->agama->nama }}</option>
                                </select>
                                @error('agama_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select name="jenjang_pendidikan_id" id="jenjang_pendidikan_id" class="form-control"
                                    autofocus>
                                    <option value="{{ $data->jenjang_pendidikan_id }}">{{ $data->pendidikan->nama }}
                                    </option>
                                </select>
                                @error('jenjang_pendidikan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select name="pekerjaan_id" id="pekerjaan_id" class="form-control" autofocus>
                                    <option value="{{ $data->pekerjaan_id }}">{{ $data->pekerjaan->nama }}</option>
                                </select>
                                @error('pekerjaan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" required autofocus
                                    value="{{ old('tempat_lahir', $data->tempat_lahir) }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir" required autofocus
                                    value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="10"
                                    class="form-control @error('alamat') is-invalid @enderror" required autofocus>{{ old('alamat', $data->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Golongan Darah</label>
                                <select name="golongan_darah_id" id="golongan_darah" class="form-control" autofocus>
                                    <option value="{{ $data->golongan_darah_id }}">{{ $data->golongan_darah->nama }}
                                </select>
                                @error('golongan_darah_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Hubungan</label>
                                <select name="hubungan" id="hubungan" class="form-control" autofocus>
                                    <option value="{{ $data->hubungan }}">{{ $data->hubungan }}</option>
                                </select>
                                @error('hubungan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>AnaK Kandung</label>
                                <select name="is_anak_kandung" id="anak_kandung" class="form-control" autofocus>
                                    <option value="{{ $data->is_anak_kandung }}">
                                        @if ($data->is_anak_kandung == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('anak_kandung')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Foto</label>
                                <br>
                                <img src="{{ asset('keluarga/' . $data->file_foto) }}" alt="">
                                @error('file_foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Aktif</label>
                                <select name="is_aktif" id="aktif" class="form-control" autofocus>
                                    <option value="{{ $data->is_aktif }}">
                                        @if ($data->is_aktif == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('is_aktif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Balimed</label>
                                <select name="is_balimed" id="balimed" class="form-control" autofocus>
                                    <option value="{{ $data->is_balimed }}">
                                        @if ($data->is_balimed == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('is_balimed')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Valid</label>
                                <select name="valid" id="is_valid" class="form-control" autofocus>
                                    <option value="{{ $data->is_valid }}">
                                        @if ($data->is_valid == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('is_valid')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" id="" cols="30" rows="10"
                                    class="form-control @error('keterangan') is-invalid @enderror" required autofocus>{{ old('keterangan', $data->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin_id" id="jenis_kelamin" class="form-control" autofocus>
                                    <option value="{{ $data->jenis_kelamin_id }}">{{ $data->jenis_kelamin->nama }}
                                    </option>
                                </select>
                                @error('jenis_kelamin_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>No Akta Meninggal</label>
                                <input type="text" class="form-control @error('akta_meninggal') is-invalid @enderror"
                                    name="akta_meninggal" required autofocus
                                    value="{{ old('akta_meninggal', $data->akta_meninggal) }}">
                                @error('akta_meninggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>File Akta Meninggal</label>
                                <img src="{{ asset('keluarga/' . $data->file_akta_meninggal) }}" alt="">
                                @error('file_akta_meninggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Tanggal Meninggal</label>
                                <input type="date"
                                    class="form-control @error('tanggal_meninggal') is-invalid @enderror"
                                    name="tgl_meninggal" required autofocus
                                    value="{{ old('tanggal_meninggal', $data->tanggal_meninggal) }}">
                                @error('tgl_meninggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- </div> -->
@endsection
@push('script')
    <script>
        function updateConfirmation() {
            var flag = false
            CustomSwal.fire({
                icon: 'question',
                text: 'Apakah anda yakin mengubah data?',
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("form1").submit();
                } else {

                }
            });

        }
    </script>
@endpush
