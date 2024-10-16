@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<!-- Blank Start -->
<div class="container-fluid pt-4 px-1">
    <div class="row bg-light rounded align-items-center mx-0">
        <div class="col-md-4 text-center p-3">
            <p>Hi {{ $admin->nama_admin }}, Selamat Datang Di Aplikasi Jurnal PKL </p>
        </div>
    </div>
</div>
<!-- Blank End -->

@endsection