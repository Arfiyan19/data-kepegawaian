<?php

namespace App\Http\Controllers\User;

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
        return view('pages.user.riwayat-skp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.riwayat-skp.create');
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

        DB::table('table_riwayat_skp')->insert($request->only(['tahun','nilai','opl','int','kom','dis','ksm','kpm']));
        return redirect()->route('riwayat-skp.index');
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
        $data = DB::table('table_riwayat_skp')->where('id', $id)->first();
        return view('pages.user.riwayat-skp.edit', compact('data'));
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
        DB::table('table_riwayat_skp')->where('id', $id)->update($request->only(['tahun','nilai','opl','int','kom','dis','ksm','kpm']));
        return redirect()->route('riwayat-skp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('table_riwayat_skp')->where('id', $id)->delete();
        return back();
    }
}
