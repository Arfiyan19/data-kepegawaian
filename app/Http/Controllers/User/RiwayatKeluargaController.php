<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('table_riwayat_keluarga')
        ->join('t_master_hub_kepala_keluarga', 'table_riwayat_keluarga.id_hub_kepala_keluarga', '=', 't_master_hub_kepala_keluarga.id_hub_kepala_keluarga')
        ->join('t_master_jenjang_pendidikan', 'table_riwayat_keluarga.id_jenjang_pendidikan', '=', 't_master_jenjang_pendidikan.id_jenjang_pendidikan')
        ->select(
            'table_riwayat_keluarga.*',
            't_master_hub_kepala_keluarga.*',
            't_master_jenjang_pendidikan.*',
            'table_riwayat_keluarga.id as id_riwayat',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as hubungan keluarga',
            't_master_jenjang_pendidikan.id_jenjang_pendidikan as pendidikan akhir',

        ) 
        ->orderBy('id', 'asc')->get();
        return view('pages.user.riwayat-keluarga.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
        public function create()
        {   
            $id_hub_kepala_keluarga = DB::table('t_master_hub_kepala_keluarga')->get();
            $id_jenjang_pendidikan = DB::table('t_master_jenjang_pendidikan')->get();
            return view('pages.user.riwayat-keluarga.create',compact('id_hub_kepala_keluarga','id_jenjang_pendidikan'));
    }
    public function edit($id)
    {
        $data =  DB::table('table_riwayat_keluarga')->where('id',$id)->first();
        $id_hub_kepala_keluarga = DB::table('t_master_hub_kepala_keluarga')->get();
        $id_jenjang_pendidikan = DB::table('t_master_jenjang_pendidikan')->get();

        return view('pages.user.riwayat-keluarga.edit',compact('data','id_hub_kepala_keluarga','id_jenjang_pendidikan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $validatedData = $request->validate([
            'nama_lengkap' => "required" ,
            'tgl_lahir' => "required" ,
            'kota_lahir' => "required" ,
            'id_jenjang_pendidikan' => "required" ,
            'jenis_kelamin' => "required" ,
            'dokumen_riwayat_keluarga' => "required|mimes:pdf|max:10000" ,

        ]);
            if($request->file('dokumen_riwayat_keluarga')){

                $dokumen_riwayat_keluarga = $request->file('dokumen_riwayat_keluarga');
                $name_dokumen_riwayat_keluarga  = time()."_".$dokumen_riwayat_keluarga->getClientOriginalName();
                $location = public_path('/images/riwayat_keluarga');
                $dokumen_riwayat_keluarga->move($location,$name_dokumen_riwayat_keluarga);
                }else{
                    $name_dokumen_riwayat_keluarga = "noimage.jpg";
                }

        $data =  DB::table('table_riwayat_keluarga')->insertGetId([
            'id_hub_kepala_keluarga' => $request->id_hub_kepala_keluarga,
            'nama_lengkap' => $request->nama_lengkap,
            'tgl_lahir' => $request->tgl_lahir,
            'kota_lahir' => $request->kota_lahir,
            'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'user_id' =>  auth()->user()->id,
            'dokumen_riwayat_keluarga' => $name_dokumen_riwayat_keluarga,

        ]);
        return redirect('user/riwayat-keluarga')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function update(Request $request,$id)
    {
         $validatedData = $request->validate([
            'nama_lengkap' => "required" ,
            'tgl_lahir' => "required" ,
            'kota_lahir' => "required" ,
            'id_jenjang_pendidikan' => "required" ,
            'jenis_kelamin' => "required" ,
            'dokumen_riwayat_keluarga' => "required|mimes:pdf|max:10000" ,
        ]);

             if($request->file('dokumen_riwayat_keluarga')){

            $dokumen_riwayat_keluarga = $request->file('dokumen_riwayat_keluarga');
            $name_dokumen_riwayat_keluarga  = time()."_".$dokumen_riwayat_keluarga->getClientOriginalName();
            $location = public_path('/images/riwayat-keluarga');
            $dokumen_riwayat_keluarga->move($location,$name_dokumen_riwayat_keluarga);
            $data =  DB::table('table_riwayat_keluarga')->where('id',$id)->update([
                'id_hub_kepala_keluarga' => $request->id_hub_kepala_keluarga,
                'nama_lengkap' => $request->nama_lengkap,
                'tgl_lahir' => $request->tgl_lahir,
                'kota_lahir' => $request->kota_lahir,
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'dokumen_riwayat_keluarga' => $name_dokumen_riwayat_keluarga,
            ]);
            }else{
                $data =  DB::table('table_riwayat_keluarga')->where('id',$id)->update([
                    'id_hub_kepala_keluarga' => $request->id_hub_kepala_keluarga,
                    'nama_lengkap' => $request->nama_lengkap,
                    'tgl_lahir' => $request->tgl_lahir,
                    'kota_lahir' => $request->kota_lahir,
                    'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }
    
    
            return redirect('user/riwayat-keluarga')->with('success', 'Data Berhasil Di Ubah!');
    
    }

    public function destroy( $id)
    {
        DB::table('table_riwayat_keluarga')->where('id',$id)->delete();
       return redirect('user/riwayat-keluarga')->with('success', 'Data Berhasil Di Hapus!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
