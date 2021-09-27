<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DataKepangkatanControler extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_kepangkatan')
        ->join('table_pegawai', 'table_kepangkatan.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_kepangkatan.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_kepangkatan.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_kepangkatan.user_id')
        ->get();   
 
        return view('pages.admin.data-kepangkatan.index', compact('data'));
    }

    public function show($id)
    { 
          
        $data = DB::table('table_kepangkatan')
        ->join('t_master_jenis_sk', 'table_kepangkatan.jenis_sk', '=', 't_master_jenis_sk.id') 
        ->join('t_aster_pangkat', 'table_kepangkatan.pangkat', '=', 't_aster_pangkat.id') 

        ->select(
            'table_kepangkatan.*',
            't_master_jenis_sk.jenis',
            't_aster_pangkat.nama_pangkat',

        )
        ->where('table_kepangkatan.user_id',$id)
        ->get(); 
        
// dd($data);         
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-kepangkatan.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
          
        
        $data = DB::table('table_kepangkatan')
        ->join('t_master_jenis_sk', 'table_kepangkatan.jenis_sk', '=', 't_master_jenis_sk.id') 
        ->join('t_aster_pangkat', 'table_kepangkatan.pangkat', '=', 't_aster_pangkat.id') 

        ->select(
            'table_kepangkatan.*',
            't_master_jenis_sk.jenis',
            't_aster_pangkat.nama_pangkat',

        )
        ->where('table_kepangkatan.id',$id)
        ->first(); 
            // dd($data);
        if($data->read_at == 0){
            DB::table('table_kepangkatan')->where('id',$id)->update([
                'read_at' => 1
            ]); 
        }
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->id)->first();

        return view('pages.admin.data-kepangkatan.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_kepangkatan')->where('id',$id)->update([
           
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
           
            'title' => 'Riwayat Kepangkatan '.$request->title, 
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(),  
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-kepangkatan/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }

   
 
}
