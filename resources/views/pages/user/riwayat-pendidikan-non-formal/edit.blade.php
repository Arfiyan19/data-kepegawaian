@extends('layouts.app')
@section('title','RIWAYAT PENDIDIKAN NON FORMAL')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT PENDIDIKAN NON FORMAL</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-pendidikan-non-formal')}}">Riwayat Pendidikan Non Formal </a>
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
            <h4 class="card-title">Edit Riwayat Pendidikan Non Formal</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-pendidikan-non-formal.update',$data->id)  }}" method="post">
                @csrf
              @method('put')
                <div class="row">
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="nama_pendidikan_non_formal-id-column"> Nama/Judul *</label>
                        <input type="text" value="{{ $data->nama_pendidikan_non_formal }}" id="nama_pendidikan_non_formal-id-column" class="required form-control @error('nama_pendidikan_non_formal') is-invalid @enderror"name="nama_pendidikan_non_formal"   />
                        @error('nama_pendidikan_non_formal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="penyelenggara_sponsor_lembaga-id-column">Penyelenggara/Sponsor/Lembaga</label>
                            <input type="text" value="{{ $data->penyelenggara_sponsor_lembaga }}"   id="penyelenggara_sponsor_lembaga-id-column" class="required form-control @error('penyelenggara_sponsor_lembaga') is-invalid @enderror"name="penyelenggara_sponsor_lembaga"   />
                            @error('penyelenggara_sponsor_lembaga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_mulai-id-column">Tanggal Mulai</label>
                            <input type="date" value="{{ $data->tanggal_mulai }}" id="tanggal_mulai-id-column" class="required form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai"  />
                            @error('tanggal_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_berakhir-id-column">Tanggal Berakhir</label>
                            <input type="date" value="{{ $data->tanggal_berakhir }}" id="tanggal_berakhir-id-column" class="required form-control @error('tanggal_berakhir') is-invalid @enderror" name="tanggal_berakhir"  />
                            @error('tanggal_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tempat-id-column">Tempat</label>
                            <input type="text" value="{{ $data->tempat }}" id="tempat-id-column" class="required form-control @error('tempat') is-invalid @enderror" name="tempat"  />
                            @error('tempat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="peranan-id-column">Peranan</label>
                            <input type="text" value="{{ $data->peranan }}" id="peranan-id-column" class="required form-control @error('peranan') is-invalid @enderror" name="peranan"  />
                            @error('peranan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="catatan-id-column">Catatan</label>
                            <input type="text" value="{{ $data->catatan }}" id="catatan-id-column" class="required form-control @error('catatan') is-invalid @enderror" name="catatan"  />
                            @error('catatan')
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
