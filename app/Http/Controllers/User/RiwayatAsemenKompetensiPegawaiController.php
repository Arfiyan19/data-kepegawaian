<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RiwayatAsemenKompetensiPegawaiController extends Controller
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
        return view('pages.user.riwayat-asemen-kompetensi-pegawain.index',compact('data'));
    }

    public function create()
    {
        $jabatan = DB::table('t_master_jabatan')->get();
        $unit_kerja = DB::table('t_master_unit_kerja')->get();

        return view('pages.user.riwayat-asemen-kompetensi-pegawain.create',compact('jabatan','unit_kerja'));

    }

    public function edit($id)
    {
        $data =  DB::table('table_riwayat_asesmen')->where('id',$id)->first();
        $jabatan = DB::table('t_master_jabatan')->get();
        $unit_kerja = DB::table('t_master_unit_kerja')->get();

        return view('pages.user.riwayat-asemen-kompetensi-pegawain.edit',compact('data','jabatan','unit_kerja'));

    }
    public function store(Request $request)
    {
        
         $validatedData = $request->validate([
            'dokumen_asesmen' => "required|mimes:pdf|max:10000" ,
            'tanggal_asesmen' => "required" ,
            'nilai_kompetensi' => "required" ,
            'nilai_potensi' => "required" ,
            'jabatan_id' => "required" ,
        ]);

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

        return redirect('user/riwayat-asesmen-kompetensi')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function destroy( $id)
    {
        DB::table('table_riwayat_asesmen')->where('id',$id)->delete();
       return redirect('user/riwayat-asesmen-kompetensi')->with('success', 'Data Berhasil Di Hapus!');

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
    
    
            return redirect('user/riwayat-asesmen-kompetensi')->with('success', 'Data Berhasil Di Ubah!');
    
    }

}
