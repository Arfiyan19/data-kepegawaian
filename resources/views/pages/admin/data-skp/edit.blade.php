@extends('layouts.app')
@section('title','Setujui Data SKP')

@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Setujui Data SKP</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li> 
                <li class="breadcrumb-item active">Setujui Data SKP
                </li>
            </ol>
        </div>
    </div>
</div>
</div>
<div class="card col-md-12" >
  <div class="card-body">
    <h5 class="card-title">Nama : {{ $dataPegawai->nama_pegawai}}</h5>
    
    <table class="table">
        <tr>
            <td>Tahun : </td>
            <td>{{ $data->tahun	}}</td>
        </tr>
        <tr>
            <td>Nilai :</td>
            <td>{{ $data->nilai }}</td>
        </tr>
        
        <tr>
            <td>60% :</td>
            <td>{{ $data->nilai * 60 / 100, 2 }}</td>
        </tr>
        <tr>
            <td>OPL : </td>
            <td>{{ $data->opl	 }}</td>
        </tr>
        <tr>
            <td>iINT  :</td>
            <td>{{ $data->int		 }}</td>
        </tr>
        <tr>
        <tr>
            <td>KOM :</td>
            <td>{{ $data->kom }}</td>
        </tr>
        <tr>
        <tr>
            <td>DIS :</td>
            <td>{{ $data->dis	 }}</td>
        </tr>
        <tr>
            <td>KSM :</td>
            <td>{{ $data->ksm }}</td>
        </tr>
        <tr>
            <td>KPM :</td>
            <td>{{ $data->kpm	 }}</td>
        </tr>
        <tr>
            <td>Jumlah :</td>
            <td>{{ number_format((float) ($data->opl + $data->int + $data->kom + $data->dis + $data->ksm + $data->kpm), 2, '.', '');  }}</td>
            
        </tr>
        <tr>
            <td>Rata Rata :</td>
            <td>{{ number_format((float) ($data->opl + $data->int + $data->kom + $data->dis + $data->ksm + $data->kpm) / 6, 2, '.', ''); }}</td>
        </tr>
        <tr>
            <td>40% :</td>
            <td>{{ number_format((float) (($data->opl + $data->int + $data->kom + $data->dis + $data->ksm + $data->kpm) / 6) * 40 / 100, 2, '.', '');}}</td>
        </tr>
        <tr>
            <td>Nilai Presentasi Kerja :</td>
            <td>{{ $data->prestasi_kerja	 }}</td>
        </tr>
        <form class="form"  id="dataForm" action="{{ route('data-skp.update',$data->id) }}" method="post">
            @method('PUT')
    
                @csrf
              <input type="hidden" value="{{ $data->tahun }}," name="title">
                <input type="hidden" value="{{ $data->user_id }}" name="user_id">
        <tr>
            <td>Status Validasi :</td>
            <td> 
                <div class="form-group">
                     
                    <select required  name="status_validasi" id="status_validasi"  class="required form-control dt-post  @error('status_validasi') is-invalid @enderror "> 
                       
                        <option value="1" {{ $data->status  == 1  ? 'selected' : '' }}>Berhasil Di Validasi</option>
                        <option value="2" {{ $data->status  == 2  ? 'selected' : '' }}>Tidak Di Setujui </option>

                       
                </select>  
                @error('status_validasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </td>
        </tr>
        <tr>
            <td>Keterang Jika Tidak Di Setujui</td>
            <td>
            <div class="form-floating">
            <textarea class="form-control" name="keterangan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
           
            </div>
            </td>
        </tr>
    </table>
    <div class="col-12">
        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
        <a  href="{{ route('data-tempat-tinggal.show', $dataPegawai->user_id) }}"  class="btn btn-outline-secondary">Kembali</a>
    
    </div>
    </form>
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
