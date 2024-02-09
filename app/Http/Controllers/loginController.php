<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(){
        return view('login.index',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/library');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
