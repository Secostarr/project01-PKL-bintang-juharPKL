<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Dudi;
use App\Models\Admin\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DudiController extends Controller
{
    public function dudi()
    {
        $dudis = Dudi::all();
        $admin = Auth::guard('admin')->user();
        return view('admin.dudi', compact('admin', 'dudis'));
    }

    public function create() 
    {
        return view('admin.tambah_dudi');
    }

    public function store(Request $request) 
    {
    
        $request->validate([
            'nama_dudi' => 'required',
            'alamat' => 'required',
        ]);

        Dudi::create([
            'nama_dudi' => $request->nama_dudi,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.dudi')->with('success', 'Data Dudi Berhasil Di Tambah.');
    }

    public function edit(string $id) 
    {
        
        $dudi = Dudi::find($id);
        if (!$dudi) {
            return back();
        }
        return view('admin.edit_dudi', compact('dudi'));

    }

    public function delete(Request $request, $id)
    {
        $dudi = Dudi::find($id);

        $dudi->delete();

        return redirect()->route('admin.dudi')->with('success', 'Data Dudi Berhasil Di Hapus');
    }

    public function update(Request $request, string $id) 
    {
        
        $dudi = Dudi::find($id);
        $request->validate([
            'nama_dudi' => 'required',
            'alamat' => 'required',
        ]);

        $dudi->update([
            'nama_dudi' => $request->nama_dudi,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.dudi')->with('success', 'Data Dudi Berhasil Di Update.');


    }
}
