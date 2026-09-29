@extends('layouts.app')

@section('content')
<h2>Tambah Produk Baru</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
    @csrf
    <div class="mb-3">
        <label>Kode Produk</label>
        <input type="text" name="kode" class="form-control" value="{{ old('kode') }}">
    </div>
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
    </div>
    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}">
    </div>
    <div class="mb-3">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok') }}">
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
    </div>
    <div class="mb-3">
        <label>Gambar Produk (Opsional)</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection