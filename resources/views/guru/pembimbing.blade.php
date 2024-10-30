@extends('guru.layouts.app')
@section('title', 'Pembimbing')
@section('content')
<div class="row g-4">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2 class="mb-4">Data Yang Di Pembimbing</h2>
        <div class="table-responsive">
            <table class="table" id="pembimbing">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Nama Dudi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembimbings as $pembimbing)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $pembimbing->guru->nama_guru }}</td>
                        <td>{{ $pembimbing->dudi->nama_dudi }}</td>
                        <td class="d-flex">
                            <a href="{{ Route('guru.pembimbing.siswa', $pembimbing->id_pembimbing) }}" class="btn btn-outline-success shadow-sm">
                                <i class="bi bi-person-bounding-box"></i> Siswa
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
        $('#pembimbing').DataTable();
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