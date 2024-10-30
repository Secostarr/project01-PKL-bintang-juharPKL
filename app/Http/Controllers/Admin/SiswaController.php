<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kegiatan;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{

    public function siswa($id)
    {
        $pembimbing = Pembimbing::find($id);
        if (!$pembimbing) {
            return back();
        }
        $siswas = Siswa::where('id_pembimbing', $id)->get();
        $siswa = Siswa::where('id_pembimbing', $id)->first();
        return view('admin.siswa', compact('siswas', 'siswa', 'id'));
    }

    public function create($id)
    {
        $pembimbing = Pembimbing::find($id);
        if (!$pembimbing) {
            return back();
        }
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

    public function delete($id, $id_siswa)
    {
        $siswa = Siswa::find($id_siswa);

        if ($siswa->foto) {
            $foto = $siswa->foto;

            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
        }

        $siswa->delete();

        return redirect()->route('admin.pembimbing.siswa', $id)->with('success', 'Data Siswa Berhasil Di Hapus');
    }

    public function edit(string $id, $id_siswa)
    {
        $pembimbing = Pembimbing::find($id);
        if (!$pembimbing) {
            return back();
        }
        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            return back();
        }
        return view('admin.edit_siswa', compact('siswa', 'id'));
    }

    public function update(Request $request, string $id, $id_siswa)
    {

        $siswa = Siswa::find($id_siswa);
        $request->validate([
            'nisn' => 'required|digits:10|unique:migration_siswa,nisn,' . $siswa->id_siswa . ',id_siswa',
            'password' => 'nullable|min:8',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $siswa->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('foto_siswa', $uniqueFile, 'public');
            $foto = 'foto_siswa/' . $uniqueFile;
        }

        $siswa->update([
            'nisn' => $request->nisn,
            'password' => $request->filled('password') ? Hash::make($request->password) : $siswa->password,
            'nama_siswa' => $request->nama_siswa,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.pembimbing.siswa', $id)->with('success', 'Data Guru Berhasil Di Update.');
    }

    // SISWA LOGIN
    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('siswa.dashboard', compact('siswa'));
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    public function kegiatan()
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)->get();
        return view('siswa.kegiatan', compact('kegiatans'));
    }

    public function deleteKegiatan($id_kegiatan)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatan = Kegiatan::find($id_kegiatan);

        if ($kegiatan->foto) {
            $foto = $kegiatan->foto;

            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
        }

        $kegiatan->delete();

        return redirect()->route('siswa.Kegiatan')
            ->with('hapus', 'Data Kegiatan Berhasil Dihapus.');
    }

    public function profile()
    {
        $profile = Auth::guard('siswa')->user();
        return view('siswa.profile', compact('profile'));
    }

    public function updateSiswa(Request $request)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $siswa = Siswa::find($id_siswa);

        $request->validate([
            'password' => 'nullable|min:8',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $siswa->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('foto_siswa', $uniqueFile, 'public');
            $foto = 'foto_siswa/' . $uniqueFile;
        }

        $siswa->update([
            'password' => $request->filled('password') ? Hash::make($request->password) : $siswa->password,
            'nama_siswa' => $request->nama_siswa,
            'foto' => $foto,
        ]);

        return redirect()->back()->with('success', 'Data Anda Berhasil Di Update');
    }

    public function editKegiatan(string $id_kegiatan)
    {
        $siswa = Auth::guard('siswa')->user()->id_siswa;

        $kegiatan = Kegiatan::where('id_siswa', $siswa)
            ->where('id_kegiatan', $id_kegiatan)
            ->first();

        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan tidak ditemukan atau Anda tidak memiliki akses.']);
        }
        return view('siswa.edit_kegiatan', compact('kegiatan', 'siswa', 'id_kegiatan'));
    }

    public function updateKegiatan(Request $request, $id_kegiatan)
    {
        
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatan = Kegiatan::find($id_kegiatan);

        $request->validate([
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ringkasan_kegiatan' => 'required',
        ]);

        $foto = $kegiatan->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('foto_kegiatan', $uniqueFile, 'public');
            $foto = 'foto_kegiatan/' . $uniqueFile;
        }

        $kegiatan->update([
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'foto' => $foto,
            'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
        ]);

        return redirect()->route('siswa.Kegiatan', compact('id_kegiatan'))->with('success', 'Data Kegiatan Berhasil Di Update.');
    }

    public function detail($id_kegiatan)
    {
        $loginSiswa = Auth::guard('siswa')->user()->id_siswa;

        $kegiatan = Kegiatan::where('id_siswa', $loginSiswa)
            ->where('id_kegiatan', $id_kegiatan)
            ->first();

        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan tidak ditemukan atau Anda tidak memiliki akses.']);
        }
        
        $siswa = Siswa::where('id_siswa', $loginSiswa)->first();

        return view('siswa.detail', compact('id_kegiatan','kegiatan', 'siswa'));
    }
    
}
