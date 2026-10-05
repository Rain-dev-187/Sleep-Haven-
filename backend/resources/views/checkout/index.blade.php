@extends('layouts.app')

@section('content')
<h2>Checkout</h2>
<p><strong>Total bayar: Rp {{ number_format($total, 0, ',', '.') }}</strong> ({{ $count }} barang)</p>
<form method="post" action="{{ route('checkout.store') }}" enctype="multipart/form-data" style="background:white;padding:20px;border-radius:10px;max-width:500px">
  @csrf
  <label>Nama lengkap</label>
  <input type="text" name="customer_name" value="{{ old('customer_name') }}" required>
  <label>No. HP</label>
  <input type="text" name="phone" value="{{ old('phone') }}" required>
  <label>Alamat lengkap</label>
  <textarea name="address" rows="3" required>{{ old('address') }}</textarea>
  <label>Metode pembayaran</label>
  <select name="payment_method">
    <option value="transfer">Transfer (upload bukti)</option>
    <option value="cod">COD (bayar di tempat)</option>
  </select>
  <label>Bukti pembayaran (khusus transfer)</label>
  <input type="file" name="payment_proof" accept="image/*">
  <button class="btn" type="submit">Buat Pesanan</button>
</form>
@endsection
