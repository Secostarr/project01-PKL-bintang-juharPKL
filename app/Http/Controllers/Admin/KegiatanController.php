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

        return view('guru.kegiatan', compact('id','kegiatans', 'kegiatan'));
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
        $nama_siswa = Siswa::where('id_siswa', $id_siswa)->first();

    
        // Tampilkan view detail kegiatan
        return view('guru.detail', compact('kegiatan', 'nama_siswa'));
    }
    

}
