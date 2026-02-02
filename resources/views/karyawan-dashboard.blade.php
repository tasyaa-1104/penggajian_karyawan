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
            display:flex;
        }

        /* SIDEBAR */
        .sidebar{
            width:240px;
            background:#1f6cff;
            color:#fff;
            padding:24px 18px;
            display:flex;
            flex-direction:column;
        }

        .sidebar h3{
            margin:0 0 30px;
            font-size:22px;
            font-weight:700;
            text-align:center;
        }

        .menu a{
            display:block;
            padding:12px 14px;
            margin-bottom:10px;
            color:#fff;
            text-decoration:none;
            border-radius:10px;
            font-weight:600;
            transition:0.3s;
        }

        .menu a:hover,
        .menu a.active{
            background:#114fc9;
        }

        .sidebar .logout-form{
            margin-top:auto;
        }

        .sidebar .logout-form button{
            width:100%;
            background:#fff;
            color:#1f6cff;
            border:none;
            padding:10px;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        }

        /* MAIN */
        .main{
            flex:1;
            display:flex;
            flex-direction:column;
        }

        /* TOP BAR */
        .topbar{
            background:#fff;
            padding:16px 24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 12px rgba(0,0,0,0.06);
        }

        .topbar .hi{
            font-size:16px;
            font-weight:600;
            color:#333;
        }

        /* CONTENT */
        .container{
            max-width:800px;
            margin:40px auto;
            padding:0 16px;
        }

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

        .btn{
            display:inline-block;
            margin-top:22px;
            padding:12px 20px;
            background:#1f6cff;
            color:#fff;
            text-decoration:none;
            border-radius:10px;
            font-weight:600;
        }

        /* RESPONSIVE */
        @media (max-width:768px){
            .sidebar{
                width:200px;
            }
        }

        @media (max-width:600px){
            body{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
                flex-direction:row;
                align-items:center;
                justify-content:space-between;
            }

            .menu{
                display:flex;
                gap:10px;
            }

            .sidebar h3{
                margin-bottom:0;
            }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h3>Karyawan</h3>

    <div class="menu">
        <a href="#" class="active">🏠 Beranda</a>
        <a href="{{ route('karyawan.absensi.create') }}">📍 Absensi</a>
    </div>

    <form action="{{ route('login') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOP BAR -->
    <div class="topbar">
        @isset($karyawan)
            <div class="hi">
                Hi, {{ $karyawan->nama_karyawan }} 👋
            </div>
        @endisset
    </div>

    <!-- CONTENT -->
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
</div>

</body>
</html>
