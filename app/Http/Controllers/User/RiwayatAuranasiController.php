<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatAuranasiController extends Controller
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
        return view('pages.user.riwayat-asuransi.index', compact('data'));
    }

    public function create()
    {
        $asuransi =  DB::table('t_master_asuransi')->get();
        return view('pages.user.riwayat-asuransi.create',compact('asuransi'));

    }

    public function edit($id)
    {
        $data =  DB::table('table_asuransi')->where('id',$id)->first();
        $asuransi =  DB::table('t_master_asuransi')->get();
        // dd($data);
        return view('pages.user.riwayat-asuransi.edit',compact('data','asuransi'));

    }
    public function store(Request $request)
    { 
        // dd($request);
         $validatedData = $request->validate([
            'no_polis' => "required" ,
            'nama_perusahaan' => "required" ,
            'jenis_asuransi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_akhir' => "required" ,
        ]);

        
        $data =  DB::table('table_asuransi')->insertGetId([
            'no_polis' => $request->no_polis,
            'nama_perusahaan' => $request->nama_perusahaan,
            'id_jenis_asuransi' => $request->jenis_asuransi,
            'tanggal_berakhir' => $request->tanggal_akhir,
            'tanggal_mulai' => $request->tanggal_mulai,
            'user_id' =>  auth()->user()->id
        ]);

        return redirect('user/riwayat-asuransi')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function destroy( $id)
    {
        DB::table('table_asuransi')->where('id',$id)->delete();
       return redirect('user/riwayat-asuransi')->with('success', 'Data Berhasil Di Hapus!');

    }

    public function update(Request $request,$id)
    {
         $validatedData = $request->validate([
            'no_polis' => "required" ,
            'nama_perusahaan' => "required" ,
            'jenis_asuransi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_akhir' => "required" ,
        ]);

        DB::table('table_asuransi')->where('id',$id)->update([
            'no_polis' => $request->no_polis,
            'nama_perusahaan' => $request->nama_perusahaan,
            'id_jenis_asuransi' => $request->jenis_asuransi,
            'tanggal_berakhir' => $request->tanggal_akhir,
            'tanggal_mulai' => $request->tanggal_mulai,
        ]);  
    
            return redirect('user/riwayat-asuransi')->with('success', 'Data Berhasil Di Ubah!');
    
    }

}
