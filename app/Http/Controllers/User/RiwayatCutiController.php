<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RiwayatCutiController extends Controller
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
        
        return view('pages.user.riwayat-cuti.index',compact('data'));
    }

    public function create()
    {
        $jenis_cuti = DB::table('t_master_cuti')->get();
        return view('pages.user.riwayat-cuti.create',compact('jenis_cuti'));

    }
    
    
    public function edit($id)
    {
        $data =  DB::table('table_cuti')->where('id',$id)->first();
        $jenis_cuti = DB::table('t_master_cuti')->get();
   
        return view('pages.user.riwayat-cuti.edit',compact('data','jenis_cuti'));

    }
    public function store(Request $request)
    { 
          $validatedData = $request->validate([
            'jenis_cuti' => "required" ,
            'no_surat_ijin' => "required" ,
            'tanggal_surat_ijin' => "required" ,
            'tanggal_surat_mulai' => "required" ,
            'tanggal_surat_akhir' => "required" ,
        ]);

        
        $data =  DB::table('table_cuti')->insertGetId([
            'no_surat_ijin' => $request->no_surat_ijin,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_surat_ijin' => $request->tanggal_surat_ijin,
            'tanggal_surat_mulai' => $request->tanggal_surat_mulai,
            'tanggal_surat_selesai' => $request->tanggal_surat_akhir,
            'user_id' =>  auth()->user()->id
        ]);

        return redirect('user/riwayat-cuti')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function destroy( $id)
    {
        DB::table('table_cuti')->where('id',$id)->delete();
       return redirect('user/riwayat-cuti')->with('success', 'Data Berhasil Di Hapus!');

    }

    public function update(Request $request,$id)
    {
          $validatedData = $request->validate([
            'jenis_cuti' => "required" ,
            'no_surat_ijin' => "required" ,
            'tanggal_surat_ijin' => "required" ,
            'tanggal_surat_mulai' => "required" ,
            'tanggal_surat_akhir' => "required" ,
        ]);

        DB::table('table_cuti')->where('id',$id)->update([
            'no_surat_ijin' => $request->no_surat_ijin,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_surat_ijin' => $request->tanggal_surat_ijin,
            'tanggal_surat_mulai' => $request->tanggal_surat_mulai,
            'tanggal_surat_selesai' => $request->tanggal_surat_akhir,
            'user_id' =>  auth()->user()->id
        ]);  
    
            return redirect('user/riwayat-cuti')->with('success', 'Data Berhasil Di Ubah!');
    
    }

}
