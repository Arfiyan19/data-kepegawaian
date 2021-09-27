<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PendidikanFormalConroller extends Controller
{
    public function index()
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
        ->orderBy('id', 'asc')->get();
        return response()->json([ 
            'data'=> $data,
        ],200);
    }
    public function create()
    {   
        $jenjang_pendidikan = DB::table('t_master_jenjang_pendidikan')->get();
        $detail_jenjang_pendidikan = DB::table('t_master_detail_jenjang_pendidikan')->get();
        $biaya_belajar = DB::table('t_master_biaya_belajar')->get();

        return response()->json([ 
            'jenjang_pendidikan'=> $jenjang_pendidikan,
            'detail_jenjang_pendidikan'=> $detail_jenjang_pendidikan,
            'biaya_belajar'=> $biaya_belajar,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }

    public function store(Request $request)
    {
        
           $validator = Validator::make($request->all(), [
            'nama_lembaga_pendidikan' => "required" ,
            'tempat_lembaga_pendidikan' => "required" ,
            'nama_kepala_lembaga_pendidikan' => "required" ,
            'gelar' => "required" ,
            'no_ijazah_sertifikat' => "required" ,
            'tanggal_ijazah_sertifikat' => "required" ,
            'atas_izin_pimpinan' => "required" ,
            'sk' => "required" ,
            'tanggal_sk' => "required" ,
            'dokumen_pendidikan_formal' => "required|mimes:pdf|max:10000" ,

        ]);
            if($request->file('dokumen_pendidikan_formal')){

                $dokumen_pendidikan_formal = $request->file('dokumen_pendidikan_formal');
                $name_dokumen_pendidikan_formal  = time()."_".$dokumen_pendidikan_formal->getClientOriginalName();
                $location = public_path('/images/riwayat-pendidikan-formal');
                $dokumen_pendidikan_formal->move($location,$name_dokumen_pendidikan_formal);
                }else{
                    $name_dokumen_pendidikan_formal = "noimage.jpg";
                }

        $data =  DB::table('t_riwayat_pendidikan_formal')->insertGetId([
            'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
            'id_detail_jenjang_pendidikan' => $request->id_detail_jenjang_pendidikan,
            'nama_lembaga_pendidikan' => $request->nama_lembaga_pendidikan,
            'tempat_lembaga_pendidikan' => $request->tempat_lembaga_pendidikan,
            'nama_kepala_lembaga_pendidikan' => $request->nama_kepala_lembaga_pendidikan,
            'gelar' => $request->gelar,
            'no_ijazah_sertifikat' => $request->no_ijazah_sertifikat,
            'tanggal_ijazah_sertifikat' => $request->tanggal_ijazah_sertifikat,
            'id_biaya_belajar' => $request->id_biaya_belajar,
            'atas_izin_pimpinan' => $request->atas_izin_pimpinan,
            'sk' => $request->sk,
            'tanggal_sk' => $request->tanggal_sk,
            'user_id' =>  auth()->user()->id,
            'dokumen_pendidikan_formal' => $name_dokumen_pendidikan_formal,

        ]);
        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Tambahkan',
        ],200);

    }
    public function edit($id)
    {
        $data =  DB::table('t_riwayat_pendidikan_formal')->where('id',$id)->first();
        $jenjang_pendidikan = DB::table('t_master_jenjang_pendidikan')->get();
        $detail_jenjang_pendidikan = DB::table('t_master_detail_jenjang_pendidikan')->get();
        $biaya_belajar = DB::table('t_master_biaya_belajar')->get();

        return response()->json([ 
            'jenjang_pendidikan'=> $jenjang_pendidikan,
            'detail_jenjang_pendidikan'=> $detail_jenjang_pendidikan,
            'biaya_belajar'=> $biaya_belajar,
            'data' => $data,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function update(Request $request,$id)
    {
           $validator = Validator::make($request->all(), [
            'nama_lembaga_pendidikan' => "required" ,
            'tempat_lembaga_pendidikan' => "required" ,
            'nama_kepala_lembaga_pendidikan' => "required" ,
            'gelar' => "required" ,
            'no_ijazah_sertifikat' => "required" ,
            'tanggal_ijazah_sertifikat' => "required" ,
            'atas_izin_pimpinan' => "required" ,
            'sk' => "required" ,
            'tanggal_sk' => "required" ,
            'dokumen_pendidikan_formal' => "required|mimes:pdf|max:10000" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }


             if($request->file('dokumen_pendidikan_formal')){

            $dokumen_pendidikan_formal = $request->file('dokumen_pendidikan_formal');
            $name_dokumen_pendidikan_formal  = time()."_".$dokumen_pendidikan_formal->getClientOriginalName();
            $location = public_path('/images/riwayat-pendidikan-formal');
            $dokumen_pendidikan_formal->move($location,$name_dokumen_pendidikan_formal);
            $data =  DB::table('t_riwayat_pendidikan_formal')->where('id',$id)->update([
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
            'id_detail_jenjang_pendidikan' => $request->id_detail_jenjang_pendidikan,
            'nama_lembaga_pendidikan' => $request->nama_lembaga_pendidikan,
            'tempat_lembaga_pendidikan' => $request->tempat_lembaga_pendidikan,
            'nama_kepala_lembaga_pendidikan' => $request->nama_kepala_lembaga_pendidikan,
            'gelar' => $request->gelar,
            'no_ijazah_sertifikat' => $request->no_ijazah_sertifikat,
            'tanggal_ijazah_sertifikat' => $request->tanggal_ijazah_sertifikat,
            'id_biaya_belajar' => $request->id_biaya_belajar,
            'atas_izin_pimpinan' => $request->atas_izin_pimpinan,
            'sk' => $request->sk,
            'tanggal_sk' => $request->tanggal_sk,
            'dokumen_pendidikan_formal' => $name_dokumen_pendidikan_formal
            ]);
            }else{
                $data =  DB::table('t_riwayat_pendidikan_formal')->where('id',$id)->update([
                    'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                    'id_detail_jenjang_pendidikan' => $request->id_detail_jenjang_pendidikan,
                    'nama_lembaga_pendidikan' => $request->nama_lembaga_pendidikan,
                    'tempat_lembaga_pendidikan' => $request->tempat_lembaga_pendidikan,
                    'nama_kepala_lembaga_pendidikan' => $request->nama_kepala_lembaga_pendidikan,
                    'gelar' => $request->gelar,
                    'no_ijazah_sertifikat' => $request->no_ijazah_sertifikat,
                    'tanggal_ijazah_sertifikat' => $request->tanggal_ijazah_sertifikat,
                    'id_biaya_belajar' => $request->id_biaya_belajar,
                    'atas_izin_pimpinan' => $request->atas_izin_pimpinan,
                    'sk' => $request->sk,
                    'tanggal_sk' => $request->tanggal_sk,
                ]);
            }
    
    
           
            return response()->json([  
                'staus'=> true,
                'pesan'=> 'Data Berhasil Di update',
            ],200);
    
    }
    
    public function destroy( $id)
    {
        DB::table('t_riwayat_pendidikan_formal')->where('id',$id)->delete();
      return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }
    
}
