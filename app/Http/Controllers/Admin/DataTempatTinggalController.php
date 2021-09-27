<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DataTempatTinggalController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_tempat_tinggal')
        ->join('table_pegawai', 'table_tempat_tinggal.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_tempat_tinggal.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_tempat_tinggal.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_tempat_tinggal.user_id')
        ->get();   

        return view('pages.admin.data-tempat-tinggal.index', compact('data'));
    }
    public function show($id)
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
        ->where('table_tempat_tinggal.user_id',$id)
        ->get();  
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-tempat-tinggal.show', compact('data','dataPegawai'));
    }
    public function edit($id)
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
        ->where('table_tempat_tinggal.id',$id)
        ->first();  
            
        // dd($data);
        
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();
        if($data->read_at == 0){
            DB::table('table_tempat_tinggal')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        }
        return view('pages.admin.data-tempat-tinggal.edit', compact('data','dataPegawai'));
    }
    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_tempat_tinggal')->where('id',$id)->update([
           
            'status' => $request->status_validasi,
            'validated_at' => auth()->user()->id

        ]); 
        // untuk notfikasi 
        $pesan = '';
        if($request->keterangan){
            $pesan = 'Mohon Maaf '.$request->keterangan;
        }else{
            $pesan = 'Selamat Data Berhasil Di Validasi';
        }
        DB::table('table_notifikasi')->insert([
           
            'title' => 'Riwayat Tempat Tinggal'.$request->title,
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(), 
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-tempat-tinggal/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }



}
