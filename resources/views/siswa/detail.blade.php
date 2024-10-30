@extends('siswa.layouts.app')
@section('title', 'Detail')
@section('content')

@if($kegiatan)
<div class="container-fluid pt-4 px-1">
    <div class="row bg-light rounded align-items-center mx-0">
        <div class="col-md-4 p-3">
            <table>
                <tr>
                    <td width="100">Nama SIswa</td>
                    <td width="10">:</td>
                    <td>{{ $kegiatan->KegiatanSiswa->nama_siswa }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>
@endif

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
                            <img class="" src="{{ asset('storage/' . $kegiatan->foto) }}" alt="" style="width: 700px;">
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
            </form>
            <div class="d-flex text-center">
                <a href="{{ Route('siswa.Kegiatan') }}" class="btn btn-primary">Keluar</a>
            </div>
        </div>
    </div>
</div>


@endsection