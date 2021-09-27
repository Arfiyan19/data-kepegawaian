@extends('layouts.app')
@section('title','RIWAYAT KELUARGA')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT KELUARGA</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-keluarga') }}">RIWAYAT KELUARGA</a>
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
            <h4 class="card-title">Edit Riwayat Keluarga</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-keluarga.update',$data->id)  }}" method="post" enctype="multipart/form-data">
                
                @csrf
              @method('put')

                <div class="row">
                <div class="col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-post">Hubungan Keluarga</label>
                        <select name="id_hub_kepala_keluarga" id="id_hub_kepala_keluarga"  class="required form-control dt-post  @error('id_hub_kepala_keluarga') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_hub_kepala_keluarga as $row)
                            <option value="{{$row->id_hub_kepala_keluarga}}" {{ $row->id_hub_kepala_keluarga  == $data->id_hub_kepala_keluarga ? 'selected' : '' }} >{{ $row->hub_kepala_keluarga	 }}</option> 
                            @endforeach
                        </select>
                        @error('id_hub_kepala_keluarga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                </div>
                <div class="col-md-12 col-12">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap (*)</label>
                    <input type="text" value="{{ $data->nama_lengkap }}" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror " name="nama_lengkap"  />
                    @error('nama_lengkap')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                </div>
                <div class="col-md-12 col-12">
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir (*)</label>
                    <input type="date" value="{{ $data->tgl_lahir }}"  id="tgl_lahir" class="required form-control @error('tgl_lahir') is-invalid @enderror " name="tgl_lahir" />
                    @error('tgl_lahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                <div class="col-md-12 col-12">
                <div class="form-group">
                    <label for="kota_lahir">Kota Lahir (*)</label>
                    <input type="text" value="{{ $data->kota_lahir }}" id="kota_lahir" class="form-control @error('kota_lahir') is-invalid @enderror " name="kota_lahir"  />
                    @error('kota_lahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                <div class="col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-post">Pendidikan Terakhir</label>
                        <select name="id_jenjang_pendidikan" id="id_jenjang_pendidikan"  class="required form-control dt-post  @error('id_jenjang_pendidikan') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_jenjang_pendidikan as $row)
                            <option value="{{$row->id_jenjang_pendidikan}}"  {{ $row->id_jenjang_pendidikan  == $data->id_jenjang_pendidikan ? 'selected' : '' }} >{{ $row->jenjang_pendidikan	 }}</option> 
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
                    <div class="form-group row"> 
                        <div class="col-md-2">
                            <label for="contact-info"><h5>Jenis Kelamin</h5></label>
                        </div>
                        <div class="custom-control custom-radio ">
                            <input type="radio" id="validationRadiojq1" name="jenis_kelamin" value="Laki-Laki" class="required custom-control-input" {{ $data->jenis_kelamin == 2? 'checked' : '' }}>
                            <label class="custom-control-label" for="validationRadiojq1">Laki-Laki</label>
                        </div>
                        
                        <div class="custom-control custom-radio  ml-1">
                            <input type="radio" id="validationRadiojq2" name="jenis_kelamin" value="Perempuan"  class="required custom-control-input" {{ $data->jenis_kelamin == 2? 'checked' : '' }}>
                            <label class="custom-control-label" for="validationRadiojq2">Perempuan</label>
                        </div>
                        </div>
                    </div>
                <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="dokumen_riwayat_keluarga-id-column">Dokumen Pendidikan Formal</label>
                            <input type="file" id="dokumen_riwayat_keluarga-id-column" class="form-control @error('dokumen_riwayat_keluarga') is-invalid @enderror " name="dokumen_riwayat_keluarga"  />
                            @error('dokumen_riwayat_keluarga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>  
                    
                <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
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
