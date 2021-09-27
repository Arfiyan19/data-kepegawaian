@extends('layouts.app')
@section('title','RIWAYAT JABATAN')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}"> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT JABATAN</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item active">Riwayat Jabatan
                </li>
            </ol>
        </div>
    </div>
</div>
</div>

   <!-- Basic table -->
<section id="basic-datatable">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header border-bottom p-1"> 
        <div  class="head-label"><h6 class="mb-0">LK 03-Riwayat Jabatan</h6></div>
        <a  href="{{ route('riwayat-jabatan.create') }}" id="createNewData" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"   ><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Data</span></a>
    </div>
    <div class="container">
    <table class="data-table table" id="dataTables" >
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th>Unit Organisasi</th>
                <th>Nama Kantor</th>
                <th>Jabatan</th>
                <th>TMT</th>
                <th>No & Tanggal SK</th>
                <th>diterbitkan</th>
                <th>pangkat</th>
                <th>induk unit kerja</th>
                <th>unit organisasi</th>
                <th>jenis jabatan</th>
                <th>keterangan jabatan</th>
                <th>group fungsional</th>
                <th>jabatan fungsional tertentu</th>
                <th>jabatan fungsional umum</th>
                <th>status jabatan</th>
                <th>alasan jabatan sementara</th>
                <th>catatan</th>
                <th>Validasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>

                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ asset('documents/riwayat-jabatan/'.$item->dokumen) }}">
                            <i data-feather="file"></i>
                        </a>
                    </td>
                    <td>{{ $item->nama_unit_organisasi }}</td>
                    <td>{{ $item->nama_kantor }}</td>
                    <td>
                        @foreach(DB::table('collection_riwayat_jabatan')
                        ->where('no_sk', $item->no_sk)
                        ->leftJoin('master_jabatan', 'master_jabatan.id', '=', 'collection_riwayat_jabatan.id_jabatan')
                        ->get() as $jabatan)
                            {{ $jabatan->nama }},
                        @endforeach
                    </td>
                    <td>{{ $item->tgl_tmt }}</td>
                    <td>
                        <span>{{ $item->no_sk }}</span>
                        <span>{{ $item->tgl_sk }}</span>
                    </td>
                    <?php
                        $dump = DB::table('detail_riwayat_jabatan')->where('no_sk', $item->no_sk)
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
                    <td>{{ $dump->diterbitkan }}</td>
                    <td>{{ $dump->pangkat }}</td>
                    <td>{{ $dump->induk_unit_kerja }}</td>
                    <td>{{ $dump->unit_organisasi }}</td>
                    <td>{{ $dump->jenis_jabatan }}</td>
                    <td>{{ $dump->keterangan_jabatan }}</td>
                    <td>{{ $dump->group_fungsional }}</td>
                    <td>{{ $dump->jabatan_fungsional_tertentu }}</td>
                    <td>{{ $dump->jabatan_fungsional_umum }}</td>
                    <td>{{ $dump->status_jabatan }}</td>
                    <td>{{ $dump->alasan_jabatan_sementara }}</td>
                    <td>{{ $dump->catatan }}</td>
                    <td>
                    @if($item->status == 1)
                        <button type="button" class="btn  badge btn-gradient-success">Sudah Di Validasi</button>
                    @elseif($item->status == 2)
                        <button type="button" class="btn badge  btn-gradient-danger">Tidak Di Setujui</button>
                    @else
                        <button type="button" class="btn badge  btn-gradient-warning">Belum Di Validasi</button>
                    @endif
                    </td>
                    <td>
                        <form action="{{ route('riwayat-jabatan.destroy', $item->id) }}" method="post">
                            <a href="{{ route('riwayat-jabatan.edit', $item->id) }}"  class="btn btn-icon rounded-circle btn-outline-primary">
                                <i data-feather='edit-3'></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-icon rounded-circle btn-outline-danger">
                                <i data-feather='trash-2'></i>
                            </button>
                        </form>
                    </td>

                </tr>
           @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
</div>
 

</section>
    @include('sweet::alert')

@endsection


@push('before-script')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

@endpush

@push('after-script')
<script>
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
            }
        },
    });
} );
</script> 
@endpush