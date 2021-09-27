<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class OrganisasiConroller extends Controller
{
    public function index()
    {   
        
        $data = DB::table('t_riwayat_organisasi')
        ->join('t_master_jenis_organisasi', 't_riwayat_organisasi.id_jenis_organisasi', '=', 't_master_jenis_organisasi.id_jenis_organisasi')
        ->join('t_kedudukan_organisasi', 't_kedudukan_organisasi.id_kedudukan_organiasi', '=', 't_riwayat_organisasi.id_kedudukan_organiasi')
        ->select(
            't_riwayat_organisasi.*',
            't_master_jenis_organisasi.*',
            't_kedudukan_organisasi.*',
            't_master_jenis_organisasi.id_jenis_organisasi as jenis organisasi',
            't_riwayat_organisasi.id as id_riwayat',
            't_kedudukan_organisasi.id_kedudukan_organiasi as Nama KEdudukan',

        )
        ->orderBy('id', 'asc')->get();
        return response()->json([ 
            'data'=> $data,
        ],200);
    }
    
    public function create()
    {
        $jenis_organisasi = DB::table('t_master_jenis_organisasi')->get();
        $kependudukan_organisasi = DB::table('t_kedudukan_organisasi')->get();
        return response()->json([ 
            'jenis_organisasi'=> $jenis_organisasi,
            'kependudukan_organisasi'=> $kependudukan_organisasi,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function store(Request $request)
    {
        
          $validator = Validator::make($request->all(), [
            'nama_organisasi_lembaga' => "required" ,
            'tempat_kedudukan_organisasi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'surat_keputusan' => "required" ,
            'tanggal_surat_keputusan' => "required" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        $data =  DB::table('t_riwayat_organisasi')->insertGetId([
            'nama_organisasi_lembaga' => $request->nama_organisasi_lembaga,
            'id_jenis_organisasi' => $request->id_jenis_organisasi,
            'id_kedudukan_organiasi' => $request->id_kedudukan_organiasi,
            'tempat_kedudukan_organisasi' => $request->tempat_kedudukan_organisasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'surat_keputusan' => $request->surat_keputusan,
            'tanggal_surat_keputusan' => $request->tanggal_surat_keputusan,
            'user_id' =>  auth()->user()->id,
        ]);

        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Tambahkan',
        ],200);

    }
    public function edit($id)
    {
        $data =  DB::table('t_riwayat_organisasi')->where('id',$id)->first();
        $jenis_organisasi = DB::table('t_master_jenis_organisasi')->get();
        $kedudukan_organiasi = DB::table('t_kedudukan_organisasi')->get();

       
        return response()->json([ 
            'jenis_organisasi'=> $jenis_organisasi,
            'data'=> $data,
            'kedudukan_organiasi'=> $kedudukan_organiasi,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);

    }

    public function destroy( $id)
    {
        DB::table('t_riwayat_organisasi')->where('id',$id)->delete();
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }

    public function update(Request $request,$id)
    {
          $validator = Validator::make($request->all(), [
            'nama_organisasi_lembaga' => "required" ,
            'tempat_kedudukan_organisasi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'surat_keputusan' => "required" ,
            'tanggal_surat_keputusan' => "required" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        $data =  DB::table('t_riwayat_organisasi')->where('id',$id)->update([
            'nama_organisasi_lembaga' => $request->nama_organisasi_lembaga,
            'id_jenis_organisasi' => $request->id_jenis_organisasi,
            'id_kedudukan_organiasi' => $request->id_kedudukan_organiasi,
            'tempat_kedudukan_organisasi' => $request->tempat_kedudukan_organisasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'surat_keputusan' => $request->surat_keputusan,
            'tanggal_surat_keputusan' => $request->tanggal_surat_keputusan,
            'user_id' =>  auth()->user()->id,
        ]);
        
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di update',
        ],200);
        
    }
}
