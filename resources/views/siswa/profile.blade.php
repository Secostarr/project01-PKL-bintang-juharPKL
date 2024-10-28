@extends('siswa.layouts.app')
@section('title', 'Profile Siswa')
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
                    <img id="profileImage" class="rounded-circle border border-3 border-primary shadow-sm"
                        src="{{ asset('storage/' .$profile->foto) }}"
                        alt="Profile Picture"
                        style="width: 120px; height: 120px; object-fit: cover; transition: transform 0.3s ease-in-out;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-2"></div>
                </div>
                <h5 class="mt-3">{{ $profile->nama_siswa }}</h5>
                <p class="text-muted">NISN: {{ $profile->nisn}}</p>
            </div>
            <form action="{{ route('siswa.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $profile->nama_siswa }}">
                    <div class="text-danger">
                        @error('nama_siswa')
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
                    <label for="foto" class="form-label">Foto Profile</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
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

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
