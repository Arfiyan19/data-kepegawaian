@extends('layouts.app')
@section('title','Setujui Data Jabatan')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Setujui Data Jabatan</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Setujui Data Jabatan
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
            <td>Pendidikan Terakhir :</td>
            <td>{{ $data->nama_unit_organisasi }}</td>
        </tr>
        <tr>
            <td>Nama Kantor :</td>
            <td>{{ $data->nama_kantor }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>
                        @foreach(DB::table('collection_riwayat_jabatan')
                        ->where('no_sk', $data->no_sk)
                        ->leftJoin('master_jabatan', 'master_jabatan.id', '=', 'collection_riwayat_jabatan.id_jabatan')
                        ->get() as $jabatan)
                            {{ $jabatan->nama }},
                        @endforeach
                    </td>
        </tr>
        <tr>
            <td>Tanggal Tmt :</td>
            <td>{{ $data->tgl_tmt }}</td>
        </tr>
        <tr>
        <tr>
            <td>No Dan Tanggal SK :</td>
            <td>
                        <span>{{ $data->no_sk }}</span>
                        <span>{{ $data->tgl_sk }}</span>
                    </td>
        </tr>
        <?php
                        $dump = DB::table('detail_riwayat_jabatan')->where('no_sk', $data->no_sk)
                        ->leftJoin('master_diterbitkan'                 , 'master_diterbitkan.id'                   , '=', 'detail_riwayat_jabatan.id_master_diterbitkan')
                        ->leftJoin('master_pangkat'                     , 'master_pangkat.id'                       , '=', 'detail_riwayat_jabatan.id_master_pangkat')
                        ->leftJoin('master_induk_unit_kerja'            , 'master_induk_unit_kerja.id'              , '=', 'detail_riwayat_jabatan.id_master_induk_unit_kerja')
                        ->leftJoin('master_unit_organisasi'             , 'master_unit_organisasi.id'               , '=', 'detail_riwayat_jabatan.id_master_unit_organisasi')
                        ->leftJoin('master_jenis_jabatan'               , 'master_jenis_jabatan.id'                 , '=', 'detail_riwayat_jabatan.id_master_jenis_jabatan')
                        ->leftJoin('master_group_fungsional'            , 'master_group_fungsional.id'              , '=', 'detail_riwayat_jabatan.id_master_group_fungsional')
                        ->leftJoin('master_jabatan_fungsional_tertentu' , 'master_jabatan_fungsional_tertentu.id'   , '=', 'detail_riwayat_jabatan.id_master_jabatan_fungsional_tertentu')
                        ->leftJoin('master_jabatan_fungsional_umum'     , 'master_jabatan_fungsional_umum.id'       , '=', 'detail_riwayat_jabatan.id_master_jabatan_fungsional_umum')
                        ->leftJoin('master_status_jabatan'              , 'master_status_jabatan.id'                , '=', 'detail_riwayat_jabatan.id_master_status_jabatan')
                        ->leftJoin('master_alasan_jabatan_sementara'    , 'master_alasan_jabatan_sementara.id'      , '=', 'detail_riwayat_jabatan.id_master_alasan_jabatan_sementara')
                        ->select([
                            'detail_riwayat_jabatan.*',
                            'master_diterbitkan.nama as diterbitkan',
                            'master_pangkat.nama as pangkat',
                            'master_induk_unit_kerja.nama as induk_unit_kerja',
                            'master_unit_organisasi.nama as unit_organisasi',
                            'master_jenis_jabatan.nama as jenis_jabatan',
                            'master_group_fungsional.nama as group_fungsional',
                            'master_jabatan_fungsional_tertentu.nama as jabatan_fungsional_tertentu',
                            'master_jabatan_fungsional_umum.nama as jabatan_fungsional_umum',
                            'master_status_jabatan.nama as status_jabatan',
                            'master_alasan_jabatan_sementara.nama as alasan_jabatan_sementara',
                        ])
                        ->first();
                    ?>
        <tr>
        <tr>
            <td>Diterbitkan :</td>
            <td>{{ $dump->diterbitkan }}</td>
        </tr>
        <tr>
        <tr>
            <td>Pengkat :</td>
            <td>{{ $dump->pangkat }}</td>

        </tr>
        <tr>
        <tr>
            <td>Indux Unit Kerja :</td>
            <td>{{ $dump->induk_unit_kerja }}</td>
        </tr>
        <tr>
        <tr>
            <td>Unit Organisasi :</td>
            <td>{{ $dump->unit_organisasi }}</td>
        </tr>
        <tr>
        <tr>
            <td>Jenis Jabatan :</td>
            <td>{{ $dump->jenis_jabatan }}</td>
        </tr>
        <tr>
        <tr>
            <td>Jenis Jabatan :</td>
            <td>{{ $dump->keterangan_jabatan }}</td>
        </tr>
        <tr>
        <tr>
            <td>Grup Fungsional :</td>
            <td>{{ $dump->group_fungsional }}</td>
        </tr>
        <tr>
        <tr>
            <td>Jabatan Fungsional Tertentu:</td>
            <td>{{ $dump->jabatan_fungsional_tertentu }}</td>

        </tr>
        <tr>
        <tr>
            <td>Jabatan Fungsional Umum:</td>
            <td>{{ $dump->jabatan_fungsional_umum }}</td>
        </tr>
        <tr>
        <tr>
            <td>Status Jabatan Jabatan :</td>
            <td>{{ $dump->status_jabatan }}</td>
        </tr>
        <tr>
        <tr>
            <td>Alasan Jabatan Sementara :</td>
            <td>{{ $dump->alasan_jabatan_sementara }}</td>
        </tr>
        <tr>
        <tr>
            <td>Catatan :</td>
            <td>{{ $dump->catatan }}</td>
        </tr>
        <form class="form"  id="dataForm" action="{{ route('data-jabatan.update',$data->id) }}" method="post">
            @method('PUT')
    
                @csrf
              <input type="hidden" value="{{ $data->nama_unit_organisasi }}" name="title">
                <input type="hidden" value="{{ $data->user_id }}" name="user_id">
        <tr>
            <td>Status Validasi :</td>
            <td> 
                <div class="form-group">
                     
                    <select required  name="status_validasi" id="status_validasi"  class="required form-control dt-post  @error('status_validasi') is-invalid @enderror "> 
                       
                         <option value="1" {{ $data->status  == 1  ? 'selected' : '' }}>Berhasil Di Validasi</option>
                        <option value="2" {{  $data->status  == 2  ? 'selected' : '' }}>Tidak Di Setujui </option>
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
        <a  href="{{ route('data-asesmen-kompetensi.show', $dataPegawai->user_id) }}"  class="btn btn-outline-secondary">Kembali</a>
    
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
