<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            if(Auth::user()->role == 'admin'){
                return redirect('admin/dashboard'); 
            }elseif(Auth::user()->role == 'user'){
                return redirect('user/dashboard'); 
            }
        } 
        Session::flash('peringatan','Password atau sandi anda salah');
        return redirect('/');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        alert()->success('You have been logged out.', 'Good bye!');

        return redirect('/');

    }
}
