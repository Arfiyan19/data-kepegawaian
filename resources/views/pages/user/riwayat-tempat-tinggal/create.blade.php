@extends('layouts.app')
@section('title','RIWAYAT TEMPAT TINGGAl')
@push('before-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">RIWAYAT TEMPAT TINGGAl</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Home</a>
                </li> 
                <li class="breadcrumb-item"><a href="{{ url('user/riwayat-tempat-tinggal')}}">Riwayat Tempat Tinggal</a>
                </li> 
                <li class="breadcrumb-item active">Create
                </li>
            </ol>
        </div>
    </div>
</div>
</div>

<section id="multiple-column-form">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Riwayat Tempat Tinggal</h4>
        </div>
        <div class="card-body">
        <form class="form"  id="dataForm" action="{{ route('riwayat-tempat-tinggal.store') }}" method="post">
                @csrf
                <div class="row">
                <div class="col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-post">Provinsi</label>
                            <select name="province_id" id="province_id"  class="required select form-control dt-post  @error('id') is-invalid @enderror ">
                            <option  selected disabled >Pilih</option>
                            @foreach($provinsi as $row)
                            <option value="{{$row->id}}"  >{{ $row->name }}</option> 
                            @endforeach
                        </select>
                        @error('id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-12">
                <div class="form-group">
                                <div class="head-label"><h5 class="mb-0">Kabupaten</h5></div>
                        <select id="kabupaten_id" name="kabupaten_id"  class="select form-control form-control-lg">
                        <option  selected disabled >Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-12"> 
                <div class="form-group">
                                <div class="head-label"><h5 class="mb-0">Kecamatan</h5></div>
                        <select  id="kecamatan_id" name="kecamatan_id" class="select form-control form-control-lg">
                        <option  selected disabled >Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-12"> 
                <div class="form-group">
                                <div class="head-label"><h5 class="mb-0">Kelurahan</h5></div>
                        <select  id="kelurahan_id" name="kelurahan_id" class="select form-control form-control-lg">
                        <option  selected disabled >Pilih</option>
                        </select>
                    </div>
                </div>
                       
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="-id-column">Alamat</label>
                            <input type="text" name="alamat" id="-id-column" class="required form-control @error('tempat_kedudukan_organisasi') is-invalid @enderror " />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_mulai-id-column">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai-id-column" class="required form-control @error('tanggal_mulai') is-invalid @enderror "name="tanggal_mulai"   />
                          
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tanggal_berakhir-id-column">Tanggal Berakhir </label>
                            <input type="date" id="tanggal_berakhir-id-column" class="required form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_berakhir"  />
                        </div>
                    </div>
                   
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endpush

@push('after-script')

<script type="text/javascript">

  $(function () {

    $(document).ready(function() {
        $('.select').select2();
    });

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });
 
    $('#province_id').change(function () {
        var datas =  $('#province_id').val();
        $.ajax({

            type: "GET",

            url: "{{ url('user/getkabupaten') }}"+'/'+datas,

            success: function (data) {
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].name+' </option>';
                    }
                    $('#kabupaten_id').html(html);
                    // $('.kecamatan_id,.kelurahan_id').hide()

            },

            error: function (data) {

                console.log('Error:', data);

            }

         });
    });

    // get kecamatan
    $('#kabupaten_id').change(function () {
        var datas =  $('#kabupaten_id').val();
        $.ajax({

            type: "GET",

            url: "{{ url('user/getkecamatan') }}"+'/'+datas,

            success: function (data) {
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].name+' </option>';
                    }
                    $('.kecamatan_id').show()
                    $('#kecamatan_id').html(html);
                    // $('.kelurahan_id').hide()



            },

            error: function (data) {

                console.log('Error:', data);

            }

         });
    });
       // get kelurahan
       $('#kecamatan_id').change(function () {
        var datas =  $('#kecamatan_id').val();
        $.ajax({

            type: "GET",

            url: "{{ url('user/getkelurahan') }}"+'/'+datas,

            success: function (data) {
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].name+' </option>';
                    }
                    $('.kelurahan_id').show()
                    $('#kelurahan_id').html(html);



            },

            error: function (data) {

                console.log('Error:', data);

            }

         });
    });
   

  });

</script>
 
@endpush
