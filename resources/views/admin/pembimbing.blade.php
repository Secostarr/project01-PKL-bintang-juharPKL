@extends('admin.layouts.app')
@section('title', 'Pembimbing')
@section('content')

<div class="mb-3">
    <a href="" class="btn btn-outline-primary shadow-sm">
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
        <h6 class="mb-4">Tambah Guru</h6>
        <h6 class="mb-4">Data Guru</h6>
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

                    <tr>
                        <th scope="row">#</th>
                        <td>#</td>
                        <td>#</td>
                        <td class="d-flex">
                            <a href="#" class="btn btn-outline-warning shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="" method="post">
                                @csrf
                                @method('DELETE')
                                <button href="" class="btn btn-outline-danger shadow-sm ms-1">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
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