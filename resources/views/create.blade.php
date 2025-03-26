<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel</title>
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
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #555;
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
    
    <div class="container">
        <h2>Buat Artikel Baru</h2>
        <form action="/articles/store" method="POST">
            <div class="form-group">
                <label for="title">Judul Artikel</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Isi Artikel</label>
                <textarea id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit">Simpan Artikel</button>
        </form>
    </div>
</body>
</html>
