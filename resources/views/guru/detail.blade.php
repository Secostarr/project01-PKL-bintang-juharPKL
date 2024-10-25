@extends('guru.layouts.app')
@section('title', 'Profile')
@section('content')


<div class="row g-4 justify-content-center">
    <div class="col-12">

        @if ($errors->has('access'))
        <div class="alert alert-danger">
            {{ $errors->first('access') }}
        </div>
        @endif

        <div class="bg-light rounded h-100 p-4">

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $nama_siswa->nama_siswa }}" readonly>
                    <div class="text-danger">
                        @error('nama_siswa')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kegiatan" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ $kegiatan->tanggal_kegiatan }}" readonly>
                    <div class="text-danger">
                        @error('tanggal_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" readonly>
                    <div class="text-danger">
                        @error('nama_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                <label for="nama_kegiatan" class="form-label">Foto Kegiatan</label>
                    <div class="d-flex align-items-center">
                        <div class="position-relative">
                            <img class="" src="" alt="" style="width: 700px; height: 280px;">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ringkasan_kegiatan" class="form-label">Ringkasan Kegiatan</label>
                    <textarea class="form-control" id="ringkasan_kegiatan" name="ringkasan_kegiatan" rows="8" style="resize: none;" readonly>{{ $kegiatan->ringkasan_kegiatan }}</textarea>
                    <div class="text-danger">
                        @error('ringkasan_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div> -->
            </form>
        </div>
    </div>
</div>


@endsection