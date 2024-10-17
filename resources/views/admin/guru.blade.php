@extends('admin.layouts.app')
@section('title', 'Guru')
@section('content')

<div class="mb-3">
    <a href="{{ Route('admin.guru.create') }}" class="btn btn-outline-primary shadow-sm">
        <i class="bi bi-plus"></i> Tambah Data
    </a>
</div>

<div class="row g-4">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-seccess">
            {{ session('success') }}
        </div>
        @endif
        <h6 class="mb-4">Tambah Guru</h6>
        <h6 class="mb-4">Data Guru</h6>
        <div class="table-responsive">
            <table class="table" id="guru">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">foto</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gurus as $guru)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $guru->nip }}</td>
                        <td>{{ $guru->email }}</td>
                        <td>{{ $guru->nama_guru }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $guru->foto) }}" height="35">
                        </td>
                        <td class="d-flex">
                            <a href="#" class="btn btn-outline-warning shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ Route('admin.guru.delete', $guru->id_guru) }}" method="post">
                                @csrf
                                <a href="" class="btn btn-outline-danger shadow-sm ms-1">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </form>
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
        $('#guru').DataTable();
    });
</script>
@endsection