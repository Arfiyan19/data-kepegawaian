@extends('layouts.app')
@section('title','Notifikasi detail')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Notifikasi detail</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              
                <li class="breadcrumb-item active">Notifikasi detail
                </li>
            </ol>
        </div>
    </div>
</div>
</div>
<div class="card col-md-12" >
  <div class="card-body">
    
    <table class="table">
        <tr>
            <td>Judul  :</td>
            <td>{{ $data->title }}</td>
        </tr>
        <tr>
            <td>Pesan :</td>
            <td>{{ $data->message }}</td>
        </tr>
        <tr>
            <td>Tanggal Terkirim :</td>
            <td>{{ $data->created_at }}</td>
        </tr>
</table>
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
