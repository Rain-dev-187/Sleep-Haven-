<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - Sleep Haven</title>
  <style>
    body { font-family: Arial, sans-serif; background: #1c2b4a; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .box { background: white; padding: 32px; border-radius: 12px; width: 320px; }
    input { width: 100%; padding: 8px; margin: 4px 0 12px; border: 1px solid #c9d3e8; border-radius: 6px; box-sizing: border-box; }
    button { width: 100%; background: #1c2b4a; color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; }
    .error { color: #c0392b; font-size: 13px; margin-bottom: 12px; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Login Admin</h2>
    @if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
    <form method="post" action="{{ route('admin.login.post') }}">
      @csrf
      <label>Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>
