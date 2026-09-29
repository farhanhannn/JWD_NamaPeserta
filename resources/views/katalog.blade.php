@extends('layouts.app')

@section('content')
<h2 class="mb-4">Katalog Produk</h2>

<form action="{{ route('katalog') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau kategori..." value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Cari</button>
    </div>
</form>

<div class="row">
    @forelse($products as $p)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                @if($p->gambar)
                    <img src="{{ asset('storage/'.$p->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                @else
                    <div class="bg-secondary text-white text-center py-5">Gambar Tidak Ada</div>
                @endif
                <div class="card-body">
                    <span class="badge bg-secondary mb-2">{{ $p->kategori }}</span>
                    <h5 class="card-title">{{ $p->nama }}</h5>
                    <p class="card-text text-primary fw-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    <p class="card-text"><small class="text-muted">Stok: {{ $p->stok }}</small></p>
                    <a href="{{ route('katalog.detail', $p->id) }}" class="btn btn-sm btn-outline-primary w-100">Detail</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><p class="text-center text-muted">Produk tidak ditemukan.</p></div>
    @endforelse
</div>
@endsection