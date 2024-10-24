@extends('guru.layouts.app')
@section('title', 'Dashboard')
@section('content')

<!-- Blank Start -->
<div class="container-fluid pt-4 px-1">
    <div class="mb-2">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="row bg-light rounded align-items-center mx-0">
        <div class="col-md-4 text-center p-3">
            <p>Hi {{ $guru->nama_guru }}, Selamat Datang Di Aplikasi Jurnal PKL </p>
        </div>
    </div>
</div>
<!-- Blank End -->

@endsection