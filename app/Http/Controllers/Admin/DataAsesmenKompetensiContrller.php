<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class DataAsesmenKompetensiContrller extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_riwayat_asesmen')
        ->join('table_pegawai', 'table_riwayat_asesmen.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_riwayat_asesmen.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_riwayat_asesmen.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_riwayat_asesmen.user_id')
        ->get();   

        return view('pages.admin.data-asesmen.index', compact('data'));
    }

    public function show($id)
    { 
         
      
        $data = DB::table('table_riwayat_asesmen')
        ->join('t_master_jabatan', 'table_riwayat_asesmen.id_jabatan', '=', 't_master_jabatan.id')
        ->join('t_master_unit_kerja', 't_master_unit_kerja.id', '=', 'table_riwayat_asesmen.id_unit_kerja')
        ->select(
            'table_riwayat_asesmen.*',
            't_master_jabatan.*',
            't_master_unit_kerja.*',
            't_master_jabatan.id as id_jabatan',
            'table_riwayat_asesmen.id as id_riwayat',
            't_master_unit_kerja.id as id_unit',

        )
        ->where('table_riwayat_asesmen.user_id',$id)
        ->get();  
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-asesmen.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
         
        $data = DB::table('table_riwayat_asesmen')
        ->join('t_master_jabatan', 'table_riwayat_asesmen.id_jabatan', '=', 't_master_jabatan.id')
        ->join('t_master_unit_kerja', 't_master_unit_kerja.id', '=', 'table_riwayat_asesmen.id_unit_kerja')
        ->select(
            'table_riwayat_asesmen.*',
            't_master_jabatan.*',
            't_master_unit_kerja.*',
            't_master_jabatan.id as id_jabatan',
            'table_riwayat_asesmen.id as id_riwayat',
            't_master_unit_kerja.id as id_unit',

        )
        ->where('table_riwayat_asesmen.id',$id)
        ->first();    
        
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();
        if($data->read_at == 0){
            DB::table('table_riwayat_asesmen')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        }
        return view('pages.admin.data-asesmen.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
        ]);

        DB::table('table_riwayat_asesmen')->where('id',$id)->update([
           
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
            'title' => 'RiwayaT Asesmen '.$request->title,
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(),  
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-asesmen-kompetensi/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }

   
    
}