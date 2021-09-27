<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $user = User::select(
            DB::raw('count(id) as `data`'),
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  
            DB::raw('YEAR(created_at) year, MONTH(created_at) month')
             ,'role')
            ->groupby('year','month','role' )
            ->get();
            $grafikAdmin = [];
            $grafikUser = [];
            $jumlahUser = User::where('role','user')->count();
            $jumlahAdmin = User::where('role','admin')->count();
        $jumlahPangkat = [];
        $jumlahPosisi = [];
        $namaPosisi = [];
        $namaPangkat = [];

        $presentasiPosisi = [];
        $presentasiPangkat = [];
              
        foreach($user as $row){
            if($row->role == 'admin'){
                $grafikAdmin[] = $row->data;
            }else{
                $grafikUser[] = $row->data;
            }
        } 
        
        $posisi = DB::table('table_riwayat_jabatan')
        ->join('detail_riwayat_jabatan', 'detail_riwayat_jabatan.no_sk', '=', 'table_riwayat_jabatan.no_sk')
        ->join('collection_riwayat_jabatan', 'collection_riwayat_jabatan.no_sk', '=', 'table_riwayat_jabatan.no_sk')
        ->join('master_jenis_jabatan', 'master_jenis_jabatan.id', '=', 'collection_riwayat_jabatan.id_jabatan')
        ->select([
            DB::raw('count(table_riwayat_jabatan.id) as jumlah'),
           'master_jenis_jabatan.nama'
        ])
        ->groupBy('master_jenis_jabatan.nama') 
        ->get();
        // $posisi->sum('jumlah')
        foreach($posisi as $row){
            $jumlahPosisi[] = $row->jumlah;
            $namaPosisi[] = $row->nama;
            $presentasiPosisi = ($row->jumlah/$posisi->sum('jumlah'))*100; 
        }
        $pangkat = DB::table('table_riwayat_jabatan')
        ->join('detail_riwayat_jabatan', 'detail_riwayat_jabatan.no_sk', '=', 'table_riwayat_jabatan.no_sk')
        ->join('master_pangkat', 'master_pangkat.id', '=', 'detail_riwayat_jabatan.id_master_pangkat')
        ->select([
            DB::raw('count(table_riwayat_jabatan.id) as jumlah'),
           'master_pangkat.nama'
        ])
        ->groupBy('master_pangkat.nama') 
        ->get();
        // dd($namaPosisi);
        foreach($pangkat as $row){
            $jumlahPangkat[] = $row->jumlah;
            $namaPangkat[] = $row->nama;
            $presentasiPangkat = ($row->jumlah/$pangkat->sum('jumlah'))*100; 
        }
// dd($grafikUser);
        return view('pages.admin.dashboard.index', 
        compact('grafikAdmin',
            'grafikUser',
            'jumlahUser',
            'jumlahAdmin',
            'jumlahPangkat',
            'jumlahPosisi',
            'namaPosisi',
            'namaPangkat',
            'pangkat',
            'posisi',
            'presentasiPosisi',
            'presentasiPangkat'
    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
