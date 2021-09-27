<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// use App\Http\Requests\User\InformasiPegawai;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InformasiPegawaiController extends Controller
{
    public function index()
    {   
        $agama = DB::table('t_master_agama')->get();
        $jenis_disabilitas = DB::table('t_master_jenis_disabilitas')->get();

        $data = DB::table('table_pegawai')
                ->join('table_detail_pegawai', 'table_pegawai.id', '=', 'table_detail_pegawai.id_pegawai')
                ->join('table_email', 'table_detail_pegawai.id_email', '=', 'table_email.id')
                ->join('table_phone_number', 'table_detail_pegawai.id_phone_number', '=', 'table_phone_number.id')
                ->select(
                    'table_pegawai.*',
                    'table_detail_pegawai.*',
                    'table_email.*',
                    'table_phone_number.*',
                    'table_pegawai.id as id_pgw',
                    'table_email.id as id_email',
                    'table_phone_number.id as id_phone',
                    'table_detail_pegawai.id as id_detail'
                )
                ->where('table_pegawai.user_id',auth()->user()->id)->first();
        // dd($data);
        if($data){
            return view('pages.user.informasi-pegawai.edit',compact('agama','data','jenis_disabilitas'));
        }else{
            return view('pages.user.informasi-pegawai.index',compact('agama','jenis_disabilitas'));
        }
    }

    public function store(Request $request)
    { 
         
         $validatedData = $request->validate([
            'nip' =>  'unique:table_pegawai|required',
            'nama_pegawai' =>  'required',
            'tanggal_lahir' =>  'required',
            'email_kemensos' => 'required|unique:table_email,email_1|max:255'.$request->id_email,
            'email_lain' => 'required|unique:table_email,email_2|max:255'.$request->id_email,
        ]);
        if($request->file('foto_bpjs')){

            $foto_bpjs = $request->file('foto_bpjs');
            $name_foto_bpjs  = time()."_".$foto_bpjs->getClientOriginalName();
            $location = public_path('/images/informasi_pegawai');
            $foto_bpjs->move($location,$name_foto_bpjs);
        }else{
            $name_foto_bpjs = "noimage.jpg";
        }
        // foro ktp
        if($request->file('foto_ktp')){

            $foto_ktp = $request->file('foto_ktp');
            $name_foto_ktp  = time()."_".$foto_ktp->getClientOriginalName();
            $location = public_path('/images/informasi_pegawai');
            $foto_ktp->move($location,$name_foto_ktp);
        }else{
            $name_foto_ktp = "noimage.jpg";
        }
        // foto dokumen
        if($request->file('dokumen')){

            $dokumen = $request->file('dokumen');
            $name_dokumen  = time()."_".$dokumen->getClientOriginalName();
            $location = public_path('/images/informasi_pegawai');
            $dokumen->move($location,$name_dokumen);
        }else{
            $name_dokumen = "noimage.jpg";
        }

        $pegawai = DB::table('table_pegawai')->insertGetId([
            'nip_lama' => $request->nip_lama,
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang, 
            'no_kartu_pegawai' => $request->no_kartu_pegawai, 
            'tempat_lahir' => $request->tempat_lahir, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'npwp' => $request->npwp, 
            'no_ktp' => $request->no_ktp, 
            'foto_ktp' => $name_foto_ktp,  
            'foto_bpjs' => $name_foto_bpjs,  
            'document' => $name_dokumen,  

            'golongan_darah' => $request->golongan_darah, 
            'user_id' => auth()->user()->id
        ]); 

        $email = DB::table('table_email')->insertGetId([
            'email_1' => $request->email_kemensos,
            'email_2' => $request->email_lain, 
        ]);

        $phone_number = DB::table('table_phone_number')->insertGetId([
            'number_1' => $request->telepon,
            'number_2' => $request->hadnphone_1, 
            'number_3' => $request->hadnphone_2, 
        ]);

        DB::table('table_detail_pegawai')->insert([
            'id_agama' => $request->id_agama,
            'id_disabilitas' => $request->id_disabilitas,
            'id_pegawai' => $pegawai,
            'id_email' => $email,
            'id_phone_number' => $phone_number,
            'id_jenis_kelamin' => $request->jenis_kelamin,
        ]);


        return redirect('user/informasi-pegawai')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    public function update(Request $request)
    {
         $validatedData = $request->validate([ 
            'nama_pegawai' =>  'required',
            'tanggal_lahir' =>  'required',
            'email_1' => 'required|unique:table_email,email_1,'.$request->id_email,
            'email_2' => 'required|unique:table_email,email_2,'.$request->id_email,
        ]);
        $img = DB::table('table_pegawai')->where('id',$request->id_pgw)->first();
        if($request->file('foto_bpjs')){

            $foto_bpjs = $request->file('foto_bpjs');
            $name_foto_bpjs  = time()."_".$foto_bpjs->getClientOriginalName();
            $location = public_path('/images/informasi_pegawai');
            $foto_bpjs->move($location,$name_foto_bpjs);
        }else{
            $name_foto_bpjs = $img->foro_bpjs;
        }
        // foro ktp
        if($request->file('foto_ktp')){

            $foto_ktp = $request->file('foto_ktp');
            $name_foto_ktp  = time()."_".$foto_ktp->getClientOriginalName();
            $location = public_path('/images/informasi_pegawai');
            $foto_ktp->move($location,$name_foto_ktp);
        }else{
            $name_foto_ktp = $img->foto_ktp;

        }
        // foto dokumen
        if($request->file('dokumen')){

            $dokumen = $request->file('dokumen');
            $name_dokumen  = time()."_".$dokumen->getClientOriginalName();
            $location = public_path('/images/informasi_pegawai');
            $dokumen->move($location,$name_dokumen);
        }else{ 
            $name_dokumen = $img->document;

        }

        $pegawai = DB::table('table_pegawai')->where('id',$request->id_pgw)->update([
            'nip_lama' => $request->nip_lama,
            'nip' => $request->nip,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang, 
            'no_kartu_pegawai' => $request->no_kartu_pegawai, 
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'npwp' => $request->npwp,             
            'foto_ktp' => $name_foto_ktp,  
            'foto_bpjs' => $name_foto_bpjs,  
            'document' => $name_dokumen,  

            'no_ktp' => $request->no_ktp, 
            'golongan_darah' => $request->golongan_darah
        ]); 

        $email = DB::table('table_email')->where('id',$request->id_email)->update([
            'email_1' => $request->email_1,
            'email_2' => $request->email_2, 
        ]);

        $phone_number = DB::table('table_phone_number')->where('id',$request->id_phone)->update([
            'number_1' => $request->telepon,
            'number_2' => $request->hadnphone_1, 
            'number_3' => $request->hadnphone_2, 
        ]);

        $pegawai = DB::table('table_detail_pegawai')->where('id',$request->id_detail)->update([
            'id_agama' => $request->id_agama,
            'id_disabilitas' => $request->id_disabilitas,
            'id_email' =>$request->id_email,
            'id_phone_number' => $request->id_phone,
            'id_jenis_kelamin' => $request->jenis_kelamin,
        ]);


        return redirect('user/informasi-pegawai')->with('success', 'Data Berhasil Di Ubah!');
    }

}
