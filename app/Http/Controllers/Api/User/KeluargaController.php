<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
    public function index()
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
        ->orderBy('id', 'asc')->get();
        return response()->json([ 
            'data'=> $data,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function create()
    {   
        $kepala_keluarga = DB::table('t_master_hub_kepala_keluarga')->get();
        $jenjang_pendidikan = DB::table('t_master_jenjang_pendidikan')->get();
        return response()->json([ 
            'kepala_keluarga'=> $kepala_keluarga,
            'jenjang_pendidikan'=> $jenjang_pendidikan,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function edit($id)
    {
        $data =  DB::table('table_riwayat_keluarga')->where('id',$id)->first();
        $kepala_keluarga = DB::table('t_master_hub_kepala_keluarga')->get();
        $jenjang_pendidikan = DB::table('t_master_jenjang_pendidikan')->get();

        return response()->json([ 
            'data'=> $data,
            'kepala_keluarga'=> $kepala_keluarga,
            'jenjang_pendidikan'=> $jenjang_pendidikan,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => "required" ,
            'tgl_lahir' => "required" ,
            'kota_lahir' => "required" ,
            'id_jenjang_pendidikan' => "required" ,
            'jenis_kelamin' => "required" ,
            'dokumen_riwayat_keluarga' => "required|mimes:pdf|max:10000" ,

        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

            if($request->file('dokumen_riwayat_keluarga')){

                $dokumen_riwayat_keluarga = $request->file('dokumen_riwayat_keluarga');
                $name_dokumen_riwayat_keluarga  = time()."_".$dokumen_riwayat_keluarga->getClientOriginalName();
                $location = public_path('/images/riwayat_keluarga');
                $dokumen_riwayat_keluarga->move($location,$name_dokumen_riwayat_keluarga);
                }else{
                    $name_dokumen_riwayat_keluarga = "noimage.jpg";
                }

        $data =  DB::table('table_riwayat_keluarga')->insertGetId([
            'id_hub_kepala_keluarga' => $request->id_hub_kepala_keluarga,
            'nama_lengkap' => $request->nama_lengkap,
            'tgl_lahir' => $request->tgl_lahir,
            'kota_lahir' => $request->kota_lahir,
            'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'user_id' =>  auth()->user()->id,
            'dokumen_riwayat_keluarga' => $name_dokumen_riwayat_keluarga,

        ]);
        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Tambahkan',
        ],200);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => "required" ,
            'tgl_lahir' => "required" ,
            'kota_lahir' => "required" ,
            'id_jenjang_pendidikan' => "required" ,
            'jenis_kelamin' => "required" ,
            'dokumen_riwayat_keluarga' => "required|mimes:pdf|max:10000" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

             if($request->file('dokumen_riwayat_keluarga')){

            $dokumen_riwayat_keluarga = $request->file('dokumen_riwayat_keluarga');
            $name_dokumen_riwayat_keluarga  = time()."_".$dokumen_riwayat_keluarga->getClientOriginalName();
            $location = public_path('/images/riwayat-keluarga');
            $dokumen_riwayat_keluarga->move($location,$name_dokumen_riwayat_keluarga);
            $data =  DB::table('table_riwayat_keluarga')->where('id',$id)->update([
                'id_hub_kepala_keluarga' => $request->id_hub_kepala_keluarga,
                'nama_lengkap' => $request->nama_lengkap,
                'tgl_lahir' => $request->tgl_lahir,
                'kota_lahir' => $request->kota_lahir,
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'dokumen_riwayat_keluarga' => $name_dokumen_riwayat_keluarga,
            ]);
            }else{
                $data =  DB::table('table_riwayat_keluarga')->where('id',$id)->update([
                    'id_hub_kepala_keluarga' => $request->id_hub_kepala_keluarga,
                    'nama_lengkap' => $request->nama_lengkap,
                    'tgl_lahir' => $request->tgl_lahir,
                    'kota_lahir' => $request->kota_lahir,
                    'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }
        return response()->json([  
                'staus'=> true,
                'pesan'=> 'Data Berhasil Di update',
            ],200);
    
    }

    public function destroy( $id)
    {
        DB::table('table_riwayat_keluarga')->where('id',$id)->delete();
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }
 
    
}
