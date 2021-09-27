@extends('layouts.app')
@section('title','Informasi Pegawai')

@push('before-style')
    <!-- BEGIN: Vendor CSS--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css' )}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css' )}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css' )}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css' )}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css' )}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css' )}}">
    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Informasi Pegawai</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Informasi Pegawai
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
    <table class="data-table table" id="dataTables" >
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>NIP</th>
                <th>NIP Lama</th>
                <th>Gelar Depan</th>
                <th>Gelar Belakang</th>
                <th>No Kartu Pegawai</th>
                <th>Tempat Lahir </th>
                <th>Tanggal Lahir</th>
                <th>Golongan Darah</th>
                <th>NPWP</th>
                <th>NIK</th>
                <th>No KTP</th>
                <th>Agama</th> 
                <th>Jenis Disabilitas</th>
                <th>Jenis Kelamin</th>
                <th>Email Kemensos</th>
                <th>Email Lain</th>
                <th>Telepon</th>
                <th>Handphone 1</th>
                <th>Handphone 2</th>
                <th>Foto KTP</th>
                <th>Foto BPJS</th>
                <th>Dokumen</th>

            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
           <tr> 
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama_pegawai }}</td>
            <td>{{ $row->nip }}</td>
            <td>{{ $row->nip_lama }}</td>
            <td>{{ $row->gelar_depan }}</td>
            <td>{{ $row->gelar_belakang }}</td>
            <td>{{ $row->no_kartu_pegawai }}</td>
            <td>{{ $row->tempat_lahir }}</td>
            <td>{{ $row->tanggal_lahir }}</td>
            <td>{{ $row->golongan_darah }}</td>
            <td>{{ $row->npwp }}</td>
            <td>{{ $row->nik }}</td>
            <td>{{ $row->no_ktp }}</td>
            <td>{{ $row->golongan_darah }}</td>
            <td>{{ $row->agama }}</td>
            <td>{{ $row->jenis_disabilitas }}</td>
            <td>{{ $row->jenis_kelamin }}</td> 
            <td>{{ $row->email_1 }}</td> 
            <td>{{ $row->email_2 }}</td> 
            <td>{{ $row->number_1 }}</td> 
            <td>{{ $row->number_2 }}</td> 
            <td><a href="{{ asset('dokumen/inforamsi_pegawai/'.$row->foto_ktp) }}">{{ $row->foto_ktp }}</a></td> 
            <td><a href="{{ asset('dokumen/inforamsi_pegawai/'.$row->foto_bpjs) }}">{{ $row->foto_bpjs }}</a></td> 
            <td><a href="{{ asset('dokumen/inforamsi_pegawai/'.$row->document) }}">{{ $row->document }}</a></td> 

            
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

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
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll()
            }
        },
        dom:
        '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle mr-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
              className: 'dropdown-item',
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
              className: 'dropdown-item',
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
              className: 'dropdown-item',
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
              className: 'dropdown-item',
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
              className: 'dropdown-item',
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
      
      ],
        // end
    });
} );
</script> 
@endpush