<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatTempatTinggal extends Controller
{
     public function index()
    {   
        $data = DB::table('table_tempat_tinggal')
        ->join('t_master_provinces', 'table_tempat_tinggal.province_id', '=', 't_master_provinces.id')
        ->join('t_master_kabupaten', 'table_tempat_tinggal.kabupaten_id', '=', 't_master_kabupaten.id')
        ->join('t_master_kecamatan', 'table_tempat_tinggal.kecamatan_id', '=', 't_master_kecamatan.id')
        ->join('t_master_kelurahan', 'table_tempat_tinggal.kelurahan_id', '=', 't_master_kelurahan.id')     
        ->select(
            't_master_provinces.name as nama_provinsi',
            't_master_kabupaten.name as nama_kabupaten',
            't_master_kecamatan.name as nama_kecapatan',
            't_master_kelurahan.name as nama_kelurahan',
            'table_tempat_tinggal.*',

        )
        ->get();   
        return view('pages.user.riwayat-tempat-tinggal.index', compact('data'));
    }

    public function create()
    {   
        $provinsi = DB::table('t_master_provinces')->get(); 
        return view('pages.user.riwayat-tempat-tinggal.create',compact('provinsi'));


    }

    public function edit($id)
    {   
        
        $provinsi = DB::table('t_master_provinces')->get(); 
        $data = DB::table('table_tempat_tinggal')
        ->join('t_master_provinces', 'table_tempat_tinggal.province_id', '=', 't_master_provinces.id')
        ->join('t_master_kabupaten', 'table_tempat_tinggal.kabupaten_id', '=', 't_master_kabupaten.id')
        ->join('t_master_kecamatan', 'table_tempat_tinggal.kecamatan_id', '=', 't_master_kecamatan.id')
        ->join('t_master_kelurahan', 'table_tempat_tinggal.kelurahan_id', '=', 't_master_kelurahan.id')     
        ->select(
            't_master_provinces.name as nama_provinsi',
            't_master_kabupaten.name as nama_kabupaten',
            't_master_kecamatan.name as nama_kecapatan',
            't_master_kelurahan.name as nama_kelurahan',
            't_master_provinces.id as provinsi_id',
            't_master_kabupaten.id as kabupaten_id',
            't_master_kecamatan.id as kecapatan_id',
            't_master_kelurahan.id as kelurahan_id',
            'table_tempat_tinggal.*',

        )
        ->where('table_tempat_tinggal.id',$id)
        ->first();  
        // dd($data);
        return view('pages.user.riwayat-tempat-tinggal.edit',compact('provinsi','data'));


    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'province_id' => "required" ,
            'kabupaten_id' => "required" ,
            'kecamatan_id' => "required" ,
            'kelurahan_id' => "required" ,
            'alamat' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
        ]);


        $data =  DB::table('table_tempat_tinggal')->insertGetId([
            'province_id' => $request->province_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'alamat' => $request->alamat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'user_id' =>  auth()->user()->id,
        ]);

        return redirect('user/riwayat-tempat-tinggal')->with('success', 'Data Berhasil Di Tambahkan!');
    }

    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'province_id' => "required" ,
            'kabupaten_id' => "required" ,
            'kecamatan_id' => "required" ,
            'kelurahan_id' => "required" ,
            'alamat' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
        ]);

   
        $data =  DB::table('table_tempat_tinggal')->where('id',$id)->update([
            'province_id' => $request->province_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'alamat' => $request->alamat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir, 
        ]);
        return redirect('user/riwayat-tempat-tinggal')->with('success', 'Data Berhasil Di Ubah!');
    
    }
    public function destroy( $id)
    {
        DB::table('table_tempat_tinggal')->where('id',$id)->delete();
       return redirect('user/riwayat-tempat-tinggal')->with('success', 'Data Berhasil Di Hapus!');

    }
    public function getKabupaten($id){
        $kabupaten = DB::table('t_master_kabupaten')->where('province_id',$id)->get();
        return response()->json($kabupaten);

    }
    public function getKecamatan($id){
        $kecamatan = DB::table('t_master_kecamatan')->where('kabupaten_id',$id)->get();
        return response()->json($kecamatan);

    }
    public function getKelurahan($id){
        $kelurahan = DB::table('t_master_kelurahan')->where('kecamatan_id',$id)->get();
        return response()->json($kelurahan);

    }

}
