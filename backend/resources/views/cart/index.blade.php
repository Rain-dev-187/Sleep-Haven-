@extends('layouts.app')

@section('content')
<h2>Keranjang Belanja</h2>
@if(count($items))
<table>
  <tr><th>Produk</th><th>Jumlah</th><th>Subtotal</th><th></th></tr>
  @foreach($items as $i)
  <tr>
    <td>{{ $i['product']->name }}</td>
    <td>{{ $i['qty'] }}</td>
    <td>Rp {{ number_format($i['subtotal'], 0, ',', '.') }}</td>
    <td><a href="{{ route('cart.remove', $i['product']->id) }}">Hapus</a></td>
  </tr>
  @endforeach
</table>
<p style="font-size:18px"><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
<p>
  <a class="btn" href="{{ route('checkout.index') }}">Lanjut ke Checkout</a>
  <a href="{{ route('catalog.index') }}" style="margin-left:10px">Kembali belanja</a>
</p>
@else
<div class="empty">Keranjang masih kosong. <a href="{{ route('catalog.index') }}">Lihat katalog</a></div>
@endif
@endsection
