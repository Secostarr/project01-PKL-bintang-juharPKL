@extends('siswa.layouts.app')
@section('title', 'Tambah Kegiatan')
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

            <form action="{{ Route('siswa.kegiatan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tanggal_kegiatan" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan">
                    <div class="text-danger">
                        @error('tanggal_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
                    <div class="text-danger">
                        @error('nama_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Kegiatan</label>
                    <div>
                        <input type="file" class="form-control mb-2" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                        <div class="d-flex align-items-center">
                            <div class="position-relative border rounded shadow-sm" style="overflow: hidden; max-width: 700px; max-height: 280px;">
                                <img id="preview" src="" alt="Hasil Foto Kegiatan" class="img-fluid">
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('foto')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ringkasan_kegiatan" class="form-label">Ringkasan Kegiatan</label>
                    <textarea class="form-control" id="ringkasan_kegiatan" name="ringkasan_kegiatan" rows="8" style="resize: none;"></textarea>
                    <div class="text-danger">
                        @error('ringkasan_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary text-center" style="width: 180px;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src);
            preview.style.width = 'auto';
            preview.style.height = 'auto';
            preview.style.maxWidth = '100%';
            preview.style.maxHeight = '100%';
        }
    }
</script>

@endsection