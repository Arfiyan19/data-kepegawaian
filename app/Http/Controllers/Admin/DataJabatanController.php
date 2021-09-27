<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataJabatanController extends Controller
{
    public function index()
    { 
        $data = DB::table('table_riwayat_jabatan')
        ->join('table_pegawai', 'table_riwayat_jabatan.user_id', '=', 'table_pegawai.user_id') 
        ->select(
            'table_pegawai.*',
            DB::raw('count(table_riwayat_jabatan.id) as jumlah'),
            DB::raw("SUM(CASE 
            WHEN table_riwayat_jabatan.read_at = '0' THEN 1 ELSE 0 END) AS belum_dilihat"), 
        )
        ->groupBy('table_riwayat_jabatan.user_id')
        ->get();   

        return view('pages.admin.data-jabatan.index', compact('data'));
    }
    public function show($id)
    { 
         
      
        $data = DB::table('table_riwayat_jabatan')
        ->join('master_unit_organisasi', 'master_unit_organisasi.id', '=', 'table_riwayat_jabatan.id_unit_organisasi')
        ->join('master_kantor', 'master_kantor.id', '=', 'table_riwayat_jabatan.id_kantor')
        ->select(
            'table_riwayat_jabatan.*',
            'master_unit_organisasi.nama as nama_unit_organisasi',
            'master_kantor.nama as nama_kantor'

        )
        ->where('table_riwayat_jabatan.user_id',$id)
        ->get();  
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$id)->first();
        return view('pages.admin.data-jabatan.show', compact('data','dataPegawai'));
    }
    public function edit($id)
    {
       
        $data = DB::table('table_riwayat_jabatan')
        ->join('master_unit_organisasi', 'master_unit_organisasi.id', '=', 'table_riwayat_jabatan.id_unit_organisasi')
        ->join('master_kantor', 'master_kantor.id', '=', 'table_riwayat_jabatan.id_kantor')
        ->select(
            'table_riwayat_jabatan.*',
            'master_unit_organisasi.nama as nama_unit_organisasi',
            'master_kantor.nama as nama_kantor'

        )
        ->where('table_riwayat_jabatan.id',$id)
        ->first();    
        $dataPegawai =  DB::table('table_pegawai')->where('user_id',$data->user_id)->first();
        if($data->read_at == 0){
            DB::table('table_riwayat_jabatan')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        }
        return view('pages.admin.data-jabatan.edit', compact('data','dataPegawai'));
    }
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'status_validasi' => "required" ,
           
        ]);

        DB::table('table_riwayat_jabatan')->where('id',$id)->update([
           
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
           
            'title' => $request->title,
            'url' => 'riwayat/'.$id.'/edit',
            'message' => $pesan,
            'read_at' => 0,
            'recipient_at' => $id,
            'make_at' => auth()->user()->id

        ]);  
        return redirect('admin/data-jabatan/'.$request->user_id)->with('success', 'Data Berhasil Di Ubah!');
    }
}
