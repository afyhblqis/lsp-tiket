<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        input:focus {
            border-color: #43e97b;
            outline: none;
            box-shadow: 0 0 5px rgba(67, 233, 123, 0.5);
        }

        button {
            width: 100%;
            padding: 10px;
            background: #43e97b;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2dd4bf;
        }

        p {
            text-align: center;
            font-size: 14px;
        }

        a {
            color: #43e97b;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2>Daftar Akun Baru</h2>
        <form action="/register" method="POST">
            @csrf
            <label>Nama:</label><br>
            <input type="text" name="name" required><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br>

            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="/">Login di sini</a></p>
    </div>

</body>

</html>
