@extends('layouts.app')
@section('title','RIWAYAT PENGHARGAAN')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT PENGHARGAAN</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
            </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-penghargaan')}}">Riwayat Penghargaan</a>
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
            <h4 class="card-title">Edit Riwayat Penghargaan</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-penghargaan.update',$data->id) }}" method="post">
                
                @csrf
              @method('put')

                <div class="row">
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="nama_tanda_jasa_penghargaan-id-column"> Nama Tanda Jasa / Penghargaan</label>
                        <input type="text" value="{{ $data->nama_tanda_jasa_penghargaan }}" id="nama_tanda_jasa_penghargaan-id-column" class="required form-control @error('nama_tanda_jasa_penghargaan') is-invalid @enderror"name="nama_tanda_jasa_penghargaan"   />
                        @error('nama_tanda_jasa_penghargaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="no_sk-id-column">No Surat Keputusan</label>
                            <input type="text" value="{{ $data->no_sk }}" id="no_sk-id-column" class="required form-control @error('no_sk') is-invalid @enderror"name="no_sk"   />
                            @error('no_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_sk-id-column">Tanggal Surat Keputusan</label>
                            <input type="date" value="{{ $data->tanggal_sk }}" id="tanggal_sk-id-column" class="required form-control @error('tanggal_sk') is-invalid @enderror" name="tanggal_sk"  />
                            @error('tanggal_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="no_piagam-id-column">Nomor Piagam</label>
                            <input type="text" value="{{ $data->no_piagam }}" id="no_piagam-id-column" class="required form-control @error('no_piagam') is-invalid @enderror" name="no_piagam"  />
                            @error('no_piagam')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_piagam-id-column">Tanggal Piagam</label>
                            <input type="date" value="{{ $data->tanggal_piagam }}" id="tanggal_piagam-id-column" class="required form-control @error('tanggal_piagam') is-invalid @enderror" name="tanggal_piagam"  />
                            @error('tanggal_piagam')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="badan_instansi_yg_memberikan-id-column">Badan Instansi Yang Memberikan</label>
                            <input type="text" value="{{ $data->badan_instansi_yg_memberikan }}" id="badan_instansi_yg_memberikan-id-column" class="required form-control @error('badan_instansi_yg_memberikan') is-invalid @enderror" name="badan_instansi_yg_memberikan"  />
                            @error('badan_instansi_yg_memberikan')
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
