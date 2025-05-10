<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Artikel</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: #cce0f4;
      color: #333;
    }

    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: #a4cafe;
      color: #333;
    }

    .nav-links a {
      margin: 0 15px;
      text-decoration: none;
      color: #1e293b;
      font-weight: bold;
      transition: opacity 0.3s;
    }

    .nav-links a:hover {
      opacity: 0.8;
    }

    .auth-buttons a {
      margin-left: 10px;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      font-weight: bold;
      transition: background 0.3s, color 0.3s;
    }

    .login {
      background: white;
      color: #3b82f6;
      border: 1px solid #3b82f6;
    }

    .login:hover {
      background: #dbeafe;
    }

    .register {
      background: #3b82f6;
      color: white;
      border: none;
    }

    .register:hover {
      background: #2563eb;
    }

    .container {
      width: 90%;
      max-width: 700px;
      margin: 40px auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2563eb;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background: #f1f5f9;
      font-size: 15px;
      color: #333;
    }

    input[type="file"] {
      padding: 10px;
      background: #fff;
    }

    input:focus,
    textarea:focus {
      outline: 2px solid #60a5fa;
      background-color: #fff;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #3b82f6;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
    }

    button:hover {
      background: #2563eb;
    }
  </style>
</head>
<body>
  <div class="nav">
    <div class="nav-links">
      <a href="{{route('article.index')}}">Beranda</a>
      <a href="{{ route('article.create') }}">Create Artikel</a>
      <a href="/profile">Profile</a>
    </div>
    <div class="auth-buttons">
      <a href="{{ route('login') }}" class="login">Log in</a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}" class="register">Register</a>
      @endif
    </div>
  </div>

  <div class="container">
    <h2>Buat Artikel Baru</h2>
    <form action="/articles/store" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Judul Artikel</label>
        <input type="text" id="title" name="title" required />
      </div>
      <div class="form-group">
        <label for="content">Isi Artikel</label>
        <textarea id="content" name="content" rows="6" required></textarea>
      </div>
      <div class="form-group">
        <label for="image">Upload Gambar Artikel</label>
        <input type="file" id="image" name="image" accept="image/*" />
      </div>
      <button type="submit">Simpan Artikel</button>
    </form>
  </div>
</body>
</html>
