<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    
    public function siswa($id)
    {
        $siswas = Siswa::where('id_pembimbing', $id)->get();
        $siswa = Siswa::where('id_pembimbing', $id)->first();
        return view('admin.siswa', compact('siswas', 'siswa', 'id'));    
    }

    public function create($id)
    {
        return view('admin.tambah_siswa', compact('id'));
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'nisn' => 'required|unique:migration_siswa,nisn|digits:10',
            'password' => 'required|min:8',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_siswa', $uniqueFile, 'public');
            $foto = 'foto_siswa/' . $uniqueFile;
        }

        Siswa::create([
            'id_pembimbing' => $id,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'nama_siswa' => $request->nama_siswa,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.pembimbing.siswa', $id)->with('success', 'Data Siswa Berhasil Di Tambah.');
    }
}
