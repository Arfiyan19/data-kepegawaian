@extends('layouts.app')
@section('title','RIWAYAT JABATAN')
@push('before-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT JABATAN</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-jabatan')}}">Riwayat Jabatan</a>
                </li> 
                <li class="breadcrumb-item active">Edit
                </li>
            </ol>
        </div>
    </div>
</div>
</div>

<section id="multiple-column-form">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Riwayat Jabatan</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-jabatan.update', $table->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="no_sk">No. SK</label>
                            <input type="text" name="no_sk" id="no_sk" class="form-control" value="{{ $table->no_sk }}">
                            @error('no_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="tgl_sk">Tanggal SK</label>
                            <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" value="{{ $table->tgl_sk }}">
                            @error('tgl_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="tgl_tmt">Tanggal TMT</label>
                            <input type="date" name="tgl_tmt" id="tgl_tmt" class="form-control" value="{{ $table->tgl_tmt }}">
                            @error('tgl_tmt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="diterbitkan">Diterbitkan Oleh</label>
                            <select name="diterbitkan" id="diterbitkan"  class="form-control select2">
                                <option  disabled >Pilih</option>
                                @foreach($diterbitkan as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_diterbitkan ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('diterbitkan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="form-group">
                            <label for="pangkat">Pangkat</label>
                            <select name="pangkat" id="pangkat" class="form-control select2">
                                <option  disabled >Pilih</option>
                                @foreach($pangkat as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_pangkat ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('pangkat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="induk_unit_kerja">Induk Unit Kerja</label>
                            <select name="induk_unit_kerja" id="induk_unit_kerja" class="form-control select2">
                                <option disabled >Pilih</option>
                                @foreach($induk_unit_kerja as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_induk_unit_kerja ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('induk_unit_kerja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="form-group">
                            <label for="unit_organisasi">Unit Organisasi</label>
                            <select name="unit_organisasi" id="unit_organisasi" class="form-control select2">
                                <option  disabled >Pilih</option>
                                @foreach($unit_organisasi as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_unit_organisasi ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('unit_organisasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="jenis_jabatan">Jenis Jabatan</label>
                            <select name="jenis_jabatan" id="jenis_jabatan"  class="form-control select2">
                                <option  selected disabled >Pilih</option>
                                @foreach($jenis_jabatan as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_jenis_jabatan ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenis_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div><div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="jabatan">Jabatan Struktural</label>
                            <select name="jabatan[]" id="jabatan"  class="form-control select2" multiple>
                                <!-- <option  selected disabled >Pilih</option> -->
                                @foreach($jabatan as $data)
                                    <option value="{{ $data->id }}" {{ in_array($data->id, $collection) ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div><div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="keterangan_jabatan">Keterangan Jabatan</label>
                            <input type="text" name="keterangan_jabatan" id="keterangan_jabatan" class="form-control" value="{{ $detail->keterangan_jabatan }}">
                            @error('keterangan_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group"><label for="group_fungsional">Group Fungsional</label>
                            <select name="group_fungsional" id="group_fungsional" class="form-control select2">
                                <option  disabled >Pilih</option>
                                @foreach($group_fungsional as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_group_fungsional ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('group_fungsional')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="form-group"><label for="jabatan_fungsional_tertentu">Jabatan Fungsional Tertentu</label>
                            <select name="jabatan_fungsional_tertentu" id="jabatan_fungsional_tertentu" class="form-control select2">
                                <option disabled >Pilih</option>
                                @foreach($jabatan_fungsional_tertentu as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_jabatan_fungsional_tertentu ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('jabatan_fungsional_tertentu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="">Jabatan Fungsional Umum</label>
                        <select name="jabatan_fungsional_umum" id="jabatan_fungsional_umum"  class="form-control select2">
                            <option disabled >Pilih</option>
                            @foreach($jabatan_fungsional_umum as $data)
                                <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_jabatan_fungsional_umum ? "selected" : "" }}>{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('jabatan_fungsional_umum')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-label" for="status_jabatan">Status Jabatan</label>
                            <select name="status_jabatan" id="status_jabatan"  class="form-control select2">
                                <option disabled >Pilih</option>
                                @foreach($status_jabatan as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_status_jabatan ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('status_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-label" for="alasan_jabatan_sementara">Alasan Jabatan Sementara</label>
                            <select name="alasan_jabatan_sementara" id="alasan_jabatan_sementara"  class="form-control select2">
                                <option disabled >Pilih</option>
                                @foreach($alasan_jabatan_sementara as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $detail->id_master_alasan_jabatan_sementara ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('alasan_jabatan_sementara')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <input type="text" id="catatan" class="form-control  " name="catatan" value="{{ $detail->catatan }}"/>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="dokumen">Dokumen</label>
                            <input type="file" id="dokumen" class="form-control  " name="dokumen" value="{{ $table->dokumen }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mr-1">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>
@endsection


@push('before-script')
    <!-- BEGIN: Page Vendor JS--> 
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 

    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>

@endpush

@push('after-script')
<script>
    $(document).ready(function(){
        $("#dataForm").validate();
    });
    </script> 
@endpush
