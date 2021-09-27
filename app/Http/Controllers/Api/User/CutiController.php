<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    public function index()
    { 
        $data = DB::table('table_cuti')
        ->join('t_master_cuti', 'table_cuti.jenis_cuti', '=', 't_master_cuti.id') 
        ->select(
            't_master_cuti.*',
            'table_cuti.*',
            'table_cuti.id as id_cuti',

        )
        ->get();  
        return response()->json([ 
            'data'=> $data,
        ],200);
    }

    public function create()
    {
        $jenis_cuti = DB::table('t_master_cuti')->get();
        return response()->json([ 
            'jenis_cuti'=> $jenis_cuti,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    
    
    public function edit($id)
    {
        $data =  DB::table('table_cuti')->where('id',$id)->first();
        $jenis_cuti = DB::table('t_master_cuti')->get();
   
        return response()->json([ 
            'jenis_cuti'=> $jenis_cuti,
            'data'=> $data,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);

    }
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'jenis_cuti' => "required" ,
            'no_surat_ijin' => "required" ,
            'tanggal_surat_ijin' => "required" ,
            'tanggal_surat_mulai' => "required" ,
            'tanggal_surat_akhir' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        
        $data =  DB::table('table_cuti')->insertGetId([
            'no_surat_ijin' => $request->no_surat_ijin,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_surat_ijin' => $request->tanggal_surat_ijin,
            'tanggal_surat_mulai' => $request->tanggal_surat_mulai,
            'tanggal_surat_selesai' => $request->tanggal_surat_akhir,
            'user_id' =>  auth()->user()->id
        ]);

        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Tambahkan',
        ],200);


    }

    public function destroy( $id)
    {
        DB::table('table_cuti')->where('id',$id)->delete();
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_cuti' => "required" ,
            'no_surat_ijin' => "required" ,
            'tanggal_surat_ijin' => "required" ,
            'tanggal_surat_mulai' => "required" ,
            'tanggal_surat_akhir' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        DB::table('table_cuti')->where('id',$id)->update([
            'no_surat_ijin' => $request->no_surat_ijin,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_surat_ijin' => $request->tanggal_surat_ijin,
            'tanggal_surat_mulai' => $request->tanggal_surat_mulai,
            'tanggal_surat_selesai' => $request->tanggal_surat_akhir,
            'user_id' =>  auth()->user()->id
        ]);  
    
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di update',
        ],200);
    
    }

}
