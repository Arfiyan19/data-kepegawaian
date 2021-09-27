@extends('layouts.app')
@section('title','Kelola Data Pendidikan foraml')

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
        <h2 class="content-header-title float-left mb-0">Kelola Data Pendidikan foraml</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Kelola Data Pendidikan foraml
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
     
    <div class="container">
    <table class="data-table text-center table" id="dataTables" >
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jumlah Data</th>
                <th>Belum Dilihat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama_pegawai }}</td>
            <td>{{ $row->nip }}</td>
            <td>
             <button type="button" class="btn rounded-circle badge btn-gradient-success"> {{ $row->jumlah }}</button> 
           </td>
            <td>
            <button type="button" class="btn rounded-circle badge btn-gradient-danger"> {{ $row->belum_dilihat }}</button> 
            </td>
            <td>
              <a href="{{ route('data-pendidikan-formal.show', $row->user_id) }}"  class="btn btn-icon rounded-circle btn-outline-primary"><i data-feather='eye'></i></a>            
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