<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenghargaanController extends Controller
{
   
    public function index()
    {   
        $data = DB::table('t_riwayat_penghargaan')
        ->get();
        return response()->json([ 
            'data'=> $data,
        ],200);
    }
 
    public function store(Request $request)
    {
        
           $validator = Validator::make($request->all(), [
            'nama_tanda_jasa_penghargaan' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'no_piagam' => "required" ,
            'tanggal_piagam' => "required" ,
            'badan_instansi_yg_memberikan' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        $data =  DB::table('t_riwayat_penghargaan')->insertGetId([
            'nama_tanda_jasa_penghargaan' => $request->nama_tanda_jasa_penghargaan,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'no_piagam' => $request->no_piagam,
            'tanggal_piagam' => $request->tanggal_piagam,
            'badan_instansi_yg_memberikan' => $request->badan_instansi_yg_memberikan,
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
        $data =  DB::table('t_riwayat_penghargaan')->where('id',$id)->first();

        return response()->json([  
            'data'=> $data, 
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tanda_jasa_penghargaan' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'no_piagam' => "required" ,
            'tanggal_piagam' => "required" ,
            'badan_instansi_yg_memberikan' => "required" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        $data =  DB::table('t_riwayat_penghargaan')->where('id',$id)->update([
            'nama_tanda_jasa_penghargaan' => $request->nama_tanda_jasa_penghargaan,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'no_piagam' => $request->no_piagam,
            'tanggal_piagam' => $request->tanggal_piagam,
            'badan_instansi_yg_memberikan' => $request->badan_instansi_yg_memberikan,
            'user_id' =>  auth()->user()->id,
        ]);
        
        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Update',
        ],200);
    
    }


    public function destroy( $id)
    {
        DB::table('t_riwayat_penghargaan')->where('id',$id)->delete();
       return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }
}
