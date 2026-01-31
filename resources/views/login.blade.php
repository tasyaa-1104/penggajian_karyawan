<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Penggajian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        *{
            font-family: 'Segoe UI', sans-serif;
            box-sizing: border-box;
        }

        body{
            margin:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg,#5b9cff,#1f6cff);
        }

        .login-box{
            background:#fff;
            width:360px;
            padding:40px 30px;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
            text-align:center;
        }

        .login-box h2{
            margin-bottom:5px;
            font-size:26px;
        }

        .login-box p{
            margin-bottom:25px;
            color:#777;
        }

        .login-box input{
            width:100%;
            padding:12px 14px;
            margin-bottom:15px;
            border-radius:8px;
            border:1px solid #ddd;
            outline:none;
            font-size:14px;
        }

        .login-box input:focus{
            border-color:#1f6cff;
        }

        .login-box a{
            display:block;
            text-align:left;
            font-size:13px;
            color:#1f6cff;
            text-decoration:none;
            margin-bottom:20px;
        }

        .login-box button{
            width:100%;
            padding:12px;
            border:none;
            background:#1f6cff;
            color:#fff;
            border-radius:10px;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .login-box button:hover{
            background:#114fc9;
        }

        .back-home{
            display:block;
            margin-top:15px;
            font-size:13px;
            color:#555;
            text-decoration:none;
        }

        .back-home:hover{
            color:#1f6cff;
            text-decoration:underline;
        }
    </style>
</head>
<body>

    <form class="login-box" method="POST" action="{{ route('login.proses') }}">
        @csrf

        <h2>Login</h2>
        <p>Enter your credentials</p>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <a href="#">Forgotten password?</a>

        <button type="submit">LOGIN</button>

        <!-- 🔥 KEMBALI KE HALAMAN AWAL -->
        <a href="{{ url('/') }}" class="back-home">
            ← Kembali ke Halaman Awal
        </a>
    </form>

</body>
</html>
