@extends('layouts.app')
@section('title','Manage User')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}"> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-md-10 col-12">
        <h2 class="content-header-title float-left mb-0">Manage User</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Manage User
                </li>
            </ol>
        </div>
    </div>
    <div class="d-flex col-md-2 col-12 justify-content-md-end">
        <!-- Basic trigger modal -->
        <div class="basic-modal">
            <div class="btn btn-primary" data-toggle="modal" data-target="#userImportModal">
                <i data-feather="download-cloud" class="mr-1"></i>
                Import User
            </div>

            <!-- Modal -->
            <div class="modal fade text-left" id="userImportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel1">Import User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('import-user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                                <h5>File Import</h5>
                                <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="excel">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Accept</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic trigger modal end -->
    </div>
</div>
</div> 

   <!-- Basic table -->
<section id="basic-datatable">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header border-bottom p-1"> 
        <div  class="head-label"><h6 class="mb-0">Manage User</h6></div>
        <a  href="{{ route('user.create') }}" id="createNewData" class="dt-button create-new btn btn-primary"
            tabindex="0" aria-controls="DataTables_Table_0">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus mr-50 font-small-4">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Data
            </span>
        </a>
    </div>
    <div class="container">
    <table class="data-table table" id="dataTables" >
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
            <a href="{{ route('user.edit', $user->id) }}"  class="btn btn-icon rounded-circle btn-outline-primary"><i data-feather='edit-3'></i></a>
                @csrf
                @method('DELETE')

                <button type="submit"  class="btn btn-icon rounded-circle btn-outline-primary" title="delete" >
                <i data-feather='trash'></i>
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
    $('#dataTables').DataTable();
} );
</script> 
@endpush