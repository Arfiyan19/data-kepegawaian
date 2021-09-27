<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatJabatanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatJabatanController extends Controller
{
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

        return view('pages.user.riwayat-jabatan.index', [
            'data' => $data
        ]);
    }

    public function create()
    {

        return view('pages.user.riwayat-jabatan.create', [
            'diterbitkan'                   => DB::table('master_diterbitkan')->get(),
            'pangkat'                       => DB::table('master_pangkat')->get(),
            'induk_unit_kerja'              => DB::table('master_induk_unit_kerja')->get(),
            'unit_organisasi'               => DB::table('master_unit_organisasi')->get(),
            'jenis_jabatan'                 => DB::table('master_jenis_jabatan')->get(),
            'jabatan'                       => DB::table('master_jabatan')->get(),
            'group_fungsional'              => DB::table('master_group_fungsional')->get(),
            'jabatan_fungsional_tertentu'   => DB::table('master_jabatan_fungsional_tertentu')->get(),
            'jabatan_fungsional_umum'       => DB::table('master_jabatan_fungsional_umum')->get(),
            'status_jabatan'                => DB::table('master_status_jabatan')->get(),
            'alasan_jabatan_sementara'      => DB::table('master_alasan_jabatan_sementara')->get(),
        ]);
    }

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

        DB::table('table_riwayat_jabatan')->insert($table);
        DB::table('detail_riwayat_jabatan')->insert($detail);
        DB::table('collection_riwayat_jabatan')->insert($collection);

        return redirect()->route('riwayat-jabatan.index');
    }

    public function edit($id)
    {
        $table = DB::table('table_riwayat_jabatan')->where('id', $id)->first();
        $detail = DB::table('detail_riwayat_jabatan')->where('no_sk', $table->no_sk)->first();
        $collection = DB::table('collection_riwayat_jabatan')->where('no_sk', $table->no_sk)->get();

        $collection_id = [];

        foreach ($collection as $collect) {
            $collection_id[] = $collect->id_jabatan;
        }

        return view('pages.user.riwayat-jabatan.edit', [
            'table'                         => $table,
            'detail'                        => $detail,
            'collection'                    => $collection_id,
            'diterbitkan'                   => DB::table('master_diterbitkan')->get(),
            'pangkat'                       => DB::table('master_pangkat')->get(),
            'induk_unit_kerja'              => DB::table('master_induk_unit_kerja')->get(),
            'unit_organisasi'               => DB::table('master_unit_organisasi')->get(),
            'jenis_jabatan'                 => DB::table('master_jenis_jabatan')->get(),
            'jabatan'                       => DB::table('master_jabatan')->get(),
            'group_fungsional'              => DB::table('master_group_fungsional')->get(),
            'jabatan_fungsional_tertentu'   => DB::table('master_jabatan_fungsional_tertentu')->get(),
            'jabatan_fungsional_umum'       => DB::table('master_jabatan_fungsional_umum')->get(),
            'status_jabatan'                => DB::table('master_status_jabatan')->get(),
            'alasan_jabatan_sementara'      => DB::table('master_alasan_jabatan_sementara')->get(),
        ]);
    }

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

        return redirect()->route('riwayat-jabatan.index');
    }

    public function destroy($id)
    {
        $data = DB::table('table_riwayat_jabatan')->where('id', $id)->first();
        DB::table('table_riwayat_jabatan')->where('no_sk', $data->no_sk)->delete();
        DB::table('detail_riwayat_jabatan')->where('no_sk', $data->no_sk)->delete();
        DB::table('collection_riwayat_jabatan')->where('no_sk', $data->no_sk)->delete();
        
        return redirect()->route('riwayat-jabatan.index');
    }
}
