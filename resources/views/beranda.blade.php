<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: #eee;
        }
        .nav-links a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .article {
            background: #fff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .article h2 {
            margin: 0 0 10px;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .auth-buttons a {
            display: inline-block;
            margin: 5px;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .login {
            color: #1b1b18;
            border: 1px solid transparent;
            background: none;
            padding: 10px 15px;
        }
        .login:hover {
            border-color: #19140035;
        }
        .register {
            color: #1b1b18;
            border: 1px solid #19140035;
            background: none;
            padding: 10px 15px;
        }
        .register:hover {
            border-color: #1915014a;
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="nav-links">
            <a href="beranda.blade.php">Beranda</a>
            <a href="create.blade.php">Create Artikel</a>
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
