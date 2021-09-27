<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendidikanDinasController extends Controller
{
    public function index()
    {   
        $data = DB::table('table_pendidikan_pelatihan_dinas')
        ->join('t_master_jenis_diklat', 'table_pendidikan_pelatihan_dinas.jenis_diklat', '=', 't_master_jenis_diklat.id_jenis_diklat') 
        ->select(
            'table_pendidikan_pelatihan_dinas.*', 
            't_master_jenis_diklat.jenis_diklat', 

        )
        ->get(); 
        return response()->json([ 
            'data'=> $data,
        ],200);
    }
    public function create()
    {   
        $jenis_diklat = DB::table('t_master_jenis_diklat')->get(); 
        return response()->json([ 
            'jenis_diklat'=> $jenis_diklat, 
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }
   
    
    public function edit($id)
    {
        $data =  DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->first();
        $jenis_diklat = DB::table('t_master_jenis_diklat')->get(); 

        
        return response()->json([ 
            'jenis_diklat'=> $jenis_diklat,
            'data'=> $data, 
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);

    }
    public function store(Request $request)
    {  
           $validator = Validator::make($request->all(), [
            "lembaga_penyelenggara" => 'required',
            "lokasi" =>  'required',
            "tanggal_mulai" =>  'required',
            "tanggal_berakhir" =>   'required',
            "jam_latihan" =>  'required',
            "tangal_sk_kelulusan" =>  'required',
            "no_sertifikat" =>  'required',
            "tanggal_no_sertifikat" => 'required',
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }
        
        $data =  DB::table('table_pendidikan_pelatihan_dinas')->insertGetId([
            'lembaga_penyelenggara' => $request->lembaga_penyelenggara,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'no_sk_kelulusan' => $request->no_sk_kelulusan,
            'jenis_diklat' => $request->jenis_diklat,
            'jam_latihan' => $request->jam_latihan,
            'tangal_sk_kelulusan' => $request->tangal_sk_kelulusan,
            'no_sertifikat' => $request->no_sertifikat,
            'tanggal_no_sertifikat' => $request->tanggal_no_sertifikat,
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
        DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->delete();
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }

    public function update(Request $request,$id)
    {
           $validator = Validator::make($request->all(), [
            "lembaga_penyelenggara" => 'required',
            "lokasi" =>  'required',
            "tanggal_mulai" =>  'required',
            "tanggal_berakhir" =>   'required',
            "jam_latihan" =>  'required',
            "tangal_sk_kelulusan" =>  'required',
            "no_sertifikat" =>  'required',
            "tanggal_no_sertifikat" => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->update([
            'lembaga_penyelenggara' => $request->lembaga_penyelenggara,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'no_sk_kelulusan' => $request->no_sk_kelulusan,
            'jenis_diklat' => $request->jenis_diklat,
            'jam_latihan' => $request->jam_latihan,
            'tangal_sk_kelulusan' => $request->tangal_sk_kelulusan,
            'no_sertifikat' => $request->no_sertifikat,
            'tanggal_no_sertifikat' => $request->tanggal_no_sertifikat,
        ]);  
    
        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Ubah',
        ],200);
    
    }

}
