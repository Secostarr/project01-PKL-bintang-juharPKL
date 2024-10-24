<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruLoginController extends Controller
{
    public function login()
    {
        return view('auth.guru_login');
    }

    public function auth(Request $request)
{
    $credentials = $request->validate([
        'nip_or_email' => 'required',
        'password' => 'required',
    ]);

    // Check if the input is an email or NIP
    $loginGuru = filter_var($request->nip_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

    // Attempt login based on email or NIP
    if (Auth::guard('guru')->attempt([$loginGuru => $request->nip_or_email, 'password' => $request->password])) {
        return redirect()->route('guru.dashboard')->with('success', 'Login Berhasil');
    }

    return back()->withErrors(['login_error' => 'nip/email atau password salah'])->onlyInput('nip_or_email');
}


    
}
