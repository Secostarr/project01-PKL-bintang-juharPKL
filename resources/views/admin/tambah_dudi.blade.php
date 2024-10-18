@extends('admin.layouts.app')
@section('title', 'Tambah Dudi')
@section('content')


<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="text-primary">TAMBAH GURU</h2>
            <form action="{{ Route('admin.dudi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_dudi" class="form-label">Nama Dudi</label>
                    <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" placeholder="Masukkan Nama Dudi">
                    <div class="text-danger">
                        @error('nama_dudi')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Dudi</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Dudi">
                     <div class="text-danger">
                        @error('alamat')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ Route('admin.guru') }}" class="btn btn-danger ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>


@endsection