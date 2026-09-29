@extends('layouts.app')

@section('content')
<div class="p-5 mb-4 bg-light rounded-3 text-center border">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Katalog UMKM Siswa SMK</h1>
        <p class="col-md-8 fs-4 mx-auto">Wadah kreativitas dan inovasi produk lokal hasil karya siswa SMK terbaik.</p>
        <a href="{{ route('katalog') }}" class="btn btn-primary btn-lg mt-3">Lihat Katalog Produk</a>
    </div>
</div>
@endsection