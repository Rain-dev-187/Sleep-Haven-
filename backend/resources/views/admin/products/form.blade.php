@extends('admin.layout')

@section('content')
<h2>{{ $product->exists ? 'Ubah' : 'Tambah' }} Produk</h2>
<form method="post" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" style="background:white;padding:20px;border-radius:10px;max-width:600px">
  @csrf
  @if($product->exists) @method('PUT') @endif
  <label>Kategori</label>
  <select name="category_id">
    <option value="">-- Tanpa kategori --</option>
    @foreach($categories as $c)
    <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
    @endforeach
  </select>
  <label>Nama produk</label>
  <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
  <label>Deskripsi</label>
  <textarea name="description" rows="3">{{ old('description', $product->description) }}</textarea>
  <label>Harga (Rp)</label>
  <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" required>
  <label>Stok</label>
  <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required>
  <label>Gambar</label>
  <input type="file" name="image" accept="image/*">
  <label><input type="checkbox" name="is_active" value="1" style="width:auto" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}> Tampilkan di katalog</label>
  <br><br>
  <button class="btn" type="submit">Simpan</button>
  <a href="{{ route('admin.products.index') }}" style="margin-left:10px">Batal</a>
</form>
@endsection
