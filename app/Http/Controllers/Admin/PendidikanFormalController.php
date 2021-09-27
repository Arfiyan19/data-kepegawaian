<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PendidikanFormalController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('t_riwayat_pendidikan_formal')
        ->join('table_pegawai', 't_riwayat_pendidikan_formal.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(t_riwayat_pendidikan_formal.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN t_riwayat_pendidikan_formal.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('t_riwayat_pendidikan_formal.user_id')
        ->get();   

        return view('pages.admin.data-pendidikan-formal.index', compact('data'));
    }

    public function show($id)
    { 
         
   
        
        $data = DB::table('t_riwayat_pendidikan_formal')
        ->join('t_master_jenjang_pendidikan', 't_riwayat_pendidikan_formal.id_jenjang_pendidikan', '=', 't_master_jenjang_pendidikan.id_jenjang_pendidikan')
        ->join('t_master_detail_jenjang_pendidikan', 't_riwayat_pendidikan_formal.id_detail_jenjang_pendidikan', '=', 't_master_detail_jenjang_pendidikan.id_detail_jenjang_pendidikan')
        ->join('t_master_biaya_belajar', 't_riwayat_pendidikan_formal.id_biaya_belajar', '=', 't_master_biaya_belajar.id_biaya_belajar')
        ->select(
            't_riwayat_pendidikan_formal.*',
            't_master_jenjang_pendidikan.*',
            't_master_detail_jenjang_pendidikan.*',
            't_master_biaya_belajar.*',
            't_riwayat_pendidikan_formal.id as id_riwayat',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as jenjang pendidikan',
            't_master_detail_jenjang_pendidikan.id_detail_jenjang_pendidikan as nama detail jenjang pendidikan',
            't_master_biaya_belajar.id_biaya_belajar as biaya bayar',
            
            )
        ->where('t_riwayat_pendidikan_formal.user_id',$id)
        ->orderBy('id', 'asc')->get();


        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
 
        return view('pages.admin.data-pendidikan-formal.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    { 
         
        $data = DB::table('t_riwayat_pendidikan_formal')
        ->join('t_master_jenjang_pendidikan', 't_riwayat_pendidikan_formal.id_jenjang_pendidikan', '=', 't_master_jenjang_pendidikan.id_jenjang_pendidikan')
        ->join('t_master_detail_jenjang_pendidikan', 't_riwayat_pendidikan_formal.id_detail_jenjang_pendidikan', '=', 't_master_detail_jenjang_pendidikan.id_detail_jenjang_pendidikan')
        ->join('t_master_biaya_belajar', 't_riwayat_pendidikan_formal.id_biaya_belajar', '=', 't_master_biaya_belajar.id_biaya_belajar')
        ->select(
            't_riwayat_pendidikan_formal.*',
            't_master_jenjang_pendidikan.*',
            't_master_detail_jenjang_pendidikan.*',
            't_master_biaya_belajar.*',
            't_riwayat_pendidikan_formal.id as id_riwayat',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as jenjang pendidikan',
            't_master_detail_jenjang_pendidikan.id_detail_jenjang_pendidikan as nama detail jenjang pendidikan',
            't_master_biaya_belajar.id_biaya_belajar as biaya bayar',
            
            )
        ->where('t_riwayat_pendidikan_formal.id',$id)
        ->first();
// dd($data);

        if($data->read_at == 0){
            DB::table('t_riwayat_pendidikan_formal')->where('id',$id)->update([
                'read_at' => 1
            ]); 
        }
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();

        return view('pages.admin.data-pendidikan-formal.edit', compact('data','dataPegawai'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'status_validasi' => "required" ,
           
        ]);

        DB::table('t_riwayat_pendidikan_formal')->where('id',$id)->update([
           
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
           
            'title' => 'Riwayat Pendidikan Formal '.$request->title, 
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $request->user_id,
            'created_at' =>  \Carbon\Carbon::now(), 
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-pendidikan-formal/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }

   
 
}


 