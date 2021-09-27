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
        <h2 class="content-header-title float-left mb-0">RIWAYAT CUTI</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-cuti') }}">RIWAYAT CUTI</a>
                </li> 
                <li class="breadcrumb-item active">Create
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
            <h4 class="card-title">Tambah Riwayat Cuti </h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-cuti.store') }}" method="post">
                
                @csrf
                <div class="row">

                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Jenis Cuti</label>
                        <select name="jenis_cuti" id="jenis_cuti"  class="form-control required dt-post  @error('jenis_cuti') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($jenis_cuti as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_cuti }}</option>
                            @endforeach
                        </select>
                        @error('jenis_cuti')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                     <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="surat-id-column">No Surat Ijin (*)</label>
                            <input type="text" id="surat-id-column" class="required form-control required @error('no_surat_ijin') is-invalid @enderror " name="no_surat_ijin"  />
                            @error('no_surat_ijin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="tanggal_surat_ijin-id-column">Tanggal Surat Ijin</label>
                            <input type="date" id="tanggal_surat_ijin-id-column" class="form-control required @error('tanggal_surat_ijin') is-invalid @enderror " name="tanggal_surat_ijin" max="3" />
                            @error('tanggal_surat_ijin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="tanggal_surat_mulai-id-column">Tanggal Surat Mulai</label>
                            <input type="date" id="tanggal_surat_mulai-id-column" class="form-control required @error('tanggal_surat_mulai') is-invalid @enderror " name="tanggal_surat_mulai" max="3" />
                            @error('tanggal_surat_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                 
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="tanggal_surat_akhir-id-column">Tanggal Surat Mulai</label>
                            <input type="date" id="tanggal_surat_akhir-id-column" class="form-control required @error('tanggal_surat_akhir') is-invalid @enderror " name="tanggal_surat_akhir" max="3" />
                            @error('tanggal_surat_akhir')
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
