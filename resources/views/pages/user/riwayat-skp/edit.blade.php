@extends('layouts.app')
@section('title','RIWAYAT SKP')
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
        <h2 class="content-header-title float-left mb-0">RIWAYAT SKP</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-skp')}}">Riwayat Skp</a>
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
            <h4 class="card-title">LK 03-Riwayat SKP</h4>
        </div>
        <div class="card-body">
            <form class="form"  id="dataForm" action="{{ route('riwayat-skp.update', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $data->tahun }}">
                            @error('tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="nilai">Target Nilai</label>
                            <input type="number" name="nilai" id="nilai" class="form-control" value="{{ $data->nilai }}">
                            @error('nilai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="opl">Orientasi Pelayanan</label>
                            <input type="number" name="opl" id="opl" class="form-control" value="{{ $data->opl }}">
                            @error('opl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="int">Integritas</label>
                            <input type="number" name="int" id="int" class="form-control" value="{{ $data->int }}">
                            @error('int')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="kom">Komitmen</label>
                            <input type="number" name="kom" id="kom" class="form-control" value="{{ $data->kom }}">
                            @error('kom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="dis">Disiplin</label>
                            <input type="number" name="dis" id="dis" class="form-control" value="{{ $data->dis }}">
                            @error('dis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="ksm">Kerjasama</label>
                            <input type="number" name="ksm" id="ksm" class="form-control" value="{{ $data->ksm }}">
                            @error('ksm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="kpm">Kepemimpinan</label>
                            <input type="number" name="kpm" id="kpm" class="form-control" value="{{ $data->kpm }}">
                            @error('kpm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
    @include('sweet::alert')
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
