<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class DataKeluargaController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_riwayat_keluarga')
        ->join('table_pegawai', 'table_riwayat_keluarga.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_riwayat_keluarga.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_riwayat_keluarga.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_riwayat_keluarga.user_id')
        ->get();   

        return view('pages.admin.data-keluarga.index', compact('data'));
    }

    public function show($id)
    { 
         
      
        $data = DB::table('table_riwayat_keluarga')
        ->join('t_master_hub_kepala_keluarga', 'table_riwayat_keluarga.id_hub_kepala_keluarga', '=', 't_master_hub_kepala_keluarga.id_hub_kepala_keluarga')
        ->join('t_master_jenjang_pendidikan', 'table_riwayat_keluarga.id_jenjang_pendidikan', '=', 't_master_jenjang_pendidikan.id_jenjang_pendidikan')
        ->select(
            'table_riwayat_keluarga.*',
            't_master_hub_kepala_keluarga.*',
            't_master_jenjang_pendidikan.*',
            'table_riwayat_keluarga.id as id_riwayat',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as hubungan keluarga',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as pendidikan akhir',

        )
        ->where('table_riwayat_keluarga.user_id',$id)
        ->get();  
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-keluarga.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
         
        $data = DB::table('table_riwayat_keluarga')
        ->join('t_master_hub_kepala_keluarga', 'table_riwayat_keluarga.id_hub_kepala_keluarga', '=', 't_master_hub_kepala_keluarga.id_hub_kepala_keluarga')
        ->join('t_master_jenjang_pendidikan', 'table_riwayat_keluarga.id_jenjang_pendidikan', '=', 't_master_jenjang_pendidikan.id_jenjang_pendidikan')
        ->select(
            'table_riwayat_keluarga.*',
            't_master_hub_kepala_keluarga.*',
            't_master_jenjang_pendidikan.*',
            'table_riwayat_keluarga.id as id_riwayat',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as hubungan keluarga',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as pendidikan akhir',

        )
        ->where('table_riwayat_keluarga.id',$id)
        ->first();    
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();
        if($data->read_at == 0){
            DB::table('table_riwayat_keluarga')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        }
        return view('pages.admin.data-keluarga.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_riwayat_keluarga')->where('id',$id)->update([
           
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
           
            'title' => 'Riwayat Daya Keluarga '.$request->title, 
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(),  
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-keluarga/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }
}
