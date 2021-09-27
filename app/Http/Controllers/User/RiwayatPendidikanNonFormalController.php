<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class RiwayatPendidikanNonFormalController extends Controller
{
    public function index()
    {   
        $data = DB::table('t_riwayat_pendidikan_non_formal')
        ->get();
        return view('pages.user.riwayat-pendidikan-non-formal.index',compact('data'));

    }
    public function create()
    {   
        return view('pages.user.riwayat-pendidikan-non-formal.create');
    }
    public function store(Request $request)
    {
        
     $validatedData = $request->validate([
            'nama_pendidikan_non_formal' => "required" ,
            'penyelenggara_sponsor_lembaga' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'tempat' => "required" ,
            'peranan' => "required" ,
            'catatan' => "required" ,
        ]);


        $data =  DB::table('t_riwayat_pendidikan_non_formal')->insertGetId([
            'nama_pendidikan_non_formal' => $request->nama_pendidikan_non_formal,
            'penyelenggara_sponsor_lembaga' => $request->penyelenggara_sponsor_lembaga,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'tempat' => $request->tempat,
            'peranan' => $request->peranan,
            'catatan' => $request->catatan,
            'user_id' =>  auth()->user()->id,
        ]);

        return redirect('user/riwayat-pendidikan-non-formal')->with('success', 'Data Berhasil Di Tambahkan!');

    }
    public function edit($id)
    {
        $data =  DB::table('t_riwayat_pendidikan_non_formal')->where('id',$id)->first();

        return view('pages.user.riwayat-pendidikan-non-formal.edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
     $validatedData = $request->validate([
            'nama_pendidikan_non_formal' => "required" ,
            'penyelenggara_sponsor_lembaga' => "required" ,
            'tanggal_mulai' => "required" ,
            'tanggal_berakhir' => "required" ,
            'tempat' => "required" ,
            'peranan' => "required" ,
            'catatan' => "required" ,
        ]);

        $data =  DB::table('t_riwayat_pendidikan_non_formal')->where('id',$id)->update([
            'nama_pendidikan_non_formal' => $request->nama_pendidikan_non_formal,
            'penyelenggara_sponsor_lembaga' => $request->penyelenggara_sponsor_lembaga,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'tempat' => $request->tempat,
            'peranan' => $request->peranan,
            'catatan' => $request->catatan,
            'user_id' =>  auth()->user()->id,
        ]);
        
            return redirect('user/riwayat-pendidikan-non-formal')->with('success', 'Data Berhasil Di Ubah!');
    
    }
    public function destroy( $id)
    {
        DB::table('t_riwayat_pendidikan_non_formal')->where('id',$id)->delete();
       return redirect('user/riwayat-pendidikan-non-formal')->with('success', 'Data Berhasil Di Hapus!');

    }
}
