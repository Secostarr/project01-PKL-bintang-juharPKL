@extends('guru.layouts.app')
@section('title', 'Profile')
@section('content')


<div class="row g-4 justify-content-center">
    <div class="col-8">
        <div class="bg-light rounded h-100 p-4">

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img class="rounded-circle border border-3 border-primary shadow-sm"
                        src="{{ asset('storage/' .$profile->foto) }}"
                        alt="Profile Picture"
                        style="width: 120px; height: 120px; transition: transform 0.3s ease-in-out;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-2"></div>
                </div>
                <h5 class="mt-3">{{ $profile->nama_guru }}</h5>
                <p class="text-muted">NIP: {{ $profile->nip ?? 'Guru Belum Memiliki NIP' }}</p>
            </div>
            <form action="{{ Route('guru.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}">
                    <div class="text-danger">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_guru" class="form-label">Nama Guru</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ $profile->nama_guru }}">
                    <div class="text-danger">
                        @error('nama_guru')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password (Opsional)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Nama Admin</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    <div class="text-danger">
                        @error('foto')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection