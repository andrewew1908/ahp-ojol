<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(Request $request) {
        return view('login');
    }
    public function prosesLogin(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'message' => 'Login Gagal',
        ]);
    }

    public function prosesLogout(Request $request) {
        Auth::logout();
        return redirect()->route('home');
    }
}
