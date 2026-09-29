@extends('layouts.app')

@section('content')
<h2>Ubah Produk</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Kode Produk</label>
        <input type="text" name="kode" class="form-control" value="{{ old('kode', $product->kode) }}">
    </div>
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $product->nama) }}">
    </div>
    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $product->kategori) }}">
    </div>
    <div class="mb-3">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="{{ old('harga', $product->harga) }}">
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $product->stok) }}">
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $product->deskripsi) }}</textarea>
    </div>
    <div class="mb-3">
        <label>Gambar Produk Saat Ini</label><br>
        @if($product->gambar)
            <img src="{{ asset('storage/'.$product->gambar) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
        @else
            <p class="text-muted">Belum ada gambar.</p>
        @endif
        <input type="file" name="gambar" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection