<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sleep Haven</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; background: #f4f6fa; color: #1c2b4a; }
    header { background: #1c2b4a; color: white; padding: 16px 20px; text-align: center; }
    header p { margin: 4px 0 0; color: #9fb3d9; font-size: 14px; }
    nav { margin-top: 10px; }
    nav a { color: white; margin: 0 10px; text-decoration: none; }
    main { max-width: 900px; margin: 24px auto; padding: 0 16px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
    .card { background: white; border-radius: 10px; padding: 16px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
    .card h3 { margin: 0 0 8px; font-size: 16px; }
    .price { color: #1c2b4a; font-weight: bold; font-size: 18px; }
    .muted { font-size: 13px; color: #5b6b8c; }
    .empty { text-align: center; color: #5b6b8c; padding: 40px 0; }
    .btn { background: #1c2b4a; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; }
    .alert { background: #d4edda; color: #155724; padding: 10px 16px; border-radius: 8px; margin-bottom: 16px; }
    .error { background: #f8d7da; color: #721c24; padding: 10px 16px; border-radius: 8px; margin-bottom: 16px; }
    table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; }
    th { background: #1c2b4a; color: white; text-align: left; }
    th, td { padding: 10px; }
    tr { border-top: 1px solid #e5e9f2; }
    input, textarea, select { width: 100%; padding: 8px; margin: 4px 0 12px; border: 1px solid #c9d3e8; border-radius: 6px; box-sizing: border-box; }
    label { font-weight: bold; font-size: 14px; }
    footer { text-align: center; color: #8a97b3; font-size: 13px; padding: 24px; }
  </style>
</head>
<body>
  <header>
    <h1>Sleep Haven</h1>
    <p>kasur &bull; perlengkapan tidur &bull; home living</p>
    <nav>
      <a href="{{ route('catalog.index') }}">Katalog</a>
      <a href="{{ route('cart.index') }}">Keranjang</a>
    </nav>
  </header>
  <main>
    @if(session('ok'))<div class="alert">{{ session('ok') }}</div>@endif
    @if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
    @yield('content')
  </main>
  <footer>Sleep Haven &mdash; proyek mata kuliah</footer>
</body>
</html>
