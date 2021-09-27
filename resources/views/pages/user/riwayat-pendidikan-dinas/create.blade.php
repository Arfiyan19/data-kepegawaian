@extends('layouts.app')
@section('title','Riwayat Pendidikan Dinas Dan Pelatihan Dinas')
@push('before-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h4 class="content-header-title float-left mb-0">Riwayat Pendidikan Dinas Dan Pelatihan Dinas</h4>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-pendidikan-dinas') }}">Riwayat Pendidikan Dinas Dan Pelatihan Dinas</a>
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
            <h4 class="card-title">LK05- Riwayat Pendidikan Dinas Dan Pelatihan Dinas</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-pendidikan-dinas.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <H3 style="color: black; background-color: #b3d7ef;"><center>PEMUTAKHIRAN DATA RIWAYAT PENDIDIKAN DINAS </center> </H3>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Jenis Diklat</label>
                        <select name="jenis_diklat" id=""  class="form-control " name="jenis_diklat">
                            <option  selected disabled >Pilih</option>
                             @foreach($jenis_diklat as $row)
                                <option value="{{ $row->id_jenis_diklat }}">{{ $row->jenis_diklat }}</option>
                                @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-id-column">Lembaga Penyelenggara Diklat</label>
                            <input type="text" id="nama-id-column" class="form-control  " name="lembaga_penyelenggara"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-id-column">Lokasi</label>
                            <input type="text" id="nama-id-column" class="form-control  " name="lokasi"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="pegawai-id-column">Tanggal Mulai</label>
                            <input type="date" id="pegawai-id-column" class="form-control" name="tanggal_mulai"   />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal-lahir-id-column">Tanggal Berakhir </label>
                            <input type="date" id="tanggal-lahir-id-column" class="form-control  " name="tanggal_berakhir"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-id-column">No SK Kelulusan *</label>
                            <input type="text" id="-" class="form-control  " name="no_sk_kelulusan"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-id-column">Jam Latihan </label>
                            <input type="text" id="-" class="form-control  " name="jam_latihan"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal-lahir-id-column">Tanggal SK Kelulusan (*)</label>
                            <input type="date" id="tanggal-lahir-id-column" class="form-control  " name="tangal_sk_kelulusan"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-id-column">No Sertifikat </label>
                            <input type="text" id="-" class="form-control  " name="no_sertifikat"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal-lahir-id-column">Tanggal No.Sertifikat</label>
                            <input type="date" id="tanggal-lahir-id-column" class="form-control  " name="tanggal_no_sertifikat"  />
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
