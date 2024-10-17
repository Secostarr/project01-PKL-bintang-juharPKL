<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DudiController extends Controller
{
    public function dudi()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.dudi', compact('admin'));
    }
}
