@extends('layouts.app')
@section('title','RIWAYAT PENGHARGAAN')

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
        <h2 class="content-header-title float-left mb-0">RIWAYAT PENGHARGAAN</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item active">Riwayat Penghargaan
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
        <div  class="head-label"><h6 class="mb-0">LK 08-RIWAYAT PENGHARGAAN</h6></div>
        <a  href="{{ route('riwayat-penghargaan.create') }}" id="createNewData" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"   ><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Data</span></a>
    </div>
    <div class="container">
    <table class="data-table table" id="dataTables" >
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tanda Jasa/Penghargaan</th>
                <th>Nomor Surat Keputusan</th>
                <th>Tanggal Surat Keputusan</th>
                <th>Nomor Piagam</th>
                <th>Tanggal Piagam</th>
                <th>Badan Instansi Yang Memberikan</th>
                <th>Validasi</th>
                <th>Action</th>


            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
           <tr> 
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama_tanda_jasa_penghargaan }}</td>
            <td>{{ $row->no_sk }}</td>
            <td>{{ $row->tanggal_sk }}</td>
            <td>{{ $row->no_piagam }}</td>
            <td>{{ $row->tanggal_piagam }}</td>
            <td>{{ $row->badan_instansi_yg_memberikan }}</td>
            <td>
            @if($row->status == 1)
                <button type="button" class="btn  badge btn-gradient-success">Sudah Di Validasi</button>
                @elseif($row->status == 2)
                <button type="button" class="btn badge  btn-gradient-danger">Tidak Di Setujui</button>
                @else
                <button type="button" class="btn badge  btn-gradient-warning">Belum Di Validasi</button>
                @endif
            <td>
            <form action="{{ route('riwayat-penghargaan.destroy', $row->id) }}" method="POST">
            <a href="{{ route('riwayat-penghargaan.edit', $row->id) }}"  class="btn btn-icon rounded-circle btn-outline-primary"><i data-feather='edit-3'></i></a>
                @csrf
                @method('DELETE')
                @if($row->status == 0)
                <button type="submit"  class="btn btn-icon rounded-circle btn-outline-primary" title="delete" >
                <i data-feather='trash'></i>
                </button>
                @endif

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
    $('#dataTables').DataTable();
} );
</script> 
@endpush