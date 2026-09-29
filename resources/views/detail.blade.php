@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <div class="row">
        <div class="col-md-5">
            @if($product->gambar)
                <img src="{{ asset('storage/'.$product->gambar) }}" class="img-fluid rounded">
            @else
                <div class="bg-secondary text-white text-center py-5 rounded">Gambar Tidak Ada</div>
            @endif
        </div>
        <div class="col-md-7">
            <h2>{{ $product->nama }}</h2>
            <p class="text-muted">Kode: {{ $product->kode }} | Kategori: <span class="badge bg-info text-dark">{{ $product->kategori }}</span></p>
            <h3 class="text-primary fw-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>
            <p><strong>Stok Tersedia:</strong> {{ $product->stok }}</p>
            <hr>
            <h5>Deskripsi Produk:</h5>
            <p>{{ $product->deskripsi }}</p>
            <a href="{{ route('katalog') }}" class="btn btn-secondary">Kembali ke Katalog</a>
        </div>
    </div>
</div>
@endsection