<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DudiController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\GuruLoginController;
use App\Http\Controllers\Auth\SiswaLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware(['guest'])->group(function () {
    // ADMIN
    Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'auth'])->name('admin.auth');

    // GURU
    Route::get('/guru/login', [GuruLoginController::class, 'login'])->name('guru.login');
    Route::post('/guru/login', [GuruLoginController::class, 'auth'])->name('guru.auth');

    // SISWA
    Route::get('/siswa/login', [SiswaLoginController::class, 'login'])->name('siswa.login');
    Route::post('/siswa/login', [SiswaLoginController::class, 'auth'])->name('siswa.auth');
});


Route::middleware(['admin'])->group(function () {
    // ADMIN
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');

    // GURU
    Route::get('/admin/guru', [GuruController::class, 'guru'])->name('admin.guru');
    Route::get('/admin/guru/tambah', [GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru/tambah', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::get('/admin/guru/delete/{id}', [GuruController::class, 'delete'])->name('admin.guru.delete');
    Route::get('/admin/guru/edit/{id}', [GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/admin/guru/edit/{id}', [GuruController::class, 'update'])->name('admin.guru.update');

    // DUDI
    Route::get('/admin/dudi', [DudiController::class, 'dudi'])->name('admin.dudi');
    Route::get('/admin/dudi/tambah', [DudiController::class, 'create'])->name('admin.dudi.create');
    Route::post('/admin/dudi/tambah', [DudiController::class, 'store'])->name('admin.dudi.store');
    Route::get('/admin/dudi/delete/{id}', [DudiController::class, 'delete'])->name('admin.dudi.delete');
    Route::get('/admin/dudi/edit/{id}', [DudiController::class, 'edit'])->name('admin.dudi.edit');
    Route::put('/admin/dudi/edit/{id}', [DudiController::class, 'update'])->name('admin.dudi.update');

    // PEMBIMBING
    Route::get('/admin/pembimbing', [PembimbingController::class, 'pembimbing'])->name('admin.pembimbing');
    Route::get('/admin/pembimbing/tambah', [PembimbingController::class, 'create'])->name('admin.pembimbing.create');
    Route::post('/admin/pembimbing/tambah', [PembimbingController::class, 'store'])->name('admin.pembimbing.store');
    Route::get('/admin/pembimbing/delete/{id}', [PembimbingController::class, 'delete'])->name('admin.pembimbing.delete');
    Route::get('/admin/pembimbing/edit/{id}', [PembimbingController::class, 'edit'])->name('admin.pembimbing.edit');
    Route::put('/admin/pembimbing/edit/{id}', [PembimbingController::class, 'update'])->name('admin.pembimbing.update');

    // SISWA
    Route::get('/admin/pembimbing/{id}/siswa', [SiswaController::class, 'siswa'])->name('admin.pembimbing.siswa');
    Route::get('/admin/siswa/tambah/{id}/siswa/tambah', [SiswaController::class, 'create'])->name('admin.pembimbing.siswa.create');
    Route::post('/admin/siswa/tambah/{id}/siswa/tambah', [SiswaController::class, 'store'])->name('admin.pembimbing.siswa.store');
    Route::get('/admin/pembimbing/{id}/siswa/delete/{id_siswa}', [SiswaController::class, 'delete'])->name('admin.pembimbing.siswa.delete');
    Route::get('/admin/pembimbing/{id}/siswa/edit/{id_siswa}', [SiswaController::class, 'edit'])->name('admin.pembimbing.siswa.edit');
    Route::put('/admin/pembimbing/{id}/siswa/edit//{id_siswa}', [SiswaController::class, 'update'])->name('admin.pembimbing.siswa.update');
});

Route::middleware(['guru'])->group(function () {
    Route::get('/guru/logout', [GuruController::class, 'logout'])->name('guru.logout');
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/pembimbing', [GuruController::class, 'pembimbing'])->name('guru.pembimbing');
    Route::get('/guru/pembimbing/{id}/siswa', [GuruController::class, 'siswa'])->name('guru.pembimbing.siswa');
    Route::get('/guru/profile', [GuruController::class, 'profile'])->name('guru.profile');
    Route::put('/guru/profile/update', [GuruController::class, 'updateGuru'])->name('guru.profile.update');
    Route::get('/guru/pembimbing/{id}/siswa/kegiatan/{id_siswa}', [KegiatanController::class, 'kegiatan'])->name('guru.pembimbing.siswa.kegiatan');
    Route::get('/guru/pembimbing/{id}/siswa/{id_siswa}/kegiatan/{id_kegiatan}', [KegiatanController::class, 'detail'])->name('guru.pembimbing.siswa.detail');
    Route::get('/guru/pembimbing/{id}/siswa/kegiatan/{id_siswa}/kegiatan/cari', [KegiatanController::class, 'cariKegiatan'])->name('guru.pembimbing.siswa.kegiatan.cari');
});

Route::middleware(['siswa'])->group(function () {
    Route::get('/siswa/logout', [SiswaController::class, 'logout'])->name('siswa.logout');
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/Kegiatan', [SiswaController::class, 'kegiatan'])->name('siswa.Kegiatan');
    Route::get('/siswa/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
    Route::put('/siswa/profile/update', [SiswaController::class, 'updateSiswa'])->name('siswa.profile.update');
    Route::get('/siswa/Kegiatan/tambah', [KegiatanController::class, 'storeKegiatan'])->name('siswa.kegiatan.create');
    Route::post('/siswa/Kegiatan/tambahkegiatan', [KegiatanController::class, 'tambahKegiatan'])->name('siswa.kegiatan.store');
    Route::get('/siswa/kegiatan/delete/{id_kegiatan}', [SiswaController::class, 'deleteKegiatan'])->name('siswa.kegiatan.delete');
    Route::get('/siswa/kegiatan/edit/{id_kegiatan}', [SiswaController::class, 'editKegiatan'])->name('siswa.kegiatan.edit');
    Route::put('/siswa/kegiatan/update/{id_kegiatan}', [SiswaController::class, 'updateKegiatan'])->name('siswa.kegiatan.update');
    Route::get('/siswa/kegiatan/detail/{id_kegiatan}', [SiswaController::class, 'detail'])->name('siswa.kegiatan.detail');
});
