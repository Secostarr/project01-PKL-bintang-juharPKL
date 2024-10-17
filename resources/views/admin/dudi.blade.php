@extends('admin.layouts.app')
@section('title', 'Dudi')
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
                <th>Nama Dudi</th>
                <th>Alamat Dudi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <td>1</td>
            <td>CV Woka Project Mandiri</td>
            <td>24</td>
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
            </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection