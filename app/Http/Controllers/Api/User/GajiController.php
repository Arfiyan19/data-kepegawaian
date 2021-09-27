<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GajiController extends Controller
{
    public function index()
    {   

        $data = DB::table('t_riwayat_gaji_berkala')
        ->join('t_master_golongan', 't_master_golongan.id_golongan', '=', 't_riwayat_gaji_berkala.id_golongan')
                ->select(
                    't_riwayat_gaji_berkala.*',
                    't_master_golongan.*',
                    't_riwayat_gaji_berkala.id as id_riwayat_gaji',
                    't_master_golongan.id_golongan as id detail golongan'
                )
        ->orderBy('id', 'asc')->get();

        return response()->json([ 
            'data'=> $data,
        ],200);
    }
    
    public function create()
    {   
        $golongan = DB::table('t_master_golongan')->get();
        return response()->json([ 
            'golongan'=> $golongan,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);

    }
    public function store(Request $request)
    {
           $validator = Validator::make($request->all(), [
            'terhitung_tanggal_mulai_kepanggkatan' => "required" ,
            'masa_kerja_gol_tahun_kepanggkatan' => "required" ,
            'masa_kerja_gol_bulan_kepanggkatan' => "required" ,
            'gaji_pokok_baru' => "required" ,
            'gaji_pokok_lama' => "required" ,
            'terhitung_tanggal_mulai_penggajian' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'masa_kerja_gol_tahun_penggajian' => "required" ,
            'masa_kerja_gol_bulan_penggajian' => "required" ,
            'keterangan_jabatan' => "required" ,
            'pejabat_dan_jabatan_penandatangan_kgb' => "required" ,
            'keterangan' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        $data =  DB::table('t_riwayat_gaji_berkala')->insertGetId([
            'id_golongan' => $request->id_golongan,
            'terhitung_tanggal_mulai_kepanggkatan' => $request->terhitung_tanggal_mulai_kepanggkatan,
            'masa_kerja_gol_tahun_kepanggkatan' => $request->masa_kerja_gol_tahun_kepanggkatan,
            'masa_kerja_gol_bulan_kepanggkatan' => $request->masa_kerja_gol_bulan_kepanggkatan,
            'gaji_pokok_baru' => $request->gaji_pokok_baru,
            'gaji_pokok_lama' => $request->gaji_pokok_lama,
            'terhitung_tanggal_mulai_penggajian' => $request->terhitung_tanggal_mulai_penggajian,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'masa_kerja_gol_tahun_penggajian' => $request->masa_kerja_gol_tahun_penggajian,
            'masa_kerja_gol_bulan_penggajian' => $request->masa_kerja_gol_bulan_penggajian,
            'keterangan_jabatan' => $request->keterangan_jabatan,
            'pejabat_dan_jabatan_penandatangan_kgb' => $request->pejabat_dan_jabatan_penandatangan_kgb,
            'keterangan' => $request->keterangan,
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
        $data =  DB::table('t_riwayat_gaji_berkala')->where('id',$id)->first();
        $golongan = DB::table('t_master_golongan')->get();
        return response()->json([ 
            'golongan'=> $golongan,
            'data'=> $data,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function update(Request $request,$id)
    {
           $validator = Validator::make($request->all(), [
            'terhitung_tanggal_mulai_kepanggkatan' => "required" ,
            'masa_kerja_gol_tahun_kepanggkatan' => "required" ,
            'masa_kerja_gol_bulan_kepanggkatan' => "required" ,
            'gaji_pokok_baru' => "required" ,
            'gaji_pokok_lama' => "required" ,
            'terhitung_tanggal_mulai_penggajian' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'masa_kerja_gol_tahun_penggajian' => "required" ,
            'masa_kerja_gol_bulan_penggajian' => "required" ,
            'keterangan_jabatan' => "required" ,
            'pejabat_dan_jabatan_penandatangan_kgb' => "required" ,
            'keterangan' => "required" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        $data =  DB::table('t_riwayat_gaji_berkala')->where('id',$id)->update([
            'id_golongan' => $request->id_golongan,
            'terhitung_tanggal_mulai_kepanggkatan' => $request->terhitung_tanggal_mulai_kepanggkatan,
            'masa_kerja_gol_tahun_kepanggkatan' => $request->masa_kerja_gol_tahun_kepanggkatan,
            'masa_kerja_gol_bulan_kepanggkatan' => $request->masa_kerja_gol_bulan_kepanggkatan,
            'gaji_pokok_baru' => $request->gaji_pokok_baru,
            'gaji_pokok_lama' => $request->gaji_pokok_lama,
            'terhitung_tanggal_mulai_penggajian' => $request->terhitung_tanggal_mulai_penggajian,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'masa_kerja_gol_tahun_penggajian' => $request->masa_kerja_gol_tahun_penggajian,
            'masa_kerja_gol_bulan_penggajian' => $request->masa_kerja_gol_bulan_penggajian,
            'keterangan_jabatan' => $request->keterangan_jabatan,
            'pejabat_dan_jabatan_penandatangan_kgb' => $request->pejabat_dan_jabatan_penandatangan_kgb,
            'keterangan' => $request->keterangan,
            'user_id' =>  auth()->user()->id,
        ]);
        
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di update',
        ],200);
    
    }
    public function destroy( $id)
    {
        DB::table('t_riwayat_gaji_berkala')->where('id',$id)->delete();
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }
    
}
