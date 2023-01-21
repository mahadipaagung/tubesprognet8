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
                <a href="pegawai/struktural/{{ $data->pegawai_id }}" class="btn btn-sm btn-primary"
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
                Elemen form input data Keluarga
                <form method="POST" action="" id='form1' enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control" name="pegawai_id" value="{{ $data->pegawai_id }}">

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Jabatan Struktural</label>
                                <select name="jabatan_struktural_id" id="jabatan_struktural_id" class="form-control"
                                    autofocus>
                                    <option value="{{ $data->jabatan_struktural_id }}">
                                        {{ $data->jabatan->nama_jabatan_singkat ?? null }}</option>
                                </select>
                                @error('jabatan_struktural_id')
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
                                <label>Unit</label>
                                <select name="unit_id" id="unit_id" class="form-control" autofocus>
                                    <option value="{{ $data->unit_id }}">{{ $data->unit->nama }}</option>
                                </select>
                                @error('unit_id')
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
                                <label>Unit</label>
                                <select name="sub_unit_id" id="sub_unit_id" class="form-control" autofocus>
                                    <option value="{{ $data->sub_unit->id }}">{{ $data->sub_unit->nama_subunit }}
                                    </option>
                                </select>
                                @error('unit_id')
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
                                <label>No SK Diangkat</label>
                                <input type="text" class="form-control @error('no_sk_diangkat') is-invalid @enderror"
                                    name="no_sk_diangkat" required autofocus
                                    value="{{ old('no_sk_diangkat', $data->no_sk_diangkat) }}">
                                @error('no_sk_diangkat')
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
                                <label>TMT SK Diangkat</label>
                                <input type="date" class="form-control @error('tmt_sk_diangkat') is-invalid @enderror"
                                    name="tmt_sk_diangkat" required autofocus
                                    value="{{ old('tmt_sk_diangkat', $data->tmt_sk_diangkat) }}">
                                @error('tmt_sk_diangkat')
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
                                <label>Tanggal SK Diangkat</label>
                                <input type="date" class="form-control @error('tgl_sk_diangkat') is-invalid @enderror"
                                    name="tgl_sk_diangkat" required autofocus
                                    value="{{ old('tgl_sk_diangkat', $data->tgl_sk_diangkat) }}">
                                @error('tgl_sk_diangkat')
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
                                <label>No SK Berhenti</label>
                                <input type="text" class="form-control @error('no_sk_berhenti') is-invalid @enderror"
                                    name="no_sk_berhenti" required autofocus
                                    value="{{ old('no_sk_berhenti', $data->no_sk_berhenti) }}">
                                @error('no_sk_berhenti')
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
                                <label>TMT SK Berhenti</label>
                                <input type="date" class="form-control @error('tmt_sk_berhenti') is-invalid @enderror"
                                    name="tmt_sk_berhenti" required autofocus
                                    value="{{ old('tmt_sk_berhenti', $data->tmt_sk_berhenti) }}">
                                @error('tmt_sk_berhenti')
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
                                <label>Tanggal SK Berhenti</label>
                                <input type="date"
                                    class="form-control @error('tanggal_sk_berhenti') is-invalid @enderror"
                                    name="tgl_sk_berhenti" required autofocus
                                    value="{{ old('tgl_sk_berhenti', $data->tgl_sk_berhenti) }}">
                                @error('tgl_sk_berhenti')
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
                                <label>Tanggal SK Berakhir</label>
                                <input type="date"
                                    class="form-control @error('tanggal_sk_berakhir') is-invalid @enderror"
                                    name="tgl_sk_berakhir" required autofocus
                                    value="{{ old('tgl_sk_berakhir', $data->tgl_sk_berakhir) }}">
                                @error('tgl_sk_berakhir')
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
                                <label>Nama Penanda Tangan Pengangkat</label>
                                <input type="text"
                                    class="form-control @error('nama_penanda_tangan_pengangkat') is-invalid @enderror"
                                    name="nama_penanda_tangan_pengangkat" required autofocus
                                    value="{{ old('nama_penanda_tangan_pengangkat', $data->nama_penanda_tangan_pengangkat) }}">
                                @error('nama_penanda_tangan_pengangkat')
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
                                <label>Jabatan Penanda Tangan Pengangkat</label>
                                <input type="text"
                                    class="form-control @error('jabatan_penanda_tangan_pengangkat') is-invalid @enderror"
                                    name="jabatan_penanda_tangan_pengangkat" required autofocus
                                    value="{{ old('jabatan_penanda_tangan_pengangkat', $data->jabatan_penanda_tangan_pengangkat) }}">
                                @error('jabatan_penanda_tangan_pengangkat')
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
                                <label>Nama Penanda Tangan Berhenti</label>
                                <input type="text"
                                    class="form-control @error('nama_penanda_tangan_berhenti') is-invalid @enderror"
                                    name="nama_penanda_tangan_berhenti" required autofocus
                                    value="{{ old('nama_penanda_tangan_berhenti', $data->nama_penanda_tangan_berhenti) }}">
                                @error('nama_penanda_tangan_berhenti')
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
                                <label>Jabatan Penanda Tangan Berhenti</label>
                                <input type="text"
                                    class="form-control @error('jabatan_penanda_tangan_berhenti') is-invalid @enderror"
                                    name="jabatan_penanda_tangan_berhenti" required autofocus
                                    value="{{ old('jabatan_penanda_tangan_berhenti', $data->jabatan_penanda_tangan_berhenti) }}">
                                @error('jabatan_penanda_tangan_berhenti')
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
                                <label>Status Data Valid</label>
                                <select name="status_data_valid" id="status_data_valid" class="form-control" autofocus>
                                    <option value="{{ $data->status_data_valid }}">
                                        @if ($data->status_data_valid == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('status_data_valid')
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
                                <label>File SK Diangkat</label>
                                <img src="{{ asset('struktural/' . $data->file_sk_diangkat) }}" alt="">
                                @error('file_sk_diangkat')
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
                                <label>File SK Berhenti</label>
                                <input type="file" class="form-control" name="file_sk_berhenti">
                                @error('file_sk_berhenti')
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
                                <label>Status File Valid</label>
                                <select name="status_data_valid" id="status_file_valid" class="form-control" autofocus>
                                    <option value="{{ $data->status_data_valid }}">
                                        @if ($data->status_data_valid == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('status_file_valid')
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
                                <label>Keterangan Validasi</label>
                                <textarea name="keterangan_validasi" id="" cols="30" rows="10"
                                    class="form-control @error('keterangan_validasi') is-invalid @enderror" required autofocus>{{ old('keterangan_validasi', $data->keterangan_validasi) }}</textarea>
                                @error('keterangan_validasi')
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
                                <label>Is Aktif</label>
                                <select name="is_aktif" id="status_file_valid" class="form-control" autofocus>
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
                                <label>Flag Terakhir</label>
                                <select name="flag_terakhir" id="flag_terakhir" class="form-control" autofocus>
                                    <option value="{{ $data->flag_terakhir }}">
                                        @if ($data->flag_terakhir == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </option>
                                </select>
                                @error('flag_terakhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end my-3">
                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                        <button type="button" onclick='updateConfirmation()'
                            class="btn btn-sm btn-success">Submit</button>
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
                text: 'Apakah anda yakin menambah data?',
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
