<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    public function login()
    {
        return view('auth.siswa_login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('siswa')->attempt($credentials)) {
            return redirect()->route('siswa.dashboard')->with('success', 'Login Berhasil');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah'])->onlyInput('nisn');
    }   
}
