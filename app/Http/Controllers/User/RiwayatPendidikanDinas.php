<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatPendidikanDinas extends Controller
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
// dd($data);
        return view('pages.user.riwayat-pendidikan-dinas.index',compact('data'));
    }
    public function create()
    {   
        $jenis_diklat = DB::table('t_master_jenis_diklat')->get(); 
        return view('pages.user.riwayat-pendidikan-dinas.create',compact('jenis_diklat'));


    }
   
    
    public function edit($id)
    {
        $data =  DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->first();
        $jenis_diklat = DB::table('t_master_jenis_diklat')->get(); 

        return view('pages.user.riwayat-pendidikan-dinas.edit',compact('data','jenis_diklat'));

    }
    public function store(Request $request)
    {  
         $validatedData = $request->validate([
            "lembaga_penyelenggara" => 'required',
            "lokasi" =>  'required',
            "tanggal_mulai" =>  'required',
            "tanggal_berakhir" =>   'required',
            "jam_latihan" =>  'required',
            "tangal_sk_kelulusan" =>  'required',
            "no_sertifikat" =>  'required',
            "tanggal_no_sertifikat" => 'required',
        ]);

        
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

        return redirect('user/riwayat-pendidikan-dinas')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function destroy( $id)
    {
        DB::table('table_pendidikan_pelatihan_dinas')->where('id',$id)->delete();
       return redirect('user/riwayat-pendidikan-dinas')->with('success', 'Data Berhasil Di Hapus!');

    }

    public function update(Request $request,$id)
    {
         $validatedData = $request->validate([
            "lembaga_penyelenggara" => 'required',
            "lokasi" =>  'required',
            "tanggal_mulai" =>  'required',
            "tanggal_berakhir" =>   'required',
            "jam_latihan" =>  'required',
            "tangal_sk_kelulusan" =>  'required',
            "no_sertifikat" =>  'required',
            "tanggal_no_sertifikat" => 'required',
        ]);

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
    
            return redirect('user/riwayat-pendidikan-dinas')->with('success', 'Data Berhasil Di Ubah!');
    
    }

}
