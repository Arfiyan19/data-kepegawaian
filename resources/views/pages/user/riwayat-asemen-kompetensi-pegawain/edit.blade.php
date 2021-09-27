@extends('layouts.app')
@section('title','Informasi Pegawai')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h4 class="content-header-title float-left mb-0">RIWAYAT ASEMEN</h4>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-asesmen-kompetensi') }}">RIWAYAT ASEMEN KOMPETENSI PEGAWAI</a>
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
            <h4 class="card-title">Edit Riwayat Asesmen Kompetensi Pegawai </h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-asesmen-kompetensi.update',$data->id) }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="row">
                     <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal-id-column">Tanggal Asesmen</label>
                            <input type="date" value="{{ $data->tanggal_asesmen }}" id="tanggal-id-column" class="required form-control @error('tanggal_asesmen') is-invalid @enderror " name="tanggal_asesmen"  />
                            @error('tanggal_asesmen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nilai_kompetensi-id-column">Nilai Kompetensi</label>
                            <input type="number" value="{{ $data->nilai_kompetensi }}" id="nilai_kompetensi-id-column" class="form-control required @error('nilai_kompetensi') is-invalid @enderror " name="nilai_kompetensi" max="100" />
                            @error('nilai_kompetensi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nilai_potensi-id-column">Nilai Potensi</label>
                            <input type="number"  value="{{ $data->nilai_potensi }}" id="nilai_potensi-id-column" class="form-control required @error('nilai_potensi') is-invalid @enderror " name="nilai_potensi" max="100" />
                            @error('nilai_potensi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Jabatan Saat Asesmen</label>
                        <select name="jabatan_id"  id="jabatan"  class="form-control required dt-post  @error('jabatan_id') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($jabatan as $row)
                                <option   value="{{ $row->id }}" {{ $row->id  == $data->id_jabatan ? 'selected' : '' }}>{{ $row->nama_jabatan }}</option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Unit Kerja</label>
                        <select name="unit_kerja_id" id="jabatan"  class="form-control required dt-post  @error('unit_kerja_id') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($unit_kerja as $row)
                                <option value="{{ $row->id }}" {{ $row->id  == $data->id_unit_kerja ? 'selected' : '' }}>{{ $row->nama_unit }}</option>
                            @endforeach
                        </select>
                        @error('unit_kerja_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="dokumen_asesmen-id-column">Dokumen Asesmen</label>
                            <input type="file" id="dokumen_asesmen-id-column" class=" form-control @error('dokumen_asesmen') is-invalid @enderror " name="dokumen_asesmen"  />
                            @error('dokumen_asesmen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
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

@endpush

@push('after-script')
<script>
    $(document).ready(function(){
        $("#dataForm").validate();
    });
    </script> 
@endpush
