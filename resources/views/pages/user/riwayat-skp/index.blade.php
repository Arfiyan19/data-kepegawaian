@extends('layouts.app')
@section('title','RIWAYAT SKP')

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
        <h2 class="content-header-title float-left mb-0">RIWAYAT SKP</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li>  
                <li class="breadcrumb-item active">Riwayat SKP
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
        <div  class="head-label"><h6 class="mb-0">Riwayat SKP</h6></div>
        <a  href="{{ route('riwayat-skp.create') }}" id="createNewData" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"   ><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Data</span></a>
    </div>
    <div class="container">
    <table class="data-table table" id="dataTables" >
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">TAHUN</th>
                <th colspan="2">SASARAN KERJA</th>
                <th colspan="9">PERILAKU KERJA</th>
                <th rowspan="2">NILAI PRESTASI KERJA</th>
                <th rowspan="2">VALIDASI</th>
                <th rowspan="2">ACTION</th>
            </tr>
            <tr>
              <th>NILAI</th>
              <th>60%</th>
              <th>OPL</th>
              <th>INT</th>
              <th>KOM</th>
              <th>DIS</th>
              <th>KSM</th>
              <th>KPM</th>
              <th>JUMLAH</th>
              <th>RATA-RATA</th>
              <th>40%</th>
            </tr>
        </thead>
        <tbody>
          @foreach($data as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ number_format((float) $item->tahun, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->nilai, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->nilai * 60 / 100, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->opl, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->int, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->kom, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->dis, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->ksm, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->kpm, 2, '.', ''); }}</td>
              <td>{{ number_format((float) ($item->opl + $item->int + $item->kom + $item->dis + $item->ksm + $item->kpm), 2, '.', ''); }}</td>
              <td>{{ number_format((float) ($item->opl + $item->int + $item->kom + $item->dis + $item->ksm + $item->kpm) / 6, 2, '.', ''); }}</td>
              <td>{{ number_format((float) (($item->opl + $item->int + $item->kom + $item->dis + $item->ksm + $item->kpm) / 6) * 40 / 100, 2, '.', ''); }}</td>
              <td>{{ number_format((float) $item->prestasi_kerja, 2, '.', ''); }}</td>
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
                  <form action="{{ route('riwayat-skp.destroy', $item->id) }}" method="post">
                      <a href="{{ route('riwayat-skp.edit', $item->id) }}"  class="btn btn-icon rounded-circle btn-outline-primary">
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