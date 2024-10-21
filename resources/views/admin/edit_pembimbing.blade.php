@extends('admin.layouts.app')
@section('title', 'Edit Guru')
@section('content')


<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="text-warning">EDIT GURU</h2>
            <form action="{{ Route('admin.pembimbing.update', $pembimbing->id_pembimbing ) }}" method="post"">
                @csrf
                @method('PUT')
                <div class=" mb-3">
                <label for="nip" class="form-label">Nama Guru</label>
                <select name="id_guru" id="id_guru" class="form-select">
                    <option value="">--PILIH--</option>
                    @foreach($gurus as $guru)
                    <option value="{{ $guru->id_guru }}" {{ $pembimbing->id_guru == $guru->id_guru ? 'selected' : ''}}>{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
                <div class="text-danger">
                    @error('nip')
                    {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Nama Dudi</label>
            <select name="id_dudi" id="id_dudi" class="form-select">
                <option value="">--PILIH--</option>
                @foreach($dudis as $dudi)
                <option value="{{ $dudi->id_dudi }}" {{ $pembimbing->id_dudi == $dudi->id_dudi ? 'selected' : ''}}>{{ $dudi->nama_dudi }}</option>
                @endforeach
            </select>
            <div class="text-danger">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ Route('admin.pembimbing') }}" class="btn btn-danger ms-2">Batal</a>
        </form>
    </div>
</div>
</div>

@endsection