@extends('layouts.app')
@section('title','Validasi Data Pendidakan Formal')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Validasi Data Pendidakan Formal</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Validasi Data Pendidakan Formal
                </li>
            </ol>
        </div>
    </div>
</div>
</div>
<div class="card col-md-12" >
  <div class="card-body">
    <h5 class="card-title">Nama : {{ $dataPegawai->nama_pegawai}}</h5>
    
    <table class="table">
        <tr>
            <td>Nama Lembaga Pendidkan  :</td>
            <td>{{ $data->nama_lembaga_pendidikan }}</td>
        </tr>
        <tr>
            <td>Tempat Lembaga Pendidkan :</td>
            <td>{{ $data->tempat_lembaga_pendidikan }}</td>
        </tr>
        <tr>
            <td>Nama Kepala Lembaga Pendidkan :</td>
            <td>{{ $data->nama_kepala_lembaga_pendidikan }}</td>
        </tr>
        <tr>
            <td>Gelar :</td>
            <td>{{ $data->gelar }}</td>
        </tr>
        <tr>
            <td>No Ijazah Sertifikat :</td>
            <td>{{ $data->no_ijazah_sertifikat }}</td>
        </tr><tr>
            <td>Tanggal Ijazah Sertifikat :</td>
            <td>{{ $data->tanggal_ijazah_sertifikat }}</td>
        </tr><tr>
            <td>Atas Izin Pemimpin :</td>
            <td>{{ $data->atas_izin_pimpinan }}</td>
        </tr><tr>
            <td>SK :</td>
            <td>{{ $data->sk }}</td>
        </tr>
        <tr>
            <td>Tanggal SK :</td>
            <td>{{ $data->tanggal_sk }}</td>
        </tr>
        <tr>
            <td>Jenjang Pendidkan :</td>
            <td>{{ $data->jenjang_pendidikan }}</td>
        </tr>
        <tr>
            <td>Nama Detail Jenjang Pendidikan  :</td>
            <td>{{ $data->nama_detail_jenjang_pendidikan }}</td>
        </tr>
        <tr>
            <td>Biaya Belajar :</td>
            <td>{{ $data->biaya_belajar }}</td>
        </tr>
        <tr>
            <td>Dokumen :</td>
            <td><a href="{{ asset('/images/riwayat-pendidikan-formal/'.$data->dokumen_pendidikan_formal) }}">{{ $data->dokumen_pendidikan_formal }}</a></td>
        </tr>
        <form class="form"  id="dataForm" action="{{ route('data-pendidikan-formal.update',$data->id_riwayat) }}" method="post">
            @method('PUT')
    
                @csrf
              <input type="hidden" value="{{ $data->nama_lembaga_pendidikan }}  " name="title">
                <input type="hidden" value="{{ $data->user_id }}" name="user_id">
        <tr>
            <td>Status Validasi :</td>
            <td> 
                <div class="form-group">
                     
                    <select required  name="status_validasi" id="status_validasi"  class="required form-control dt-post  @error('status_validasi') is-invalid @enderror "> 
                       
                        <option value="1" {{ $data->status  == 1  ? 'selected' : '' }}>Berhasil Di Validasi</option>
                        <option value="2" {{ $data->status  == 2  ? 'selected' : '' }}>Tidak Di Validasi </option>

                       
                </select>  
                @error('status_validasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </td>
        </tr>
        <tr>
            <td>Keterang Jika Tidak Di Validasi</td>
            <td>
            <div class="form-floating">
            <textarea class="form-control" name="keterangan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
           
            </div>
            </td>
        </tr>
    </table>
    <div class="col-12">
        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
        <a  href="{{ route('data-pendidikan-formal.show', $dataPegawai->user_id) }}"  class="btn btn-outline-secondary">Kembali</a>
    
    </div>
    </form>
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
