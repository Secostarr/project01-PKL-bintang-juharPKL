@extends('siswa.layouts.app')
@section('title', 'Kegiatan Siswa')
@section('content')

@if ($errors->has('access'))
<div class="alert alert-danger">
    {{ $errors->first('access') }}
</div>
@endif

<div class="mb-3">
    <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-outline-primary shadow-sm">
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

        @if(session('hapus'))
        <div class="alert alert-success">
            {{ session('hapus') }}
        </div>
        @endif

        <h2 class="mb-4">Data Kegiatan Siswa</h2>
        <div class="table-responsive">
            <table class="table" id="siswa">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $kegiatan)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $kegiatan->KegiatanSiswa->nama_siswa }}</td>
                        <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="d-flex">
                            <a href="{{ route('siswa.kegiatan.detail', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}"
                                class="btn btn-outline-info shadow-sm">
                                <i class="bi bi-person-bounding-box"></i> Detail
                            </a>
                            <a href="{{ route('siswa.kegiatan.edit', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}" class="btn btn-outline-warning shadow-sm ms-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('siswa.kegiatan.delete', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}" onclick="return confirm('Yakin ingin hapus data ini?')" class="btn btn-outline-danger shadow-sm ms-2">
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
        $('#siswa').DataTable();
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
