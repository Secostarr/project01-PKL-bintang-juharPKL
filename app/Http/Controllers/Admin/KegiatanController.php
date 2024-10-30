<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kegiatan;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function kegiatan($id, $id_siswa)
    {
        $loginGuru = Auth::guard('guru')->user()->id_guru;

        $siswa = Siswa::find($id_siswa);

        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => "Siswa Tidak Ditemukan Atau Tidak Memiliki Pembimbing."]);
        }

        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access' => 'Pembimbing Tidak Sesuai.']);
        }

        $pembimbing = Pembimbing::find($id);

        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses Anda Di Tolak. Siswa Ini Tidak Dibimbing Oleh Anda.']);
        }

        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)->get();
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)->first();
        $id_pembimbing = $id;

        return view('guru.kegiatan', compact('id_pembimbing', 'id_siswa', 'kegiatans', 'kegiatan'));
    }


    public function detail($id, $id_siswa, $id_kegiatan)
    {
        // Ambil ID guru yang sedang login
        $loginGuru = Auth::guard('guru')->user()->id_guru;
        // Cari siswa berdasarkan id_siswa
        $siswa = Siswa::find($id_siswa);
        // Validasi apakah siswa ada dan memiliki pembimbing
        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => "Siswa Tidak Ditemukan Atau Tidak Memiliki Pembimbing."]);
        }
        // Validasi apakah pembimbing siswa sesuai dengan pembimbing yang sedang login
        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access' => 'Pembimbing Tidak Sesuai.']);
        }
        // Cari pembimbing berdasarkan id
        $pembimbing = Pembimbing::find($id);
        // Validasi apakah pembimbing benar dan sesuai dengan guru yang login   
        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses Anda Di Tolak. Siswa Ini Tidak Dibimbing Oleh Anda.']);
        }
        // Cari kegiatan berdasarkan id_siswa dan id_kegiatan
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)
            ->where('id_kegiatan', $id_kegiatan) // Menggunakan 'id_kegiatan' sebagai gantinya
            ->first();
        // Validasi apakah kegiatan ditemukan
        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan Tidak Ditemukan.']);
        }
        $siswa = Siswa::where('id_siswa', $id_siswa)->first();
        // Tampilkan view detail kegiatan
        return view('guru.detail', compact('id', 'kegiatan', 'siswa'));
    }

    public function storeKegiatan()
    {
        return view('siswa.tambah_kegiatan');
    }

    public function tambahKegiatan(Request $request)
    {
        $request->validate([
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'ringkasan_kegiatan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('foto_kegiatan', $uniqueFile, 'public');
            $foto = 'foto_kegiatan/' . $uniqueFile;
        }


        $id_siswa = Auth::guard('siswa')->user()->id_siswa;

        Kegiatan::create([
            'id_siswa' => $id_siswa,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
            'foto' => $foto,
        ]);

        return redirect()->route('siswa.Kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function cariKegiatan(Request $request, $id, $id_siswa)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
    
        // Validasi apakah siswa ada
        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            return back()->withErrors(['access' => 'Siswa Tidak Ditemukan.']);
        }
    
        // Ambil ID guru yang sedang login
        $loginGuru = Auth::guard('guru')->user()->id_guru;
    
        // Validasi apakah siswa memiliki pembimbing
        if (!$siswa->id_pembimbing) {
            return back()->withErrors(['access' => 'Siswa Tidak Memiliki Pembimbing.']);
        }
    
        // Validasi apakah pembimbing siswa sesuai dengan pembimbing yang sedang login
        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access' => 'Pembimbing Tidak Sesuai.']);
        }
    
        // Cari pembimbing berdasarkan id
        $pembimbing = Pembimbing::find($id);
    
        // Validasi apakah pembimbing benar dan sesuai dengan guru yang login   
        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses Anda Ditolak. Siswa Ini Tidak Dibimbing Oleh Anda.']);
        }
    
        // Ambil tanggal dari request
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
    
        // Ambil data kegiatan
        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)
            ->whereBetween('tanggal_kegiatan', [$tanggalAwal, $tanggalAkhir])
            ->get();
    
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)
            ->whereBetween('tanggal_kegiatan', [$tanggalAwal, $tanggalAkhir])
            ->first();
    
        // Kirim data ke view
        return view('guru.kegiatan', compact('kegiatans', 'kegiatan', 'id', 'tanggalAwal', 'tanggalAkhir', 'id_siswa'));
    }
    
}
