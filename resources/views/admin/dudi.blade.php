@extends('admin.layouts.app')
@section('title', 'Dudi')
@section('content')

<div class="mb-3">
    <a href="{{ Route('admin.dudi.create') }}" class="btn btn-outline-primary shadow-sm">
        <i class="bi bi-plus"></i> Tambah Data
    </a>
</div>

<div class="row g-4">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2 class="mb-4">Data Dudi</h2>
        <div class="table-responsive">
            <table class="table" id="guru">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Dudi</th>
                        <th scope="col">Alamat Dudi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($dudis as $dudi)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $dudi->nama_dudi }}</td>
                        <td>{{ $dudi->alamat }}</td>
                        <td class="d-flex">
                            <a href="{{ Route('admin.dudi.edit', $dudi->id_dudi) }}" class="btn btn-outline-warning shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <a href="{{ Route('admin.dudi.delete', $dudi->id_dudi) }}" onclick="return confirm('Yakin Ingin Hapus Data Ini?')" class="btn btn-outline-danger shadow-sm ms-1">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dudi').DataTable();
    });
</script>

@endsection