<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->where('id', auth()->id())->first();
        return view('pages.admin.admin-profile.index', compact('user'));
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

        if ($request->email) {
            $request->validate([
                'email' => ['required'],
                'name' => ['required']
            ]);

            $pict = DB::table('users')->where('id', $id)->first()->photo;

            if($request->file('photo')){
                if ($pict != 'noimage.png') { unlink(public_path('/images/profile/' . $pict)); }
                $picture        = $request->file('photo');
                $name_picture   = uniqid(time()) .'.'. $picture->extension();
                $location       = public_path('/images/profile/');
                $picture->move($location, $name_picture);
            }else{
                $name_picture = $pict;
            }

            $update = [
                'email' => $request->email,
                'name' => $request->name,
                'photo' => $name_picture
            ];

            DB::table('users')->where('id', $id)->update($update);
        }
        elseif ($request->password) {
            $valid = $request->validate([
                'password' => ['required'],
                'new-password' => ['required', 'same:confirm-new-password'],
                'confirm-new-password' => ['required'],
            ]);

            if ( ! Hash::check($request->password, DB::table('users')->where('id', $id)->first()->password))
            { return back()->with('message', 'wrong old password'); }

            DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($valid['new-password'])
            ]);

            return back()->with('message', 'success update');
        }

        return back();

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
