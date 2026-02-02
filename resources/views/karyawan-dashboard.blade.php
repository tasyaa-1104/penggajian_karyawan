<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        *{
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body{
            margin:0;
            min-height:100vh;
            background:#f4f7fb;
        }

        /* NAVBAR */
        .navbar{
            background:#1f6cff;
            color:#fff;
            padding:16px 24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:18px;
            font-weight:600;
        }

        .logout-form button{
            background:#fff;
            color:#1f6cff;
            border:none;
            padding:8px 14px;
            border-radius:8px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .logout-form button:hover{
            background:#e9efff;
        }

        /* CONTAINER */
        .container{
            max-width:800px;
            margin:40px auto;
            padding:0 16px;
        }

        /* CARD */
        .card{
            background:#fff;
            border-radius:14px;
            padding:24px 28px;
            box-shadow:0 12px 28px rgba(0,0,0,0.08);
        }

        .card h2{
            margin-top:0;
            margin-bottom:20px;
            color:#1f6cff;
            font-size:26px;
        }

        .card p{
            margin:10px 0;
            font-size:15px;
            color:#333;
        }

        .card p strong{
            display:inline-block;
            width:120px;
            color:#555;
        }

        /* BUTTON */
        .btn{
            display:inline-block;
            margin-top:22px;
            padding:12px 20px;
            background:#1f6cff;
            color:#fff;
            text-decoration:none;
            border-radius:10px;
            font-weight:600;
            transition:0.3s;
        }

        .btn:hover{
            background:#114fc9;
        }

        /* RESPONSIVE */
        @media (max-width:600px){
            .card p strong{
                width:auto;
                display:block;
                margin-bottom:4px;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>Dashboard Karyawan</div>

    <!-- LOGOUT -->
    <form action="{{route('login')}}" class="logout-form">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<div class="container">

@isset($karyawan)
    <div class="card">
        <h2>{{ $karyawan->nama_karyawan }}</h2>

        <p><strong>NIK:</strong> {{ $karyawan->nik }}</p>
        <p><strong>Divisi:</strong> {{ $karyawan->divisi->nama_divisi }}</p>
        <p><strong>Jabatan:</strong> {{ $karyawan->jabatan->nama_jabatan }}</p>
        <p><strong>Gaji Pokok:</strong>
            Rp {{ number_format($karyawan->gaji_pokok,0,',','.') }}
        </p>

        <a href="{{ route('slip-gaji.index') }}" class="btn">
            Lihat Slip Gaji
        </a>
    </div>
@endisset

</div>

</body>
</html>
