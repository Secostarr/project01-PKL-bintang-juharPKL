                    @extends('guru.layouts.app')
                    @section('title', 'Siswa')
                    @section('content')

                    @if($siswa)
                    <div class="container-fluid pt-4 px-1">
                        <div class="row bg-light rounded align-items-center mx-0">
                            <div class="col-md-4 p-3">
                                <table>
                                    <tr>
                                        <td width="100">Pembimbing</td>
                                        <td width="10">:</td>
                                        <td>{{ $siswa->pembimbingSiswa->guru->nama_guru }}</td>
                                    </tr>
                                    <tr>
                                        <td width="100">DUDI</td>
                                        <td width="10">:</td>
                                        <td>{{ $siswa->pembimbingSiswa->dudi->nama_dudi }}</td>
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
                            <h2 class="mb-4">Data Siswa </h2>
                            <div class="table-responsive">
                                <table class="table" id="siswa">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">Nama Siswa</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswas as $siswa)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $siswa->nisn }}</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $siswa->foto) }}" height="35">
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ Route('guru.pembimbing.siswa.kegiatan') }}" class="btn btn-outline-info shadow-sm">
                                                    <i class="bi bi-person-bounding-box"></i> Kegiatan
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