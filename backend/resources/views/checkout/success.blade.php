@extends('layouts.app')

@section('content')
<div style="background:white;padding:32px;border-radius:10px;text-align:center">
  <h2>Pesanan berhasil dibuat!</h2>
  <p>Nomor pesananmu: <strong>#{{ $order->id }}</strong></p>
  <p>Total: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></p>
  <p>Simpan nomor ini. Admin akan menghubungimu untuk konfirmasi pembayaran/pengiriman.</p>
  <a class="btn" href="{{ route('catalog.index') }}">Kembali ke Katalog</a>
</div>
@endsection
