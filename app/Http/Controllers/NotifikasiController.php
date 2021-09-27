<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class NotifikasiController extends Controller
{
    public function index()
    { 
         
        $data = DB::table('table_notifikasi')
        ->where('recipient_at',Auth()->user()->id)
        ->get();   

        return view('pages.notifikasi.index', compact('data'));
    }
    public function show($id)
    { 
         
        $data = DB::table('table_notifikasi')
        ->where('id',$id)
        ->first();   

        if($data->read_at == 0){
            DB::table('table_notifikasi')->where('id',$id)->update([
                'read_at' =>1, 
            ]); 
        } 
        return view('pages.notifikasi.show', compact('data'));
    }
}
