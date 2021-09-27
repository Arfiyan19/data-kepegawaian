<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsesmenController extends Controller
{
    public function index()
    { 
        $data = DB::table('table_riwayat_asesmen')
        ->join('t_master_jabatan', 'table_riwayat_asesmen.id_jabatan', '=', 't_master_jabatan.id')
        ->join('t_master_unit_kerja', 't_master_unit_kerja.id', '=', 'table_riwayat_asesmen.id_unit_kerja')
        ->select(
            'table_riwayat_asesmen.*',
            't_master_jabatan.*',
            't_master_unit_kerja.*',
            't_master_jabatan.id as id_jabatan',
            'table_riwayat_asesmen.id as id_riwayat',
            't_master_unit_kerja.id as id_unit',

        )
        ->get();  
        return response()->json([ 
            'data'=> $data,
        ],200);
    }

    public function create()
    {
        $jabatan = DB::table('t_master_jabatan')->get();
        $unit_kerja = DB::table('t_master_unit_kerja')->get();

        return response()->json([ 
            'jabatan'=> $jabatan,
            'unit_kerja'=> $unit_kerja,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);
    }

    public function edit($id)
    {
        $data =  DB::table('table_riwayat_asesmen')->where('id',$id)->first();
        $jabatan = DB::table('t_master_jabatan')->get();
        $unit_kerja = DB::table('t_master_unit_kerja')->get();

        return response()->json([ 
            'jabatan'=> $jabatan,
            'data'=> $data,
            'unit_kerja'=> $unit_kerja,
            'pesan'=> 'Data Berhasil Di Tampilkan',
        ],200);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dokumen_asesmen' => "required|mimes:pdf|max:10000" ,
            'tanggal_asesmen' => "required" ,
            'nilai_kompetensi' => "required" ,
            'nilai_potensi' => "required" ,
            'jabatan_id' => "required" ,
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }

        if($request->file('dokumen_asesmen')){

        $dokumen_asesmen = $request->file('dokumen_asesmen');
        $name_dokumen_asesmen  = time()."_".$dokumen_asesmen->getClientOriginalName();
        $location = public_path('/images/riwayat-asesmen');
        $dokumen_asesmen->move($location,$name_dokumen_asesmen);
        }else{
            $name_dokumen_asesmen = "noimage.jpg";
        }

        $data =  DB::table('table_riwayat_asesmen')->insertGetId([
            'tanggal_asesmen' => $request->tanggal_asesmen,
            'nilai_kompetensi' => $request->nilai_kompetensi,
            'nilai_potensi' => $request->nilai_potensi,
            'id_unit_kerja' => $request->unit_kerja_id,
            'id_jabatan' => $request->jabatan_id,
            'user_id' =>  auth()->user()->id,
            'created_at' =>  \Carbon\Carbon::now(), 
            'dokumen_asesmen' => $name_dokumen_asesmen
        ]);

        return response()->json([ 
            'data'=> $data,
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Tambahkan',
        ],200);
    }

    public function destroy( $id)
    {
        DB::table('table_riwayat_asesmen')->where('id',$id)->delete();
      
        return response()->json([  
            'staus'=> true,
            'pesan'=> 'Data Berhasil Di Hapus',
        ],200);
    }

    public function update(Request $request,$id)
    {
         $validatedData = $request->validate([
            'dokumen_asesmen' => "mimes:pdf|max:10000" ,
            'tanggal_asesmen' => "required" ,
            'nilai_kompetensi' => "required" ,
            'nilai_potensi' => "required" ,
            'jabatan_id' => "required" ,
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = 'Data Fail ';
            $responseArr['status'] = false;
            $responseArr['errors'] = $validator->errors();
            return response()->json($responseArr,400);
        }


             if($request->file('dokumen_asesmen')){

            $dokumen_asesmen = $request->file('dokumen_asesmen');
            $name_dokumen_asesmen  = time()."_".$dokumen_asesmen->getClientOriginalName();
            $location = public_path('/images/riwayat-asesmen');
            $dokumen_asesmen->move($location,$name_dokumen_asesmen);
            $data =  DB::table('table_riwayat_asesmen')->where('id',$id)->update([
                'tanggal_asesmen' => $request->tanggal_asesmen,
                'nilai_kompetensi' => $request->nilai_kompetensi,
                'nilai_potensi' => $request->nilai_potensi,
                'id_unit_kerja' => $request->unit_kerja_id,
                'id_jabatan' => $request->jabatan_id,
                'updated_at' => \Carbon\Carbon::now(),  
                'dokumen_asesmen' => $name_dokumen_asesmen
            ]);
            }else{
                $data =  DB::table('table_riwayat_asesmen')->where('id',$id)->update([
                    'tanggal_asesmen' => $request->tanggal_asesmen,
                    'nilai_kompetensi' => $request->nilai_kompetensi,
                    'nilai_potensi' => $request->nilai_potensi,
                    'id_unit_kerja' => $request->unit_kerja_id,
                    'id_jabatan' => $request->jabatan_id
                ]);
            }
    
            return response()->json([  
                'staus'=> true,
                'pesan'=> 'Data Berhasil Di update',
            ],200);
    
    }

}
