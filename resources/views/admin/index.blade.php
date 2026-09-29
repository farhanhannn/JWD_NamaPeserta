@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Pengelolaan Data Produk (Admin)</h2>
    <a href="{{ route('admin.create') }}" class="btn btn-success">+ Tambah Produk</a>
</div>

<form action="{{ route('admin.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nama/kategori..." value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Cari</button>
    </div>
</form>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $p)
        <tr>
            <td>{{ $p->kode }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->kategori }}</td>
            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
            <td>{{ $p->stok }}</td>
            <td>
                <a href="{{ route('admin.edit', $p->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                <form action="{{ route('admin.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data produk.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection