@extends('guru.layouts.app')
@section('title', 'Kegiatan Siswa')
@section('content')

@if ($errors->has('access'))
<div class="alert alert-danger">
    {{ $errors->first('access') }}
</div>
@endif

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

<div class="row g-4">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2 class="mb-4">Data Kegiatan Siswa </h2>
        <form action="{{ Route('guru.pembimbing.siswa.kegiatan.cari', ['id' => $id_pembimbing, 'id_siswa' => $id_siswa]) }}" method="GET" class="d-flex align-items-end gap-2 w-50">
            <div class="mb-3 flex-grow-1">
                <label for="tanggal_awal" class="form-label">Tanggal Awal :</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ $tanggalAwal ?? '' }}">
                <div class="text-danger">
                    @error('tanggal_awal')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-3 flex-grow-1">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir :</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir ?? '' }}">
                <div class="text-danger">
                    @error('tanggal_akhir')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="d-flex align-items-end mb-3 gap-1">
                <!-- Tombol Filter dengan ikon pencarian -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Tombol Reset -->
                <a href="{{ Route('guru.pembimbing.siswa.kegiatan', ['id' => $id_pembimbing, 'id_siswa' => $id_siswa]) }}" type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table" id="siswa">
                <thead>

                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $kegiatan)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="d-flex">
                            <a href="{{ route('guru.pembimbing.siswa.detail', ['id' => $id_pembimbing, 'id_siswa' => $kegiatan->id_siswa, 'id_kegiatan' => $kegiatan->id_kegiatan ]) }}"
                                class="btn btn-outline-info shadow-sm">
                                <i class="bi bi-person-bounding-box"></i> Detail
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