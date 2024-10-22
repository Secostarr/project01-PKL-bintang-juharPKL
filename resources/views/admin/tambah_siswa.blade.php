@extends('admin.layouts.app')
@section('title', 'Tambah Siswa')
@section('content')


<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="text-primary">TAMBAH SISWA</h2>
            <form action="{{ Route('admin.pembimbing.siswa.store', $id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN Siswa">
                    <div class="text-danger">
                        @error('nisn')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Siswa">
                    <div class="text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Siswa">
                    <div class="text-danger">
                        @error('nama_siswa')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    <div class="text-danger">
                        @error('foto')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ Route('admin.pembimbing.siswa', $id) }}" class="btn btn-danger ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>


@endsection