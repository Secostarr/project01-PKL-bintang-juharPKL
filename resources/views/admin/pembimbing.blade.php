@extends('admin.layouts.app')
@section('title', 'Pembimbing')
@section('content')

<div class="mb-3">
    <a href="#" class="btn btn-outline-primary shadow-sm">
        <i class="bi bi-plus"></i> Tambah Data
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Nama Dudi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <td>1</td>
            <td>Mahlina Gultom</td>
            <td>CV Woka Project Mandiri</td>
            <td class="d-flex gap-2">
                <form action="#" method="">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger shadow-sm">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
                <a href="#" class="btn btn-sm btn-outline-warning shadow-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="#" class="btn btn-sm btn-outline-success shadow-sm">
                    <i class="bi bi-person-square"></i> Siswa
                </a>
            </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection