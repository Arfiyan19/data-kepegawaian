<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiwayatGajiBerkalaController extends Controller
{
    public function index()
    {   

        $data = DB::table('t_riwayat_gaji_berkala')
        ->join('t_master_golongan', 't_master_golongan.id_golongan', '=', 't_riwayat_gaji_berkala.id_golongan')
                ->select(
                    't_riwayat_gaji_berkala.*',
                    't_master_golongan.*',
                    't_riwayat_gaji_berkala.id as id_riwayat_gaji',
                    't_master_golongan.id_golongan as id detail golongan'
                )
        ->orderBy('id', 'asc')->get();
                return view('pages.user.riwayat-gaji-berkala.index',compact('data'));
    }
    
    public function create()
    {   
        $id_golongan = DB::table('t_master_golongan')->get();
        return view('pages.user.riwayat-gaji-berkala.create',compact('id_golongan'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'terhitung_tanggal_mulai_kepanggkatan' => "required" ,
            'masa_kerja_gol_tahun_kepanggkatan' => "required" ,
            'masa_kerja_gol_bulan_kepanggkatan' => "required" ,
            'gaji_pokok_baru' => "required" ,
            'gaji_pokok_lama' => "required" ,
            'terhitung_tanggal_mulai_penggajian' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'masa_kerja_gol_tahun_penggajian' => "required" ,
            'masa_kerja_gol_bulan_penggajian' => "required" ,
            'keterangan_jabatan' => "required" ,
            'pejabat_dan_jabatan_penandatangan_kgb' => "required" ,
            'keterangan' => "required" ,
        ]);


        $data =  DB::table('t_riwayat_gaji_berkala')->insertGetId([
            'id_golongan' => $request->id_golongan,
            'terhitung_tanggal_mulai_kepanggkatan' => $request->terhitung_tanggal_mulai_kepanggkatan,
            'masa_kerja_gol_tahun_kepanggkatan' => $request->masa_kerja_gol_tahun_kepanggkatan,
            'masa_kerja_gol_bulan_kepanggkatan' => $request->masa_kerja_gol_bulan_kepanggkatan,
            'gaji_pokok_baru' => $request->gaji_pokok_baru,
            'gaji_pokok_lama' => $request->gaji_pokok_lama,
            'terhitung_tanggal_mulai_penggajian' => $request->terhitung_tanggal_mulai_penggajian,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'masa_kerja_gol_tahun_penggajian' => $request->masa_kerja_gol_tahun_penggajian,
            'masa_kerja_gol_bulan_penggajian' => $request->masa_kerja_gol_bulan_penggajian,
            'keterangan_jabatan' => $request->keterangan_jabatan,
            'pejabat_dan_jabatan_penandatangan_kgb' => $request->pejabat_dan_jabatan_penandatangan_kgb,
            'keterangan' => $request->keterangan,
            'user_id' =>  auth()->user()->id,
        ]);

        return redirect('user/riwayat-gaji-berkala')->with('success', 'Data Berhasil Di Tambahkan!');

    }
    public function edit($id)
    {
        $data =  DB::table('t_riwayat_gaji_berkala')->where('id',$id)->first();
        $id_golongan = DB::table('t_master_golongan')->get();
        return view('pages.user.riwayat-gaji-berkala.edit',compact('data','id_golongan'));
    }
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'terhitung_tanggal_mulai_kepanggkatan' => "required" ,
            'masa_kerja_gol_tahun_kepanggkatan' => "required" ,
            'masa_kerja_gol_bulan_kepanggkatan' => "required" ,
            'gaji_pokok_baru' => "required" ,
            'gaji_pokok_lama' => "required" ,
            'terhitung_tanggal_mulai_penggajian' => "required" ,
            'no_sk' => "required" ,
            'tanggal_sk' => "required" ,
            'masa_kerja_gol_tahun_penggajian' => "required" ,
            'masa_kerja_gol_bulan_penggajian' => "required" ,
            'keterangan_jabatan' => "required" ,
            'pejabat_dan_jabatan_penandatangan_kgb' => "required" ,
            'keterangan' => "required" ,
        ]);

        $data =  DB::table('t_riwayat_gaji_berkala')->where('id',$id)->update([
            'id_golongan' => $request->id_golongan,
            'terhitung_tanggal_mulai_kepanggkatan' => $request->terhitung_tanggal_mulai_kepanggkatan,
            'masa_kerja_gol_tahun_kepanggkatan' => $request->masa_kerja_gol_tahun_kepanggkatan,
            'masa_kerja_gol_bulan_kepanggkatan' => $request->masa_kerja_gol_bulan_kepanggkatan,
            'gaji_pokok_baru' => $request->gaji_pokok_baru,
            'gaji_pokok_lama' => $request->gaji_pokok_lama,
            'terhitung_tanggal_mulai_penggajian' => $request->terhitung_tanggal_mulai_penggajian,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'masa_kerja_gol_tahun_penggajian' => $request->masa_kerja_gol_tahun_penggajian,
            'masa_kerja_gol_bulan_penggajian' => $request->masa_kerja_gol_bulan_penggajian,
            'keterangan_jabatan' => $request->keterangan_jabatan,
            'pejabat_dan_jabatan_penandatangan_kgb' => $request->pejabat_dan_jabatan_penandatangan_kgb,
            'keterangan' => $request->keterangan,
            'user_id' =>  auth()->user()->id,
        ]);
        
            return redirect('user/riwayat-gaji-berkala')->with('success', 'Data Berhasil Di Ubah!');
    
    }
    public function destroy( $id)
    {
        DB::table('t_riwayat_gaji_berkala')->where('id',$id)->delete();
       return redirect('user/riwayat-gaji-berkala')->with('success', 'Data Berhasil Di Hapus!');

    }
    
}
