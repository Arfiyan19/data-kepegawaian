@extends('layouts.app')
@section('title','Create User')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Manage User</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Manage User</a>
                </li> 
                <li class="breadcrumb-item active">Edit
                </li>
            </ol>
        </div>
    </div>
</div>
</div>

<section id="multiple-column-form">
<div class="row">
<div class="col-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Data</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{route('user.store')}}" method="post">
                
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="name-column">Nama</label>
                            <input type="text" id="name-column" class="form-control @error('name') is-invalid @enderror required" placeholder="Nama" name="name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="email-id-column">Email</label>
                            <input type="email" id="email-id-column" class="form-control @error('email') is-invalid @enderror required" name="email" placeholder="Email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">role</label>
                        <select name="role" id="role"  class="form-control dt-post required @error('role') is-invalid @enderror required">
                            <option  selected disabled >Pilih</option>
                            <option value="admin" id="admin">Admin</option>
                            <option value="user" id="user">User</option> 
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mr-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>
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
