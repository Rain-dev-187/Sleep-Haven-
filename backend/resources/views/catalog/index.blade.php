@extends('layouts.app')

@section('content')
<h2>Katalog Produk</h2>
@if($products->count())
<div class="grid">
  @foreach($products as $p)
  <div class="card">
    <h3>{{ $p->name }}</h3>
    <div class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
    <div class="muted">Stok: {{ $p->stock }} &bull; {{ $p->category->name ?? '-' }}</div>
    @if($p->description)<p class="muted">{{ \Illuminate\Support\Str::words($p->description, 20) }}</p>@endif
    @if($p->stock > 0)
    <form method="post" action="{{ route('cart.add', $p->slug) }}">
      @csrf
      <button class="btn" type="submit">+ Keranjang</button>
    </form>
    @else
    <p style="color:#c0392b">Stok habis</p>
    @endif
  </div>
  @endforeach
</div>
@else
<div class="empty">Belum ada produk. Tambahkan lewat halaman admin.</div>
@endif
@endsection
