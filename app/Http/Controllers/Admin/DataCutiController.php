<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DataCutiController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_cuti')
        ->join('table_pegawai', 'table_cuti.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_cuti.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_cuti.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_cuti.user_id')
        ->get();   

        return view('pages.admin.data-cuti.index', compact('data'));
    }

    public function show($id)
    { 
         
        $data = DB::table('table_cuti')
        ->join('t_master_cuti', 'table_cuti.jenis_cuti', '=', 't_master_cuti.id') 
        ->select(
            't_master_cuti.*',
            'table_cuti.*',
            'table_cuti.id as id_cuti',
            
            )
        ->where('table_cuti.user_id',$id)
        ->get();  

        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-cuti.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
         
        $data = DB::table('table_cuti')
        ->join('t_master_cuti', 'table_cuti.jenis_cuti', '=', 't_master_cuti.id') 
        ->select(
            't_master_cuti.*',
            'table_cuti.*',
            'table_cuti.id as id_cuti',
            
            )
        ->where('table_cuti.id',$id)
        ->first();   

        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();

        if($data->read_at == 0){
            DB::table('table_cuti')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        }
        return view('pages.admin.data-cuti.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_cuti')->where('id',$id)->update([
           
            'status' => $request->status_validasi,
            'validated_at' => auth()->user()->id

        ]); 
        
        $pesan = '';
        if($request->keterangan){
            $pesan = 'Mohon Maaf '.$request->keterangan;
        }else{
            $pesan = 'Selamat Data Berhasil Di Validasi';
        }

        DB::table('table_notifikasi')->insert([
           
            'title' => 'Riwayat Cuti '.$request->title, 
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' =>$request->user_id,
            'created_at' =>  \Carbon\Carbon::now(), 
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-cuti/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }

   
    
}


 