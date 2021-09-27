@extends('layouts.app')
@section('title','Riwayat Gaji Berkala')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Riwayat Gaji Berkala</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
<<<<<<< HEAD
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-gaji-berkala')}}">Riwayat Gaji Berkala</a>
                </li> 
=======
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-gaji-berkala') }}">Riwayat Gaji Berkala</a>
                </li>  
>>>>>>> 5a165b2de39be310b7fb38102a8d8e67bf8f7a1d
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
            <h4 class="card-title">Edit Riwayat Gaji Berkala</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-gaji-berkala.update',$data->id) }}" method="post">
         @csrf
              @method('put')
                <div class="row">
                <div class="col-md-12 col-12">
                       <h3><center>Data Kepangkatan</center></h3>
                    </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Pangkat Golongan *</label>
                        <select name="id_golongan"  id="id_golongan"  class="form-control dt-post  @error('id_golongan') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($id_golongan as $row)
                            <option value="{{$row->id_golongan}}" {{ $row->id_golongan  == $data->id_golongan ? 'selected' : '' }} >{{ $row->golongan }}</option> 
                            @endforeach
                        </select>
                        @error('id_golongan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="terhitung_tanggal_mulai_kepanggkatan-id-column">Terhitung Mulai Tanggal</label>
                            <input type="date"value="{{ $data->terhitung_tanggal_mulai_kepanggkatan }}" id="terhitung_tanggal_mulai_kepanggkatan-id-column" class="required form-control @error('terhitung_tanggal_mulai_kepanggkatan') is-invalid @enderror"name="terhitung_tanggal_mulai_kepanggkatan"   />
                            @error('terhitung_tanggal_mulai_kepanggkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="masa_kerja_gol_tahun_kepanggkatan-id-column">Masa Kerja Golongan Tahun</label>
                            <input type="text" value="{{ $data->masa_kerja_gol_tahun_kepanggkatan }}" id="masa_kerja_gol_tahun_kepanggkatan-id-column" class="required form-control @error('masa_kerja_gol_tahun_kepanggkatan') is-invalid @enderror" name="masa_kerja_gol_tahun_kepanggkatan"  />
                            @error('masa_kerja_gol_tahun_kepanggkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="masa_kerja_gol_bulan_kepanggkatan-id-column">Masa Kerja Golongan Bulan</label>
                            <input type="text" value="{{ $data->masa_kerja_gol_bulan_kepanggkatan }}" id="masa_kerja_gol_bulan_kepanggkatan-id-column" class="required form-control @error('masa_kerja_gol_bulan_kepanggkatan') is-invalid @enderror" name="masa_kerja_gol_bulan_kepanggkatan"  />
                            @error('masa_kerja_gol_bulan_kepanggkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                           <h3 > <center>Data Penggajian</center></h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="gaji_pokok_baru-id-column">Gaji Pokok Baru</label>
                            <input type="text" value="{{ $data->gaji_pokok_baru }}" id="gaji_pokok_baru-id-column" class="required form-control @error('gaji_pokok_baru') is-invalid @enderror " name="gaji_pokok_baru" />
                            @error('gaji_pokok_baru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="gaji_pokok_lama-id-column">Gaji Pokok Lama</label>
                            <input type="text"  value="{{ $data->gaji_pokok_lama }}" id="gaji_pokok_lama-id-column" class="required form-control @error('gaji_pokok_lama') is-invalid @enderror " name="gaji_pokok_lama"  />
                            @error('gaji_pokok_lama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="terhitung_tanggal_mulai_penggajian-id-column">Terhitung Mulai Tanggal</label>
                            <input type="date" value="{{ $data->terhitung_tanggal_mulai_penggajian }}" id="terhitung_tanggal_mulai_penggajian-id-columns" class="required form-control @error('terhitung_tanggal_mulai_penggajian') is-invalid @enderror "name="terhitung_tanggal_mulai_penggajian"   />
                            @error('terhitung_tanggal_mulai_penggajian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="no_sk-id-column">No Surat Keputusan (*)</label>
                            <input type="text" value="{{ $data->no_sk }}" id="no_sk-id-column" class="required form-control @error('no_sk') is-invalid @enderror " name="no_sk"  />
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
                            <input type="date" value="{{ $data->tanggal_sk }}" id="tanggal_sk-id-column" class="required form-control @error('tanggal_sk') is-invalid @enderror"name="tanggal_sk"   />
                            @error('tanggal_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="masa_kerja_gol_tahun_penggajian-id-column">Masa Kerja Golongan (Tahun)</label>
                            <input type="text" value="{{ $data->masa_kerja_gol_tahun_penggajian }}" id="masa_kerja_gol_tahun_penggajian-id-column" class="required form-control @error('masa_kerja_gol_tahun_penggajian') is-invalid @enderror" name="masa_kerja_gol_tahun_penggajian" />
                                <span class="invalid-feedback" role="alert">
                                @error('masa_kerja_gol_tahun_penggajian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="masa_kerja_gol_bulan_penggajian-id-column">Masa Kerja Golongan (Bulan) </label>
                            <input type="text" value="{{ $data->masa_kerja_gol_bulan_penggajian }}" id="masa_kerja_gol_bulan_penggajian-id-column" class="form-control @error('masa_kerja_gol_bulan_penggajian') is-invalid @enderror "   name="masa_kerja_gol_bulan_penggajian"  />
                            <span class="invalid-feedback" role="alert">
                                @error('masa_kerja_gol_bulan_penggajian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </span>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="keterangan_jabatan-id-column">Keterangan Jabatan</label>
                            <input type="text" value="{{ $data->keterangan_jabatan }}" id="keterangan_jabatan-id-column" class="required form-control @error('keterangan_jabatan') is-invalid @enderror " name="keterangan_jabatan"  />
                            <span class="invalid-feedback" role="alert">
                                @error('keterangan_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </span>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="pejabat_dan_jabatan_penandatangan_kgb-id-column">Pejabat & Jabatan Pendatatanganan KGB</label>
                            <input type="text" value="{{ $data->pejabat_dan_jabatan_penandatangan_kgb }}" id="pejabat_dan_jabatan_penandatangan_kgb-id-column" class="required form-control @error('pejabat_dan_jabatan_penandatangan_kgb') is-invalid @enderror " name="pejabat_dan_jabatan_penandatangan_kgb"  />
                            <span class="invalid-feedback" role="alert">
                                @error('pejabat_dan_jabatan_penandatangan_kgb')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </span>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label for="keterangan-id-column">Keterangan</label>
                            <input type="text" value="{{ $data->keterangan }}" id="keterangan-id-column" class="required form-control @error('keterangan') is-invalid @enderror " name="keterangan"  />
                            <span class="invalid-feedback" role="alert">
                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </span>
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
