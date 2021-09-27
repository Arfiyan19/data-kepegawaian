<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatJabatanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('table_riwayat_jabatan')
        ->leftJoin('master_unit_organisasi', 'master_unit_organisasi.id', '=', 'table_riwayat_jabatan.id_unit_organisasi')
        ->leftJoin('master_kantor', 'master_kantor.id', '=', 'table_riwayat_jabatan.id_kantor')
        ->select([
            'table_riwayat_jabatan.*',
            'master_unit_organisasi.nama as nama_unit_organisasi',
            'master_kantor.nama as nama_kantor'
        ])
        ->get();

        $colect_data = [];

        for ($i=0; $i<sizeof($data); $i++) {
            $dump = DB::table('detail_riwayat_jabatan')->where('no_sk', $data[$i]->no_sk)
                        ->leftJoin('master_diterbitkan'                 , 'master_diterbitkan.id'                   , '=', 'detail_riwayat_jabatan.id_master_diterbitkan')
                        ->leftJoin('master_pangkat'                     , 'master_pangkat.id'                       , '=', 'detail_riwayat_jabatan.id_master_pangkat')
                        ->leftJoin('master_induk_unit_kerja'            , 'master_induk_unit_kerja.id'              , '=', 'detail_riwayat_jabatan.id_master_induk_unit_kerja')
                        ->leftJoin('master_unit_organisasi'             , 'master_unit_organisasi.id'               , '=', 'detail_riwayat_jabatan.id_master_unit_organisasi')
                        ->leftJoin('master_jenis_jabatan'               , 'master_jenis_jabatan.id'                 , '=', 'detail_riwayat_jabatan.id_master_jenis_jabatan')
                        ->leftJoin('master_group_fungsional'            , 'master_group_fungsional.id'              , '=', 'detail_riwayat_jabatan.id_master_group_fungsional')
                        ->leftJoin('master_jabatan_fungsional_tertentu' , 'master_jabatan_fungsional_tertentu.id'   , '=', 'detail_riwayat_jabatan.id_master_jabatan_fungsional_tertentu')
                        ->leftJoin('master_jabatan_fungsional_umum'     , 'master_jabatan_fungsional_umum.id'       , '=', 'detail_riwayat_jabatan.id_master_jabatan_fungsional_umum')
                        ->leftJoin('master_status_jabatan'              , 'master_status_jabatan.id'                , '=', 'detail_riwayat_jabatan.id_master_status_jabatan')
                        ->leftJoin('master_alasan_jabatan_sementara'    , 'master_alasan_jabatan_sementara.id'      , '=', 'detail_riwayat_jabatan.id_master_alasan_jabatan_sementara')
                        ->select([
                            'detail_riwayat_jabatan.*',
                            'master_diterbitkan.nama as diterbitkan',
                            'master_pangkat.nama as pangkat',
                            'master_induk_unit_kerja.nama as induk_unit_kerja',
                            'master_unit_organisasi.nama as unit_organisasi',
                            'master_jenis_jabatan.nama as jenis_jabatan',
                            'master_group_fungsional.nama as group_fungsional',
                            'master_jabatan_fungsional_tertentu.nama as jabatan_fungsional_tertentu',
                            'master_jabatan_fungsional_umum.nama as jabatan_fungsional_umum',
                            'master_status_jabatan.nama as status_jabatan',
                            'master_alasan_jabatan_sementara.nama as alasan_jabatan_sementara',
                        ])
                        ->first();
            $colect_data[$i] = array_merge((array) $data[$i], (array) $dump) ;
        }

        return response()->json([
            'status' => ($data) ? true : false,
            'data' => $colect_data
        ], ($data) ? 200 : 301);
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
    public function store(RiwayatJabatanRequest $request)
    {
        if($request->file('dokumen')){
            $dokumen = $request->file('dokumen');
            $name_dokumen  = time()."_".$dokumen->getClientOriginalName();
            $location = public_path('/documents/riwayat-jabatan');
            $dokumen->move($location,$name_dokumen);
        }else{
            $name_dokumen = null;
        }

        $table = [
            'id_unit_organisasi' => $request->unit_organisasi,
            'id_kantor' => $request->induk_unit_kerja,
            'no_sk' => $request->no_sk,
            'tgl_sk' => $request->tgl_sk,
            'tgl_tmt' => $request->tgl_tmt,
            'user_id' => auth()->id(),
            'validated_at' => 0,
            'read_at' => 0,
            'dokumen' => $name_dokumen
        ];

        $detail = [
            'no_sk' => $request->no_sk,
            'id_master_diterbitkan' => $request->diterbitkan,
            'id_master_pangkat' => $request->pangkat,
            'id_master_induk_unit_kerja' => $request->induk_unit_kerja,
            'id_master_unit_organisasi' => $request->unit_organisasi,
            'id_master_jenis_jabatan' => $request->jenis_jabatan,
            'keterangan_jabatan' => $request->keterangan_jabatan,
            'id_master_group_fungsional' => $request->group_fungsional,
            'id_master_jabatan_fungsional_tertentu' => $request->jabatan_fungsional_tertentu,
            'id_master_jabatan_fungsional_umum' => $request->jabatan_fungsional_umum,
            'id_master_status_jabatan' => $request->status_jabatan,
            'id_master_alasan_jabatan_sementara' => $request->alasan_jabatan_sementara,
            'catatan' => $request->catatan,
        ];
        
        $collection = [];

        foreach ($request->jabatan as $jabatan) {
            $collection[] = [
                'no_sk' => $request->no_sk,
                'id_jabatan' => $jabatan
            ];
        }

        $tbl = DB::table('table_riwayat_jabatan')->insert($table);
        DB::table('detail_riwayat_jabatan')->insert($detail);
        DB::table('collection_riwayat_jabatan')->insert($collection);

        return response()->json([
            'status' => ($tbl) ? true : false,
            'message' => ($tbl) ? 'success' : 'something wrong'
        ], ($tbl) ? 201 : 412);
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
    public function update(RiwayatJabatanRequest $request, $id)
    {
        $doc = DB::table('table_riwayat_jabatan')->where('id', $id)->first()->dokumen;

        if($request->file('dokumen')){
            unlink(public_path('/documents/riwayat-jabatan/' . $doc));
            $dokumen = $request->file('dokumen');
            $name_dokumen  = time()."_".$dokumen->getClientOriginalName();
            $location = public_path('/documents/riwayat-jabatan');
            $dokumen->move($location,$name_dokumen);
        }else{
            $name_dokumen = $doc;
        }

        $table = [
            'id_unit_organisasi' => $request->unit_organisasi,
            'id_kantor' => $request->induk_unit_kerja,
            'no_sk' => $request->no_sk,
            'tgl_sk' => $request->tgl_sk,
            'tgl_tmt' => $request->tgl_tmt,
            'user_id' => auth()->id(),
            'validated_at' => 0,
            'read_at' => 0,
            'dokumen' => $name_dokumen
        ];

        $detail = [
            'no_sk' => $request->no_sk,
            'id_master_diterbitkan' => $request->diterbitkan,
            'id_master_pangkat' => $request->pangkat,
            'id_master_induk_unit_kerja' => $request->induk_unit_kerja,
            'id_master_unit_organisasi' => $request->unit_organisasi,
            'id_master_jenis_jabatan' => $request->jenis_jabatan,
            'keterangan_jabatan' => $request->keterangan_jabatan,
            'id_master_group_fungsional' => $request->group_fungsional,
            'id_master_jabatan_fungsional_tertentu' => $request->jabatan_fungsional_tertentu,
            'id_master_jabatan_fungsional_umum' => $request->jabatan_fungsional_umum,
            'id_master_status_jabatan' => $request->status_jabatan,
            'id_master_alasan_jabatan_sementara' => $request->alasan_jabatan_sementara,
            'catatan' => $request->catatan,
        ];

        $collection = [];

        foreach ($request->jabatan as $jabatan) {
            $collection[] = [
                'no_sk' => $request->no_sk,
                'id_jabatan' => $jabatan
            ];
        }

        $number_sk = DB::table('table_riwayat_jabatan')->where('id', $id)->first()->no_sk;
        $trial = DB::table('collection_riwayat_jabatan')->where('no_sk', $number_sk)->delete();

        DB::table('table_riwayat_jabatan')->where('id', $id)->update($table);
        DB::table('detail_riwayat_jabatan')->where('no_sk', $number_sk)->update($detail);
        DB::table('collection_riwayat_jabatan')->insert($collection);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('table_riwayat_jabatan')->where('id', $id)->first();
        DB::table('table_riwayat_jabatan')->where('no_sk', $data->no_sk)->delete();
        DB::table('detail_riwayat_jabatan')->where('no_sk', $data->no_sk)->delete();
        $deleted = DB::table('collection_riwayat_jabatan')->where('no_sk', $data->no_sk)->delete();

        return response()->json([
            'status' => ($deleted) ? true : false,
            'message' => ($deleted) ? 'success' : 'failed'
        ], 200);
    }
}
