<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

// encrypt password
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// library
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.manage-user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.manage-user.create');

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
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'email_verified_at' => now(), 
            'password' => Hash::make('PW'.$request->email)
        ]);

        return redirect('admin/user')->with('success', 'Data Berhasil Di Tambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('pages.admin.manage-user.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users|max:255'. $user->id,
            'name' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'email_verified_at' => now(), 
            'password' => Hash::make('PW'.$request->email)
        ]);

        return redirect('admin/user')->with('success', 'Data Berhasil Di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->delete();
       return redirect('admin/user')->with('success', 'Data Berhasil Di Hapus!');

    }
}
