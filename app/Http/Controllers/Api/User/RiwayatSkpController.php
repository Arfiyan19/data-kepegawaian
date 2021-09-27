<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatSkpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('table_riwayat_skp')->get();
        return response()->json([
            'status' => ($data) ? true : false,
            'data' => $data
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
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => ['required'],
            'nilai' => ['required'],
            'opl' => ['required'],
            'int' => ['required'],
            'kom' => ['required'],
            'dis' => ['required'],
            'ksm' => ['required'],
            'kpm' => ['required']
        ]);

        $store = DB::table('table_riwayat_skp')->insert($request->only(['tahun','nilai','opl','int','kom','dis','ksm','kpm']));
        return response()->json([
            'status' => ($store) ? true : false,
            'message' => ($store) ? 'created' : 'failed',
        ], ($store) ? 201 : 412);
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
        $request->validate([
            'tahun' => ['required'],
            'nilai' => ['required'],
            'opl' => ['required'],
            'int' => ['required'],
            'kom' => ['required'],
            'dis' => ['required'],
            'ksm' => ['required'],
            'kpm' => ['required']
        ]);

        $update = DB::table('table_riwayat_skp')->where('id', $id)->update($request->only(['tahun','nilai','opl','int','kom','dis','ksm','kpm']));
        return response()->json([
            'status' => ($update) ? true : false,
            'messade' => ($update) ? 'updated' : 'failed'
        ], ($update) ? 200 : 412);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DB::table('table_riwayat_skp')->where('id', $id)->delete();
        return response()->json([
            'status' => ($deleted) ? true : false,
            'message' => ($deleted) ? 'deleted' : 'failed'
        ], ($deleted) ? 200 : 301);
    }
}
