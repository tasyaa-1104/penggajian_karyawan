<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Karyawan</title>
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

        /* MAIN */
        .main{
            flex:1;
            display:flex;
            flex-direction:column;
        }

        .topbar{
            background:#fff;
            padding:16px 24px;
            box-shadow:0 4px 12px rgba(0,0,0,0.06);
            font-weight:600;
        }

        .container{
            max-width:520px;
            margin:40px auto;
            padding:0 16px;
        }

        .card{
            background:#fff;
            border-radius:14px;
            padding:24px;
            box-shadow:0 12px 28px rgba(0,0,0,0.08);
        }

        label{
            font-weight:600;
            margin-bottom:6px;
            display:block;
        }

        .form-control{
            width:100%;
            padding:10px 12px;
            margin-bottom:14px;
            border-radius:8px;
            border:1px solid #ccc;
        }

        .btn{
            padding:12px 18px;
            border:none;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        }

        .btn-success{
            background:#1f6cff;
            color:#fff;
        }

        .btn-secondary{
            background:#ccc;
            color:#333;
            text-decoration:none;
            padding:12px 18px;
            border-radius:10px;
            margin-left:6px;
        }

        .alert{
            background:#ffe5e5;
            color:#b40000;
            padding:12px;
            border-radius:10px;
            margin-bottom:16px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h3>Karyawan</h3>

    <div class="menu">
        <a href="{{ route('karyawan.dashboard') }}">🏠 Beranda</a>
        <a href="{{ route('karyawan.absensi.create') }}" class="active">📍 Absensi</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        Hi, {{ $karyawan->nama_karyawan }} 👋
    </div>

    <div class="container">

        <div class="card">
            <h2 style="margin-top:0;color:#1f6cff;">Absensi Hari Ini</h2>

            @if ($errors->any())
                <div class="alert">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

<form action="{{ route('karyawan.absensi.store') }}" method="POST">
    @csrf

    <input type="hidden" name="id_karyawan" value="{{ $karyawan->id_karyawan }}">

    <div class="mb-2">
        <label>Nama</label>
        <input type="text" class="form-control"
               value="{{ $karyawan->nama_karyawan }}" readonly>
    </div>

    <div class="mb-2">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Status</label>
        <select name="status_kehadiran" class="form-control">
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Alpha">Alpa</option>
        </select>
    </div>

    <button class="btn btn-primary">Absen</button>
</form>
        </div>

    </div>
</div>

</body>
</html>
