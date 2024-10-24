@extends('guru.layouts.app')
@section('title', 'Profile')
@section('content')


<div class="row g-4 justify-content-center">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nip" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="">
                    <div class="text-danger">
                        @error('nip')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="email" name="email" value="">
                    <div class="text-danger">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="position-relative">
                            <img class="" src="" alt="" style="width: 700px; height: 280px;">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ringkasan" class="form-label">Ringkasan</label>
                    <textarea class="form-control" id="ringkasan" name="ringkasan" rows="8" style="resize: none;"></textarea>
                    <div class="text-danger">
                        @error('ringkasan')
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