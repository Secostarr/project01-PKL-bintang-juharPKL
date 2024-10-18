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
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
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
                            <a href="{{ Route('admin.guru.edit', $guru->id_guru) }}" class="btn btn-outline-warning shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <a href="{{ Route('admin.guru.delete', $guru->id_guru) }}" onclick="return confirm('Yakin Ingin Haapus Data Ini?')" class="btn btn-outline-danger shadow-sm ms-1">
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
        $('#guru').DataTable();
    });

    function confirmRedirect(event) {
        event.preventDefault(); // Mencegah link dijalankan langsung

        swal({
                title: "Apakah kamu yakin?",
                text: "Kamu akan diarahkan ke halaman lain!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willGo) => {
                if (willGo) {
                    window.location.href = event.target.href; // Redirect ke link asli
                } else {
                    swal("Tindakan dibatalkan!");
                }
            });
    }
</script>
@endsection