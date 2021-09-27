@extends('layouts.app')
@section('title','Informasi Pegawai')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Informasi Pegawai</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Informasi Pegawai
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
            <h4 class="card-title">LK01 - INFORMASI PEGAWAI</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('informasi-pegawai.update',$data->id) }}" method="post" enctype="multipart/form-data">>
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label >NIP (*)</label>
                            <input type="text" value="{{ $data->nip }}" class="required form-control @error('nip') is-invalid @enderror " name="nip" />
                            @error('nip')   
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="id_pgw" value="{{ $data->id_pgw }}">
                    <input type="hidden" name="id_phone" value="{{ $data->id_phone }}">
                    <input type="hidden" name="id_detail" value="{{ $data->id_detail }}">
                    <input type="hidden" name="id_email" value="{{ $data->id_email }}">


                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label >NIP Lama (9 digit) </label>
                            <input type="text" value="{{ $data->nip_lama }}"  class="form-control @error('nip_lama') is-invalid @enderror "   name="nip_lama"   />
                            @error('nip_lama')
                                <span class="invalid-feedback"  role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-id-column">Nama Pegawai (*)</label>
                            <input type="text"  value="{{ $data->nama_pegawai }}"  id="nama-id-column"  class="required form-control @error('nama_pegawai') is-invalid @enderror " name="nama_pegawai"  />
                            @error('nama_pegawai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="pegawai-id-column">Gelar Depan</label>
                            <input type="text"  value="{{ $data->gelar_depan }}"  id="pegawai-id-column" class="form-control @error('gelar_depan') is-invalid @enderror " name="gelar_depan"   />
                            @error('gelar_depan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="gelar_belakang-id-column">Gelar Belakang</label>
                            <input type="text"  value="{{ $data->gelar_belakang }}"   id="gelar_belakang-id-column" class="form-control @error('gelar_belakang') is-invalid @enderror " name="gelar_belakang" />
                            @error('gelar_belakang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="kartu-pegawai-id-column">No Kartu Pegawai</label>
                            <input type="text"  value="{{ $data->no_kartu_pegawai }}"  id="kartu-pegawai-id-column" class="form-control @error('no_kartu_pegawai') is-invalid @enderror " name="no_kartu_pegawai"  />
                            @error('no_kartu_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tempat-lahir-id-column">Tempat Lahir</label>
                            <input type="text" id="tempat-lahir-id-column"  value="{{ $data->tempat_lahir }}"  class="form-control @error('tempat_lahir') is-invalid @enderror " name="tempat_lahir"  />
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tanggal-lahir-id-column">Tanggal Lahir (*)</label>
                            <input type="date" id="tanggal-lahir-id-column"  value="{{ $data->tanggal_lahir }}"  class="required form-control @error('tanggal_lahir') is-invalid @enderror " name="tanggal_lahir"  />
                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group row"> 
                        <div class="col-md-2">
                            <label for="contact-info">Jenis kelamin</label>
                        </div>
                        <div class="custom-control custom-radio ">
                            <input type="radio" id="validationRadiojq1"   name="jenis_kelamin" value="1" class="custom-control-input"  {{ $data->id_jenis_kelamin  == 1? 'checked' : '' }}>
                            <label class="custom-control-label" for="validationRadiojq1">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio  ml-1">
                            <input type="radio" id="validationRadiojq2" name="jenis_kelamin" value="2"  class="custom-control-input"  {{ $data->id_jenis_kelamin  == 2? 'checked' : '' }}>
                            <label class="custom-control-label" for="validationRadiojq2">Perempuan</label>
                        </div>
                        </div>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Agama</label>
                        <select name="id_agama" id="id_agama"  class="form-control dt-post  @error('id_agama') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($agama as $row)
                            <option value="{{ $row->id_agama }}"  {{ $data->id_agama  == $row->id_agama ? 'selected' : '' }} >{{ $row->agama }}</option> 
                            @endforeach
                        </select>
                        @error('id_agama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Disabilitas</label>
                        <select name="id_disabilitas" id="id_disabilitas"  class="form-control dt-post  @error('id_disabilitas') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($jenis_disabilitas as $row)
                            <option value="{{ $row->id_disabilitas }}" {{ $data->id_disabilitas  == $row->id_disabilitas ? 'selected' : '' }} >{{ $row->jenis_disabilitas }}</option> 
                            @endforeach
                        </select>
                        @error('id_disabilitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="npwp-id-column">NPWP</label>
                            <input type="text"  value="{{ $data->npwp }}" id="npwp-id-column" class="form-control @error('npwp') is-invalid @enderror " name="npwp"  />
                            @error('npwp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="no_ktp-id-column">No. KTP</label>
                            <input type="text"  value="{{ $data->no_ktp }}" id="no_ktp-id-column" class="form-control @error('no_ktp') is-invalid @enderror " name="no_ktp"  />
                            @error('no_ktp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="golongan_darah-id-column">Gologan Darah</label>
                            <input type="text"  value="{{ $data->golongan_darah }}" id="golongan_darah-id-column" class="form-control @error('golongan_darah') is-invalid @enderror " name="golongan_darah"  />
                            @error('golongan_darah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="telepon-id-column">Telepon</label>
                            <input type="text"   value="{{ $data->number_1 }}" id="telepon-id-column" class="form-control @error('telepon') is-invalid @enderror " name="telepon"  />
                            @error('telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="hadnphone_1-id-column">Hadnphone 1</label>
                            <input type="text"  value="{{ $data->number_2 }}" id="hadnphone_1-id-column" class="form-control @error('hadnphone_1') is-invalid @enderror " name="hadnphone_1"  />
                            @error('hadnphone_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="hadnphone_2-id-column">Hadnphone 2</label>
                            <input type="text"  value="{{ $data->number_3 }}" id="hadnphone_2-id-column" class="form-control @error('hadnphone_2') is-invalid @enderror " name="hadnphone_2"  />
                            @error('hadnphone_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="email_1-id-column">Email Kemensos </label>
                            <input type="email" value="{{ $data->email_1 }}" id="email_1-id-column" value="{{ Auth::user()->email }}" class="form-control @error('email_1') is-invalid @enderror " name="email_1"  />
                            @error('email_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="email_2-id-column">Email Lain </label>
                            <input type="email" value="{{ $data->email_2 }}"  id="email_2-id-column" class="form-control @error('email_2') is-invalid @enderror " name="email_2"  />
                            @error('email_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="foto_bpjs-id-column">Foto BPJS </label>
                            <input type="file" id="foto_bpjs-id-column" class="form-control @error('foto_bpjs') is-invalid @enderror " name="foto_bpjs"  />
                            <img  style="width: 100px;" src="{{ asset('images/informasi_pegawai/'.$data->foto_bpjs) }}" alt="" srcset="">
                            @error('foto_bpjs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="foto_ktp-id-column">Foto KTP </label>
                            <input type="file" id="foto_ktp-id-column" class="form-control @error('foto_ktp') is-invalid @enderror " name="foto_ktp"  />
                            <img  style="width: 100px;" src="{{ asset('images/informasi_pegawai/'.$data->foto_ktp) }}" alt="" srcset="">

                            @error('foto_ktp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="dokumen-id-column"> Dokumen </label>
                            <input type="file" id="dokumen-id-column" class="form-control @error('dokumen') is-invalid @enderror " name="dokumen"  />
                            <img  style="width: 100px;" src="{{ asset('images/informasi_pegawai/'.$data->document) }}" alt="" srcset="">

                            @error('dokumen')
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
@include('sweet::alert')

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
