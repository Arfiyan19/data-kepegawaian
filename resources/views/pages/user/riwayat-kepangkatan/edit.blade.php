@extends('layouts.app')
@section('title','RIWAYAT KEPANGKATAN')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h4 class="content-header-title float-left mb-0">RIWAYAT KEPANGKATAN</h4>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-kepangkatan') }}">RIWAYAT KEPANGKATAN</a>
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
            <h5 class="card-title">Edit Riwayat Kepangkatan</h5>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-kepangkatan.update',$data->id) }}" method="post" enctype="multipart/form-data">
                
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="form-label" for="jenis_sk">Jenis SK (*)</label>
                    <select name="jenis_sk" id="jenis_sk"  class="required form-control dt-post  @error('jenis_sk') is-invalid @enderror ">
                        <option  selected disabled >Pilih</option>
                        @foreach($jenis_sk as $row)
                                <option value="{{ $row->id }}" {{ $row->id  == $data->jenis_sk ? 'selected' : '' }}>{{ $row->jenis }}</option>
                            @endforeach
                    </select>
                    @error('jenis_sk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="gelar_belakang">Gelar Belakang (*)</label>
                            <input value="{{ $data->gelar_belakang }}" type="text" id="gelar_belakang" class="required form-control @error('gelar_belakang') is-invalid @enderror " name="gelar_belakang" />
                            @error('gelar_belakang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="gelar_depan">Gelar Depan (*)</label>
                            <input type="text"  value="{{ $data->gelar_depan }}" id="gelar_depan" class="required form-control @error('gelar_depan') is-invalid @enderror " name="gelar_depan" />
                            @error('gelar_depan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="pangkat">Pangkat (*)</label>
                    <select name="pangkat" id="pangkat"  class=" required form-control dt-post  @error('pangkat') is-invalid @enderror ">
                        <option  selected disabled >Pilih</option>
                        @foreach($pangkat as $row)
                            <option value="{{ $row->id }}"  {{ $row->id  == $data->pangkat ? 'selected' : '' }}>{{ $row->nama_pangkat }}</option>
                        @endforeach
                    </select>
                    @error('pangkat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="no_sk">No. SK (*)</label>
                            <input type="text"  value="{{ $data->no_sk }}" id="no_sk" class="required form-control @error('no_sk') is-invalid @enderror " name="no_sk" />
                            @error('no_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="tgl_sk">Tgl Sk (*)</label>
                            <input type="date"  value="{{ $data->tgl_sk }}" id="tgl_sk" class="required form-control @error('tgl_sk') is-invalid @enderror " name="tgl_sk" />
                            @error('tgl_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tmt">TMT (*)</label>
                    <input type="date"  value="{{ $data->tmt }}" id="tmt" class="required form-control @error('tmt') is-invalid @enderror " name="tmt" />
                    @error('tmt')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="no_persetujuan">No. Persetujuan (*)</label>
                            <input type="number"   value="{{ $data->no_persetujuan }}" id="no_persetujuan" class="required form-control @error('no_persetujuan') is-invalid @enderror " name="no_persetujuan" />
                            @error('no_persetujuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="tgl_persetujuan">Tgl Persetujuan (*)</label>
                            <input type="date"  value="{{ $data->tgl_persetujuan }}" id="tgl_persetujuan" class="required form-control @error('tgl_persetujuan') is-invalid @enderror " name="tgl_persetujuan" />
                            @error('tgl_persetujuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <label>Masa Kerja Golongan (*)</label>
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="masa_kerja_golongan_tahun">Tahun</label>
                            <input type="number"   value="{{ $data->masa_kerja_golongan_tahun }}" id="masa_kerja_golongan_tahun" class="form-control @error('masa_kerja_golongan_tahun') is-invalid @enderror " name="masa_kerja_golongan_tahun" />
                            @error('masa_kerja_golongan_tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="masa_kerja_golongan_bulan">Bulan (*)</label>
                            <input type="date"  value="{{ $data->masa_kerja_golongan_bulan }}" id="masa_kerja_golongan_bulan" class="required form-control @error('masa_kerja_golongan_bulan') is-invalid @enderror " name="masa_kerja_golongan_bulan" />
                            @error('masa_kerja_golongan_bulan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gaji_pokok">Gaji Pokok (*)</label>
                    <input type="number"   value="{{ $data->gaji_pokok }}" id="gaji_pokok" class="required form-control @error('gaji_pokok') is-invalid @enderror " name="gaji_pokok" />
                    @error('gaji_pokok')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="nomor_sttpl">No. STTPL (*)</label>
                            <input type="number"   value="{{ $data->nomor_sttpl }}" id="nomor_sttpl" class="required form-control @error('nomor_sttpl') is-invalid @enderror " name="nomor_sttpl" />
                            <span class="text-muted">nb: untuk jenis SK-PNS</span>
                            @error('nomor_sttpl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="tgl_sttpl">Tgl STTPL (*)</label>
                            <input type="date"  value="{{ $data->tgl_sttpl }}" id="tgl_sttpl" class="required form-control @error('tgl_sttpl') is-invalid @enderror " name="tgl_sttpl" />
                            <span class="text-muted">nb: untuk jenis SK-PNS</span>
                            @error('tgl_sttpl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="nomor_kesehatan">No. Kesehatan (*)</label>
                            <input type="number"   value="{{ $data->nomor_kesehatan }}" id="nomor_kesehatan" class="required form-control @error('nomor_kesehatan') is-invalid @enderror " name="nomor_kesehatan" />
                            <span class="text-muted">nb: untuk jenis SK-PNS</span>
                            @error('nomor_kesehatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="tgl_kesehatan">Tgl Kesehatan (*)</label>
                            <input type="date"  value="{{ $data->tgl_kesehatan }}" id="tgl_kesehatan" class="required form-control @error('tgl_kesehatan') is-invalid @enderror " name="tgl_kesehatan" />
                            <span class="text-muted">nb: untuk jenis SK-PNS</span>
                            @error('tgl_kesehatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dokumen">Dokumen</label>
                    <input type="file" id="dokumen" class="form-control @error('dokumen') is-invalid @enderror " name="dokumen" />
                    @error('dokumen')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
