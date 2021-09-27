<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DataAusransiController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_asuransi')
        ->join('table_pegawai', 'table_asuransi.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_asuransi.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_asuransi.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_asuransi.user_id')
        ->get();   

        return view('pages.admin.data-asuransi.index', compact('data'));
    }

    public function show($id)
    { 
         
        $data = DB::table('table_asuransi')
        ->join('t_master_asuransi', 'table_asuransi.id_jenis_asuransi', '=', 't_master_asuransi.id_asuransi') 
        ->select(
            't_master_asuransi.*',
            'table_asuransi.*',
            'table_asuransi.id as id_asuransi',

        )
        ->where('table_asuransi.user_id',$id)
        ->get();   

        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-asuransi.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
         
        $data = DB::table('table_asuransi')
        ->join('t_master_asuransi', 'table_asuransi.id_jenis_asuransi', '=', 't_master_asuransi.id_asuransi') 
        ->select(
            't_master_asuransi.*',
            'table_asuransi.*',
            'table_asuransi.id as id_asuransi',

        )
        ->where('table_asuransi.id',$id)
        ->first();   

        if($data->read_at == 0){
            DB::table('table_asuransi')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        }
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();

        return view('pages.admin.data-asuransi.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_asuransi')->where('id',$id)->update([
           
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
           
            'title' => 'Riwayar Asuransi '.$request->title, 
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(),
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-asuransi/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }

   
 
}


 