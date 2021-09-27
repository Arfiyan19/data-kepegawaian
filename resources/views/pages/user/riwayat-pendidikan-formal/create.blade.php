@extends('layouts.app')
@section('title','RIWAYAT PENDIDIKAN FORMAL')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT PENDIDIKAN FORMAL</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-pendidikan-formal')}}">Riwayat Pendidikan Formal </a>
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
            <h4 class="card-title">Tambah Riwayat Pendidikan Formal</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-pendidikan-formal.store') }}" method="post" enctype="multipart/form-data">
                
                @csrf
                <div class="row">
                <div class="col-md-12 col-12">
                       <h3><center>DATA PENDIDIKAN</center></h3>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Jenis Pendidikan</label>
                        <select name="id_jenjang_pendidikan" id="id_jenjang_pendidikan"  class="required form-control dt-post  @error('id_jenjang_pendidikan') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_jenjang_pendidikan as $row)
                            <option value="{{$row->id_jenjang_pendidikan}}"  >{{ $row->jenjang_pendidikan	 }}</option> 
                            @endforeach
                        </select>
                        @error('id_jenjang_pendidikan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Pendidikan</label>
                        <select name="id_detail_jenjang_pendidikan" id="id_detail_jenjang_pendidikan"  class="required form-control dt-post  @error('id_detail_jenjang_pendidikan') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_detail_jenjang_pendidikan as $row)
                            <option value="{{$row->id_detail_jenjang_pendidikan}}"  >{{ $row->nama_detail_jenjang_pendidikan }}</option> 
                            @endforeach
                        </select>
                        @error('id_detail_jenjang_pendidikan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama_lembaga_pendidikan-id-column">Nama Lembaga Pendidikan</label>
                            <input type="text"  id="nama_lembaga_pendidikan-id-column" class="required form-control @error('nama_lembaga_pendidikan') is-invalid @enderror" name="nama_lembaga_pendidikan" />
                            @error('nama_lembaga_pendidikan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tempat_lembaga_pendidikan-id-column">Tempat Lembaga Pendidikan</label>
                            <input type="text"  id="tempat_lembaga_pendidikan-id-column" class="required form-control @error('tempat_lembaga_pendidikan') is-invalid @enderror" name="tempat_lembaga_pendidikan" />
                            @error('tempat_lembaga_pendidikan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama_kepala_lembaga_pendidikan-id-column">Nama Kepala Lembaga Pendidikan</label>
                            <input type="text"  id="nama_kepala_lembaga_pendidikan-id-column" class="required form-control @error('nama_kepala_lembaga_pendidikan') is-invalid @enderror" name="nama_kepala_lembaga_pendidikan" />
                            @error('nama_kepala_lembaga_pendidikan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="gelar-id-column">Gelar</label>
                            <input type="text"  id="gelar-id-column" class="required form-control @error('gelar') is-invalid @enderror" name="gelar" />
                            @error('gelar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="no_ijazah_sertifikat-id-column">Nomor Ijazah/Sertifikat</label>
                            <input type="text"  id="no_ijazah_sertifikat-id-column" class="required form-control @error('no_ijazah_sertifikat') is-invalid @enderror" name="no_ijazah_sertifikat" />
                            @error('no_ijazah_sertifikat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_ijazah_sertifikat-id-column">Tanggal Ijazah/Sertifikat</label>
                            <input type="date"  id="tanggal_ijazah_sertifikat-id-column" class="required form-control @error('tanggal_ijazah_sertifikat') is-invalid @enderror" name="tanggal_ijazah_sertifikat" />
                            @error('tanggal_ijazah_sertifikat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Biaya Belajar *</label>
                        <select name="id_biaya_belajar" id="id_biaya_belajar"  class="required form-control dt-post  @error('id_biaya_belajar') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_biaya_belajar as $row)
                            <option value="{{$row->id_biaya_belajar}}"  >{{ $row->biaya_belajar }}</option> 
                            @endforeach
                        </select>
                        @error('id_biaya_belajar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                       <h3><center>Data Izin</center></h3>
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group row"> 
                        <div class="col-md-2">
                            <label for="contact-info">Atas Izin Pimpinan</label>
                        </div>
                        <div class="custom-control custom-radio ">
                            <input type="radio" id="validationRadiojq1" name="atas_izin_pimpinan" value="ya" class="required custom-control-input">
                            <label class="custom-control-label" for="validationRadiojq1">YA</label>
                        </div>
                        
                        <div class="custom-control custom-radio  ml-1">
                            <input type="radio" id="validationRadiojq2" name="atas_izin_pimpinan" value="tidak_perlu"  class="required custom-control-input">
                            <label class="custom-control-label" for="validationRadiojq2">TIDAK PERLU</label>
                        </div>
                        
                        <div class="custom-control custom-radio  ml-1">
                            <input type="radio" id="validationRadiojq3" name="atas_izin_pimpinan" value="tidak"  class="required custom-control-input">
                            <label class="custom-control-label" for="validationRadiojq3">TIDAK </label>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="sk-id-column">Surat Keputusan</label>
                            <input type="text"  id="sk-id-column" class="required form-control @error('sk') is-invalid @enderror" name="sk" />
                            @error('sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_sk-id-column">Tanggal Surat Keputusan</label>
                            <input type="date"  id="tanggal_sk-id-column" class="required form-control @error('tanggal_sk') is-invalid @enderror" name="tanggal_sk" />
                            @error('tanggal_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="dokumen_pendidikan_formal-id-column">Dokumen Pendidikan Formal</label>
                            <input type="file" id="dokumen_pendidikan_formal-id-column" class="required form-control @error('dokumen_pendidikan_formal') is-invalid @enderror " name="dokumen_pendidikan_formal"  />
                            @error('dokumen_pendidikan_formal')
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
