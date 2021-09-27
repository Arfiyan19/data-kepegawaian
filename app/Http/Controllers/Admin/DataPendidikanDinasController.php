<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DataPendidikanDinasController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_pendidikan_pelatihan_dinas')
        ->join('table_pegawai', 'table_pendidikan_pelatihan_dinas.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_pendidikan_pelatihan_dinas.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_pendidikan_pelatihan_dinas.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_pendidikan_pelatihan_dinas.user_id')
        ->get();   

        return view('pages.admin.data-pendidikan-dinas.index', compact('data'));
    }

    public function show($id)
    { 
         
          
        $data = DB::table('table_pendidikan_pelatihan_dinas')
        ->join('t_master_jenis_diklat', 'table_pendidikan_pelatihan_dinas.jenis_diklat', '=', 't_master_jenis_diklat.id_jenis_diklat') 
        ->select(
            'table_pendidikan_pelatihan_dinas.*', 
            't_master_jenis_diklat.jenis_diklat', 

        )
        ->where('table_pendidikan_pelatihan_dinas.user_id',$id)
        ->get(); 


        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-pendidikan-dinas.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
          
        $data = DB::table('table_pendidikan_pelatihan_dinas')
        ->join('t_master_jenis_diklat', 'table_pendidikan_pelatihan_dinas.jenis_diklat', '=', 't_master_jenis_diklat.id_jenis_diklat') 
        ->select(
            'table_pendidikan_pelatihan_dinas.*', 
            't_master_jenis_diklat.jenis_diklat', 

        )
        ->where('table_pendidikan_pelatihan_dinas.id',$id)
        ->first(); 
//    dd($data);

        if($data->read_at == 0){
            DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->update([
                'read_at' => 1
            ]); 
        }
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();

        return view('pages.admin.data-pendidikan-dinas.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->update([
           
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
           
            'title' => 'Riwayat Pendidikan '.$request->title, 
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(),  
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-pendidikan-dinas/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }

   
 
}


 