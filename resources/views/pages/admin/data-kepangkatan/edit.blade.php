@extends('layouts.app')
@section('title','Setujui Data Cuti')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Setujui Data Asuransi</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Setujui Data Cuti
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
            <td>Jenis SK :</td>
            <td>{{ $data->jenis_sk }}</td>
        </tr>
        <tr>
            <td>Gelar Belakang :</td>
            <td>{{ $data->gelar_belakang }}</td>
        </tr>
        <tr>
            <td>Gelar Depan :</td>
            <td>{{ $data->gelar_depan }}</td>
        </tr>
        <tr>
            <td>Tgl sttpl :</td>
            <td>{{ $data->tgl_sttpl }}</td>
        </tr>
        <tr>
            <td>Nomor sttpl :</td>
            <td>{{ $data->nomor_sttpl }}</td>
        </tr>
        <tr>
            <td>No sk :</td>
            <td>{{ $data->no_sk }}</td>
        </tr>
        <tr>
            <td>TMT :</td>
            <td>{{ $data->tmt }}</td>
        </tr>
        <tr>
            <td>No persetujuan :</td>
            <td>{{ $data->no_persetujuan }}</td>
        </tr>
        <tr>
            <td>Masa kerja golongan tahun :</td>
            <td>{{ $data->masa_kerja_golongan_tahun }}</td>
        </tr>
        <tr>
            <td>Masa kerja golongan bulan :</td>
            <td>{{ $data->masa_kerja_golongan_bulan }}</td>
        </tr>
        <tr>
            <td>Gaji Pokok :</td>
            <td>{{ $data->gaji_pokok }}</td>
        </tr>
        <tr>
            <td>Nomor kesehatan :</td>
            <td>{{ $data->nomor_kesehatan }}</td>
        </tr>
        <tr>
            <td>Tanggal Kesehatan :</td>
            <td>{{ $data->tgl_kesehatan }}</td>
        </tr>
        <tr>
            <td>Gaji Pokok :</td>
            <td>{{ $data->gaji_pokok }}</td>
        </tr>
        <tr>
            <td>Dokumen :</td>
            <td><a href="{{ asset('/images/riwayat-kepangkatan/'.$data->dokumen) }}">{{ $data->dokumen }}</a></td>
        </tr>
        <form class="form"  id="dataForm" action="{{ route('data-cuti.update',$data->id) }}" method="post">
            @method('PUT')
    
                @csrf
              <input type="hidden" value="{{ $data->jenis_sk }}" name="title">
                <input type="hidden" value="{{ $data->user_id }}" name="user_id">
        <tr>
            <td>Status Validasi :</td>
            <td> 
                <div class="form-group">
                     
                    <select required  name="status_validasi" id="status_validasi"  class="required form-control dt-post  @error('status_validasi') is-invalid @enderror "> 
                       
                        <option value="1" {{ $data->status  == 1  ? 'selected' : '' }}>Berhasil Di Validasi</option>
                        <option value="2" {{ $data->status  == 2  ? 'selected' : '' }}>Tidak Di Setujui </option>

                       
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
            <td>Keterang Jika Tidak Di Setujui</td>
            <td>
            <div class="form-floating">
            <textarea class="form-control" name="keterangan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
           
            </div>
            </td>
        </tr>
    </table>
    <div class="col-12">
        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
        <a  href="{{ route('data-asesmen-kompetensi.edit', $dataPegawai->user_id) }}"  class="btn btn-outline-secondary">Kembali</a>
    
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