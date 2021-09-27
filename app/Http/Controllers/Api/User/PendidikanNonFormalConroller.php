<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PendidikanNonFormalConroller extends Controller
{
    public function index()
    {   
        $data = DB::table('t_riwayat_pendidikan_non_formal')
        ->get();
        return response()->json([ 
            'data'=> $data,
        ],200);
    }
   
    public function store(Request $request)
    {
        
   $validator = Validator::make($request->all(), [
            'nama_pendidikan_non_formal' => "required" ,
            'penyelenggara_sponsor_lembaga' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'tempat' => "required" ,
            'peranan' => "required" ,
            'catatan' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        $data =  DB::table('t_riwayat_pendidikan_non_formal')->insertGetId([
            'nama_pendidikan_non_formal' => $request->nama_pendidikan_non_formal,
            'penyelenggara_sponsor_lembaga' => $request->penyelenggara_sponsor_lembaga,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'tempat' => $request->tempat,
            'peranan' => $request->peranan,
            'catatan' => $request->catatan,
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
        $data =  DB::table('t_riwayat_pendidikan_non_formal')->where('id',$id)->first();
        return response()->json([ 
            'data'=> $data,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
    public function update(Request $request,$id)
    {
   $validator = Validator::make($request->all(), [
            'nama_pendidikan_non_formal' => "required" ,
            'penyelenggara_sponsor_lembaga' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'tempat' => "required" ,
            'peranan' => "required" ,
            'catatan' => "required" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        $data =  DB::table('t_riwayat_pendidikan_non_formal')->where('id',$id)->update([
            'nama_pendidikan_non_formal' => $request->nama_pendidikan_non_formal,
            'penyelenggara_sponsor_lembaga' => $request->penyelenggara_sponsor_lembaga,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'tempat' => $request->tempat,
            'peranan' => $request->peranan,
            'catatan' => $request->catatan,
            'user_id' =>  auth()->user()->id,
        ]);
        
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di update',
        ],200);
    
    }
    public function destroy( $id)
    {
        DB::table('t_riwayat_pendidikan_non_formal')->where('id',$id)->delete();
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }
}
