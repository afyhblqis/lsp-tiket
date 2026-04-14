<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <h2>Login Pesawat</h2>
    <form action="/login" method="POST">
        @csrf
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Masuk</button>
    </form>
    <p>Belum punya akun? <a href="/register">Daftar sekarang</a></p>
</body>

</html>
