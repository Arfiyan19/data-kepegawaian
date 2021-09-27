<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
                ->join('t_master_agama', 'table_detail_pegawai.id_agama', '=', 't_master_agama.id_agama')
                ->join('t_master_jenis_disabilitas', 'table_detail_pegawai.id_disabilitas', '=', 't_master_jenis_disabilitas.id_disabilitas')
                ->join('t_master_jenis_kelamin', 'table_detail_pegawai.id_jenis_kelamin', '=', 't_master_jenis_kelamin.id_jenis_kelamin')



                ->select(
                    'table_pegawai.*',
                    't_master_agama.*',
                    't_master_jenis_disabilitas.*',
                    't_master_jenis_kelamin.*',

                    'table_detail_pegawai.*',
                    'table_email.*',
                    'table_phone_number.*',
                    'table_pegawai.id as id_pgw',
                    'table_email.id as id_email',
                    'table_phone_number.id as id_phone',
                    'table_detail_pegawai.id as id_detail'
                )
               ->get(); 
            //    dd($data);
        return view('pages.admin.informasi-pegawai.index',compact('agama','data','jenis_disabilitas'));
      
    }
}
