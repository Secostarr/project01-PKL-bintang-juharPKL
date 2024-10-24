@extends('guru.layouts.app')
@section('title', 'Kegiatan Siswa')
@section('content')

<div class="row g-4">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2 class="mb-4">Data Kegiatan Siswa </h2>
        <div class="table-responsive">
            <table class="table" id="siswa">
                <thead>

                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td></td>
                        <td></td>
                        <td>
                            <img src="" height="35">
                        </td>
                        <td class="d-flex">
                            <a href="{{ Route('guru.pembimbing.siswa.detail') }}" class="btn btn-outline-info shadow-sm">
                                <i class="bi bi-person-bounding-box"></i> Detail
                            </a>
                        </td>
                    </tr>

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