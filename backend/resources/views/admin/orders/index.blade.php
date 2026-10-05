@extends('admin.layout')

@section('content')
<h2>Pesanan</h2>
<table>
  <tr><th>ID</th><th>Pembeli</th><th>Total</th><th>Bayar</th><th>Status</th><th></th></tr>
  @foreach($orders as $o)
  <tr>
    <td>#{{ $o->id }}</td>
    <td>{{ $o->customer_name }}<br><span style="font-size:12px;color:#5b6b8c">{{ $o->phone }}</span></td>
    <td>Rp {{ number_format($o->total, 0, ',', '.') }}</td>
    <td>{{ $o->payment_method === 'cod' ? 'COD' : 'Transfer' }}</td>
    <td>{{ \App\Models\Order::statuses()[$o->status] ?? $o->status }}</td>
    <td>
      <form class="inline" method="post" action="{{ route('admin.orders.update', $o) }}">
        @csrf @method('PATCH')
        <select name="status" onchange="this.form.submit()" style="width:auto;margin:0">
          @foreach(\App\Models\Order::statuses() as $key => $label)
          <option value="{{ $key }}" {{ $o->status === $key ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </form>
    </td>
  </tr>
  @endforeach
</table>
{{ $orders->links() }}
@endsection
