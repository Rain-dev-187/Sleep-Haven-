@extends('admin.layout')

@section('content')
<h2>Produk <a class="btn" href="{{ route('admin.products.create') }}" style="margin-left:12px">+ Tambah</a></h2>
<table>
  <tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aktif</th><th></th></tr>
  @foreach($products as $p)
  <tr>
    <td>{{ $p->name }}</td>
    <td>{{ $p->category->name ?? '-' }}</td>
    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
    <td>{{ $p->stock }}</td>
    <td>{{ $p->is_active ? 'Ya' : 'Tidak' }}</td>
    <td>
      <a href="{{ route('admin.products.edit', $p) }}">Ubah</a>
      <form class="inline" method="post" action="{{ route('admin.products.destroy', $p) }}" onsubmit="return confirm('Hapus produk ini?')">
        @csrf @method('DELETE')
        <button style="background:none;border:none;color:#c0392b;cursor:pointer">Hapus</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
{{ $products->links() }}
@endsection
