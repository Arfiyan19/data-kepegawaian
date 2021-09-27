@extends('layouts.app')
@section('title','RIWAYAT ASURANSI PEGAWAI')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT ASURANSI</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-asuransi') }}">Riwayat Asuransi</a>
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
            <h4 class="card-title">Tambah Asuransi </h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-asuransi.store') }}" method="post">
                
                @csrf
                <div class="row">

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="surat-id-column">No Polis</label>
                            <input type="text" id="surat-id-column" class="required form-control @error('no_polis') is-invalid @enderror " name="no_polis"  />
                            @error('no_polis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="surat-id-column">Nama Perusahaan</label>
                            <input type="text" id="nap-id-column" class="required form-control @error('nama_perusahaan') is-invalid @enderror " name="nama_perusahaan"  />
                            @error('nama_perusahaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-post">Jenis Asuransi</label>
                            <select name="jenis_asuransi" id="jenis_asuransi"  class="form-control dt-post  @error('jenis_asuransi') is-invalid @enderror ">
                                <option  selected disabled >Pilih</option>
                                @foreach($asuransi as $row)
                                <option value="{{ $row->id_asuransi }}">{{ $row->asuransi }}</option>
                                @endforeach
                        </select>
                        @error('jenis_asuransi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tanggal_mulai-id-column">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai-id-column" class="form-control @error('tanggal_mulai') is-invalid @enderror " name="tanggal_mulai" max="3" />
                            @error('tanggal_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tanggal_akhir-id-column">Tanggal Akhir</label>
                            <input type="date" id="tanggal_akhir-id-column" class="form-control @error('tanggal_akhir') is-invalid @enderror " name="tanggal_akhir" max="3" />
                            @error('tanggal_akhir')
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
