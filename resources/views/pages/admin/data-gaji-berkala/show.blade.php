
@extends('layouts.app')
@section('title',' Data Gaji Berkala :'.  $dataPegawai->nama_pegawai )

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
        <h2 class="content-header-title float-left mb-0">Data Gaji Berkala</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item"><a href="{{ url('admin/data-gaji-berkala') }}"> Data Gaji Bekala </a>
                </li>  
                <li class="breadcrumb-item active"> {{ $dataPegawai->nama_pegawai }}
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
        <div  class="head-label"><h3 class="mb-0">Data Asuransi : {{ $dataPegawai->nama_pegawai }}</h3></div> 
    </div>
    <div class="container table-responsive">
    <table class="data-table table" id="dataTables" >
        <thead>
            <tr>
                <th>No</th>
                <th>Pangkat</th>
                <th>Gaji Pokok</th>
                <th>TMT Gaji</th>
                <th>Nomor SK</th>
                <th>Tanggal SK</th>
                <th>Validasi</th>
                <th>Action</th>


            </tr>
        </thead>
        <tbody>
       
        @foreach($data as $row)
        @if($row->read_at == 0)
            <tr class="table-success"> 
            @else
            <tr> 
            @endif
           <td>{{ $loop->iteration }}</td>
            <td>{{ $row->golongan }}</td>
            <td>{{ $row->gaji_pokok_baru }}</td>
            <td>{{ $row->terhitung_tanggal_mulai_penggajian }}</td>
            <td>{{ $row->no_sk }}</td>
            <td>{{ $row->tanggal_sk }}</td>
            <td>
            @if($row->status == 1)
                <button type="button" class="btn  badge btn-gradient-success">Sudah Di Validasi</button>
                @elseif($row->status == 2)
                <button type="button" class="btn badge  btn-gradient-danger">Tidak Di Setujui</button>
                @else
                <button type="button" class="btn badge  btn-gradient-warning">Belum Di Validasi</button>
                @endif  
            </td>
            </td>

            <td>
            <a href="{{ route('data-gaji-berkala.edit', $row->id) }}"  class="btn btn-icon rounded-circle btn-outline-primary"><i data-feather='check'></i></a>

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