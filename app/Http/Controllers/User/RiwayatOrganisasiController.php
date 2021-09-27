<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RiwayatOrganisasiController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $data = DB::table('t_riwayat_organisasi')
        ->join('t_master_jenis_organisasi', 't_riwayat_organisasi.id_jenis_organisasi', '=', 't_master_jenis_organisasi.id_jenis_organisasi')
        ->join('t_kedudukan_organisasi', 't_kedudukan_organisasi.id_kedudukan_organiasi', '=', 't_riwayat_organisasi.id_kedudukan_organiasi')
        ->select(
            't_riwayat_organisasi.*',
            't_master_jenis_organisasi.*',
            't_kedudukan_organisasi.*',
            't_master_jenis_organisasi.id_jenis_organisasi as jenis organisasi',
            't_riwayat_organisasi.id as id_riwayat',
            't_kedudukan_organisasi.id_kedudukan_organiasi as Nama KEdudukan',

        )
        ->orderBy('id', 'asc')->get();
        return view('pages.user.riwayat-organisasi.index',compact('data'));


    }
    
    public function create()
    {
        $id_jenis_organisasi = DB::table('t_master_jenis_organisasi')->get();
        $id_kedudukan_organiasi = DB::table('t_kedudukan_organisasi')->get();
        return view('pages.user.riwayat-organisasi.create',compact('id_jenis_organisasi','id_kedudukan_organiasi'));


    }
    public function store(Request $request)
    {
        
          $validatedData = $request->validate([
            'nama_organisasi_lembaga' => "required" ,
            'tempat_kedudukan_organisasi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'surat_keputusan' => "required" ,
            'tanggal_surat_keputusan' => "required" ,
        ]);


        $data =  DB::table('t_riwayat_organisasi')->insertGetId([
            'nama_organisasi_lembaga' => $request->nama_organisasi_lembaga,
            'id_jenis_organisasi' => $request->id_jenis_organisasi,
            'id_kedudukan_organiasi' => $request->id_kedudukan_organiasi,
            'tempat_kedudukan_organisasi' => $request->tempat_kedudukan_organisasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'surat_keputusan' => $request->surat_keputusan,
            'tanggal_surat_keputusan' => $request->tanggal_surat_keputusan,
            'user_id' =>  auth()->user()->id,
        ]);

        return redirect('user/riwayat-organisasi')->with('success', 'Data Berhasil Di Tambahkan!');

    }
    public function edit($id)
    {
        $data =  DB::table('t_riwayat_organisasi')->where('id',$id)->first();
        $id_jenis_organisasi = DB::table('t_master_jenis_organisasi')->get();
        $id_kedudukan_organiasi = DB::table('t_kedudukan_organisasi')->get();

        return view('pages.user.riwayat-organisasi.edit',compact('data','id_jenis_organisasi','id_kedudukan_organiasi'));
    }

    public function destroy( $id)
    {
        DB::table('t_riwayat_organisasi')->where('id',$id)->delete();
       return redirect('user/riwayat-organisasi')->with('success', 'Data Berhasil Di Hapus!');

    }

    public function update(Request $request,$id)
    {
          $validatedData = $request->validate([
            'nama_organisasi_lembaga' => "required" ,
            'tempat_kedudukan_organisasi' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'surat_keputusan' => "required" ,
            'tanggal_surat_keputusan' => "required" ,
        ]);

        $data =  DB::table('t_riwayat_organisasi')->where('id',$id)->update([
            'nama_organisasi_lembaga' => $request->nama_organisasi_lembaga,
            'id_jenis_organisasi' => $request->id_jenis_organisasi,
            'id_kedudukan_organiasi' => $request->id_kedudukan_organiasi,
            'tempat_kedudukan_organisasi' => $request->tempat_kedudukan_organisasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'surat_keputusan' => $request->surat_keputusan,
            'tanggal_surat_keputusan' => $request->tanggal_surat_keputusan,
            'user_id' =>  auth()->user()->id,
        ]);
        
            return redirect('user/riwayat-organisasi')->with('success', 'Data Berhasil Di Ubah!');
    
    }
}
