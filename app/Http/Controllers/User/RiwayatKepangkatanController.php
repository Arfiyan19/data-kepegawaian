<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RiwayatKepangkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('table_kepangkatan')
        ->join('t_master_jenis_sk', 'table_kepangkatan.jenis_sk', '=', 't_master_jenis_sk.id') 
        ->join('t_aster_pangkat', 'table_kepangkatan.pangkat', '=', 't_aster_pangkat.id') 

        ->select(
            'table_kepangkatan.*',
            't_master_jenis_sk.jenis',
            't_aster_pangkat.nama_pangkat',

        )
        ->get();   
        return view('pages.user.riwayat-kepangkatan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_sk =  DB::table('t_master_jenis_sk')->get();
        $pangkat =  DB::table('t_aster_pangkat')->get();
        return view('pages.user.riwayat-kepangkatan.create',compact('pangkat','jenis_sk'));
    }
    
    public function edit($id)
    {
        $data =  DB::table('table_kepangkatan')->where('id',$id)->first();
        $jenis_sk =  DB::table('t_master_jenis_sk')->get();
        $pangkat =  DB::table('t_aster_pangkat')->get();
// dd($data);
        return view('pages.user.riwayat-kepangkatan.edit',compact('data','pangkat','jenis_sk'));

    }
    public function store(Request $request)
    {  
         $validatedData = $request->validate([
            "jenis_sk" => "required",
            "gelar_belakang" => "required",
            "pangkat" => "required",
            "no_sk" =>"required",
            "tgl_sk" => "required",
            "tmt" => "required",
            "no_persetujuan" => "required",
            "tgl_persetujuan" => "required",
            "masa_kerja_golongan_tahun" => "required",
            "masa_kerja_golongan_bulan" => "required",
            "gaji_pokok" => "required",
            "nomor_sttpl" =>"required",
            "tgl_sttpl" => "required",
            "nomor_kesehatan" => "required",
            "tgl_kesehatan" => "required"
        ]);

        
        if($request->file('dokumen')){

            $dokumen = $request->file('dokumen');
            $name_dokumen  = time()."_".$dokumen->getClientOriginalName();
            $location = public_path('/images/riwayat-kepangkatan');
            $dokumen->move($location,$name_dokumen);
            }else{
                $name_dokumen = "noimage.jpg";
            }

        $data =  DB::table('table_kepangkatan')->insertGetId([
            "jenis_sk" => $request->jenis_sk,
            "gelar_depan" => $request->gelar_depan,
            "gelar_belakang" => $request->gelar_belakang,
            "pangkat" => $request->pangkat,
            "no_sk" => $request->no_sk,
            "tgl_sk" => $request->tgl_sk,
            "tmt" => $request->tmt,
            "no_persetujuan" => $request->no_persetujuan,
            "tgl_persetujuan" => $request->tgl_persetujuan,
            "masa_kerja_golongan_tahun" => $request->masa_kerja_golongan_tahun,
            "masa_kerja_golongan_bulan" => $request->masa_kerja_golongan_bulan,
            "gaji_pokok" => $request->gaji_pokok,
            "nomor_sttpl" =>  $request->nomor_sttpl,
            "tgl_sttpl" => $request->tgl_sttpl,
            "nomor_kesehatan" => $request->nomor_kesehatan,
            "tgl_kesehatan" => $request->tgl_kesehatan,
            "dokumen" => $name_dokumen,
            'user_id' =>  auth()->user()->id
        ]);

        return redirect('user/riwayat-kepangkatan')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function destroy( $id)
    {
        DB::table('table_kepangkatan')->where('id',$id)->delete();
       return redirect('user/riwayat-kepangkatan')->with('success', 'Data Berhasil Di Hapus!');

    }

    public function update(Request $request,$id)
    {
         $validatedData = $request->validate([
            "jenis_sk" => "required",
            "gelar_belakang" => "required",
            "pangkat" => "required",
            "no_sk" =>"required",
            "tgl_sk" => "required",
            "tmt" => "required",
            "no_persetujuan" => "required",
            "tgl_persetujuan" => "required",
            "masa_kerja_golongan_tahun" => "required",
            "masa_kerja_golongan_bulan" => "required",
            "gaji_pokok" => "required",
            "nomor_sttpl" =>"required",
            "tgl_sttpl" => "required",
            "nomor_kesehatan" => "required",
            "tgl_kesehatan" => "required"
        ]);

        
        if($request->file('dokumen')){

            $dokumen = $request->file('dokumen');
            $name_dokumen  = time()."_".$dokumen->getClientOriginalName();
            $location = public_path('/images/riwayat-kepangkatan');
            $dokumen->move($location,$name_dokumen);
            DB::table('table_kepangkatan')->where('id',$id)->update([
                "jenis_sk" => $request->jenis_sk,
                "gelar_depan" => $request->gelar_depan,
                "gelar_belakang" => $request->gelar_belakang,
                "pangkat" => $request->pangkat,
                "no_sk" => $request->no_sk,
                "tgl_sk" => $request->tgl_sk,
                "tmt" => $request->tmt,
                "no_persetujuan" => $request->no_persetujuan,
                "tgl_persetujuan" => $request->tgl_persetujuan,
                "masa_kerja_golongan_tahun" => $request->masa_kerja_golongan_tahun,
                "masa_kerja_golongan_bulan" => $request->masa_kerja_golongan_bulan,
                "gaji_pokok" => $request->gaji_pokok,
                "nomor_sttpl" =>  $request->nomor_sttpl,
                "tgl_sttpl" => $request->tgl_sttpl,
                "nomor_kesehatan" => $request->nomor_kesehatan,
                "dokumen" => $name_dokumen,
                "tgl_kesehatan" => $request->tgl_kesehatan

            ]);  
            }else{
                DB::table('table_kepangkatan')->where('id',$id)->update([
                    "jenis_sk" => $request->jenis_sk,
                    "gelar_depan" => $request->gelar_depan,
                    "gelar_belakang" => $request->gelar_belakang,
                    "pangkat" => $request->pangkat,
                    "no_sk" => $request->no_sk,
                    "tgl_sk" => $request->tgl_sk,
                    "tmt" => $request->tmt,
                    "no_persetujuan" => $request->no_persetujuan,
                    "tgl_persetujuan" => $request->tgl_persetujuan,
                    "masa_kerja_golongan_tahun" => $request->masa_kerja_golongan_tahun,
                    "masa_kerja_golongan_bulan" => $request->masa_kerja_golongan_bulan,
                    "gaji_pokok" => $request->gaji_pokok,
                    "nomor_sttpl" =>  $request->nomor_sttpl,
                    "tgl_sttpl" => $request->tgl_sttpl,
                    "nomor_kesehatan" => $request->nomor_kesehatan,
                    "tgl_kesehatan" => $request->tgl_kesehatan
                ]);  
            }
    
            return redirect('user/riwayat-kepangkatan')->with('success', 'Data Berhasil Di Ubah!');
    
    }

}
