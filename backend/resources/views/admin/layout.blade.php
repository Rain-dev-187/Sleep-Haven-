<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Sleep Haven</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; background: #f4f6fa; color: #1c2b4a; }
    header { background: #1c2b4a; color: white; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; }
    header a { color: white; margin-left: 16px; text-decoration: none; font-size: 14px; }
    main { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
    table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; }
    th { background: #1c2b4a; color: white; text-align: left; }
    th, td { padding: 10px; font-size: 14px; }
    tr { border-top: 1px solid #e5e9f2; }
    .btn { background: #1c2b4a; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
    .btn-danger { background: #c0392b; }
    .alert { background: #d4edda; color: #155724; padding: 10px 16px; border-radius: 8px; margin-bottom: 16px; }
    input, textarea, select { width: 100%; padding: 8px; margin: 4px 0 12px; border: 1px solid #c9d3e8; border-radius: 6px; box-sizing: border-box; }
    label { font-weight: bold; font-size: 14px; }
    .inline { display: inline; }
  </style>
</head>
<body>
  <header>
    <strong>Admin Sleep Haven</strong>
    <nav>
      <a href="{{ route('admin.products.index') }}">Produk</a>
      <a href="{{ route('admin.orders.index') }}">Pesanan</a>
      <a href="{{ route('catalog.index') }}" target="_blank">Lihat Toko</a>
      <form class="inline" method="post" action="{{ route('admin.logout') }}">@csrf<button style="background:none;border:none;color:white;cursor:pointer;font-size:14px">Keluar</button></form>
    </nav>
  </header>
  <main>
    @if(session('ok'))<div class="alert">{{ session('ok') }}</div>@endif
    @yield('content')
  </main>
</body>
</html>
