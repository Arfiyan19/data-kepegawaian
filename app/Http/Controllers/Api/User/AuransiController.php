<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuransiController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_asuransi')
        ->join('t_master_asuransi', 'table_asuransi.id_jenis_asuransi', '=', 't_master_asuransi.id_asuransi') 
        ->select(
            't_master_asuransi.*',
            'table_asuransi.*',
            'table_asuransi.id as id_asuransi',

        )
        ->get();   
        return response()->json([ 
            'data'=> $data,
        ],200);
    }

    public function create()
    {
        $asuransi =  DB::table('t_master_asuransi')->get();
       
        return response()->json([  
            'asuransi'=> $asuransi,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }

    public function edit($id)
    {
        $data =  DB::table('table_asuransi')->where('id',$id)->first();
        $asuransi =  DB::table('t_master_asuransi')->get();
        return response()->json([ 
            'data'=> $data,
            'asuransi'=> $asuransi,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function store(Request $request)
    {  
           $validator = Validator::make($request->all(), [
            'no_polis' => "required" ,
            'nama_perusahaan' => "required" ,
            'jenis_asuransi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_akhir' => "required" ,
        ]);

        
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        $data =  DB::table('table_asuransi')->insertGetId([
            'no_polis' => $request->no_polis,
            'nama_perusahaan' => $request->nama_perusahaan,
            'id_jenis_asuransi' => $request->jenis_asuransi,
            'tanggal_berakhir' => $request->tanggal_akhir,
            'tanggal_mulai' => $request->tanggal_mulai,
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
        DB::table('table_asuransi')->where('id',$id)->delete();
        
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
        
    }

    public function update(Request $request,$id)
    {
           $validator = Validator::make($request->all(), [
            'no_polis' => "required" ,
            'nama_perusahaan' => "required" ,
            'jenis_asuransi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_akhir' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        DB::table('table_asuransi')->where('id',$id)->update([
            'no_polis' => $request->no_polis,
            'nama_perusahaan' => $request->nama_perusahaan,
            'id_jenis_asuransi' => $request->jenis_asuransi,
            'tanggal_berakhir' => $request->tanggal_akhir,
            'tanggal_mulai' => $request->tanggal_mulai,
        ]);  
        return response()->json([  
                'staus'=> true,
                'pesan'=> 'Data Berhasil Di update',
         ],200);
    }

}
