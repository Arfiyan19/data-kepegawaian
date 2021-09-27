@extends('layouts.app')
@section('title','Riwayat Organisasi')
@push('before-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h4 class="content-header-title float-left mb-0">RIWAYAT ORGANISASI</h4>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
<<<<<<< HEAD
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-organisasi') }}">Riwayat Organisasi</a>
                </li> 
                    <li class="breadcrumb-item active">Create
=======
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-organisasi') }}">RIWAYAT ORGANISASI</a>
                </li>  
                <li class="breadcrumb-item active">Create
>>>>>>> 5a165b2de39be310b7fb38102a8d8e67bf8f7a1d
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
<<<<<<< HEAD
            <h4 class="card-title">Tambah Organisasi</h4>
=======
            <h4 class="card-title">Tambah Informasi Organisasi</h4>
>>>>>>> 5a165b2de39be310b7fb38102a8d8e67bf8f7a1d
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-organisasi.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama_organisasi_lembaga-id-column">Nama Organisasi / Lembaga (*)</label>
                            <input type="text"  id="nama_organisasi_lembaga-id-column" class="required form-control @error('nama_organisasi_lembaga') is-invalid @enderror" name="nama_organisasi_lembaga" />
                            @error('nama_organisasi_lembaga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Jenis Organisasi</label>
                        <select name="id_jenis_organisasi" id="id_jenis_organisasi"  class="required form-control dt-post  @error('id_jenis_organisasi') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_jenis_organisasi as $row)
                            <option value="{{$row->id_jenis_organisasi}}"  >{{ $row->jenis_organiasi }}</option> 
                            @endforeach
                        </select>
                        @error('id_jenis_organisasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Kedudukan Dalam Organisasi</label>
                        <select name="id_kedudukan_organiasi" id="id_kedudukan_organiasi"  class="required form-control dt-post  @error('id_kedudukan_organiasi') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_kedudukan_organiasi as $row)
                            <option value="{{$row->id_kedudukan_organiasi}}"  >{{ $row->kedudukan_organiasi}}</option> 
                            @endforeach
                        </select>
                        @error('id_kedudukan_organiasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tempat_kedudukan_organisasi-id-column">Tempat Kedudukan Organisasi</label>
                            <input type="text" id="tempat_kedudukan_organisasi-id-column" class="required form-control @error('tempat_kedudukan_organisasi') is-invalid @enderror " name="tempat_kedudukan_organisasi"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_mulai-id-column">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai-id-column" class="required form-control @error('tanggal_mulai') is-invalid @enderror "name="tanggal_mulai"   />
                          
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_berakhir-id-column">Tanggal Berakhir </label>
                            <input type="date" id="tanggal_berakhir-id-column" class="required form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_berakhir"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="surat_keputusan-id-column">Surat Keputusan</label>
                            <input type="text" id="surat_keputusan-id-column" class="required form-control @error('surat_keputusan') is-invalid @enderror" name="surat_keputusan"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_surat_keputusan-id-column">Tanggal Surat Keputusan (*)</label>
                            <input type="date" id="tanggal_surat_keputusan-id-column" class="required form-control @error('tanggal_surat_keputusan') is-invalid @enderror " name="tanggal_surat_keputusan"  />
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
