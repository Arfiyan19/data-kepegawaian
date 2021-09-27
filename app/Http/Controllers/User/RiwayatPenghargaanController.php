<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class RiwayatPenghargaanController extends Controller
{
    public function index()
    {   
        $data = DB::table('t_riwayat_penghargaan')
        ->get();
        return view('pages.user.riwayat-penghargaan.index',compact('data'));
      
    }
    public function create()
    {   
        return view('pages.user.riwayat-penghargaan.create');
    }
    public function store(Request $request)
    {
        
         $validatedData = $request->validate([
            'nama_tanda_jasa_penghargaan' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'no_piagam' => "required" ,
            'tanggal_piagam' => "required" ,
            'badan_instansi_yg_memberikan' => "required" ,
        ]);


        $data =  DB::table('t_riwayat_penghargaan')->insertGetId([
            'nama_tanda_jasa_penghargaan' => $request->nama_tanda_jasa_penghargaan,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'no_piagam' => $request->no_piagam,
            'tanggal_piagam' => $request->tanggal_piagam,
            'badan_instansi_yg_memberikan' => $request->badan_instansi_yg_memberikan,
            'user_id' =>  auth()->user()->id,
        ]);

        return redirect('user/riwayat-penghargaan')->with('success', 'Data Berhasil Di Tambahkan!');
    }
    public function edit($id)
    {
        $data =  DB::table('t_riwayat_penghargaan')->where('id',$id)->first();

        return view('pages.user.riwayat-penghargaan.edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
         $validatedData = $request->validate([
            'nama_tanda_jasa_penghargaan' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'no_piagam' => "required" ,
            'tanggal_piagam' => "required" ,
            'badan_instansi_yg_memberikan' => "required" ,
        ]);

        $data =  DB::table('t_riwayat_penghargaan')->where('id',$id)->update([
            'nama_tanda_jasa_penghargaan' => $request->nama_tanda_jasa_penghargaan,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'no_piagam' => $request->no_piagam,
            'tanggal_piagam' => $request->tanggal_piagam,
            'badan_instansi_yg_memberikan' => $request->badan_instansi_yg_memberikan,
            'user_id' =>  auth()->user()->id,
        ]);
        
            return redirect('user/riwayat-penghargaan')->with('success', 'Data Berhasil Di Ubah!');
    
    }


    public function destroy( $id)
    {
        DB::table('t_riwayat_penghargaan')->where('id',$id)->delete();
       return redirect('user/riwayat-penghargaan')->with('success', 'Data Berhasil Di Hapus!');

    }
}
