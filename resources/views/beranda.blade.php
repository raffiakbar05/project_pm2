<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Artikel</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #d9e2ec; /* Warna biru keabu-abuan yang lebih gelap */
      color: #333;
    }

    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: #aac8f0;
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
      background: #e0f2fe;
    }

    .register {
      background: #3b82f6;
      color: white;
      border: none;
    }

    .register:hover {
      background: #2563eb;
    }

    header {
      background: #cdd5df;
      text-align: center;
      padding: 30px 0;
    }

    header h1 {
      margin: 0;
      color: #2b6cb0;
      font-size: 32px;
    }

    .container {
      width: 90%;
      max-width: 900px;
      margin: 30px auto;
    }

    .article {
      background: #ffffff;
      margin-bottom: 25px;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .article h2 {
      margin: 0 0 10px;
      color: #2563eb;
    }

    .article p {
      color: #444;
      margin-bottom: 15px;
    }

    .button {
      display: inline-block;
      padding: 10px 18px;
      background: #3b82f6;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .button:hover {
      background: #2563eb;
    }
  </style>
</head>
<body>
  <div class="nav">
    <div class="nav-links">
      <a href="{{route('beranda')}}">Beranda</a>
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

  <header>
    <h1>Website Artikel</h1>
  </header>

  <div class="container">
    <div class="article">
      <h2>Judul Artikel</h2>
      <p>Isi artikel singkat...</p>
      <a href="#" class="button">Baca Selengkapnya</a>
    </div>
    <div class="article">
      <h2>Judul Artikel Lain</h2>
      <p>Isi artikel singkat...</p>
      <a href="#" class="button">Baca Selengkapnya</a>
    </div>
  </div>
</body>
</html>
