<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        *{box-sizing:border-box;font-family:'Segoe UI',Tahoma,sans-serif;}
        body{margin:0;min-height:100vh;background:#f4f7fb;display:flex;}
        .sidebar{width:240px;background:#1f6cff;color:#fff;padding:24px 18px;}
        .sidebar h3{text-align:center;margin-bottom:30px;}
        .menu a{display:block;padding:12px 14px;margin-bottom:10px;color:#fff;text-decoration:none;border-radius:10px;font-weight:600;}
        .menu a.active,.menu a:hover{background:#114fc9;}
        .main{flex:1;display:flex;flex-direction:column;}
        .topbar{background:#fff;padding:16px 24px;box-shadow:0 4px 12px rgba(0,0,0,0.06);font-weight:600;}
        .container{max-width:520px;margin:40px auto;padding:0 16px;}
        .card{background:#fff;border-radius:14px;padding:24px;box-shadow:0 12px 28px rgba(0,0,0,0.08);text-align:center;}
        .btn{padding:14px;border:none;border-radius:10px;font-weight:600;cursor:pointer;width:100%;margin-bottom:12px;}
        .btn-success{background:#1f6cff;color:#fff;}
        .btn-danger{background:#e74c3c;color:#fff;}
        .btn-secondary{background:#ccc;color:#333;}
        .alert{padding:12px;border-radius:10px;margin-bottom:16px;}
        .alert-success{background:#e6fffa;color:#065f46;}
        .alert-danger{background:#ffe5e5;color:#b40000;}
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Karyawan</h3>
    <div class="menu">
        <a href="{{ route('karyawan.dashboard') }}">🏠 Beranda</a>
        <a href="{{ route('karyawan.absensi') }}" class="active">📍 Absensi</a>
    </div>
</div>

<div class="main">
    <div class="topbar">
        Hi, {{ $karyawan->nama_karyawan }} 👋
    </div>

    <div class="container">
        <div class="card">

            <h2 style="color:#1f6cff;margin-top:0">Absensi Hari Ini</h2>
            <p>{{ now()->format('d F Y') }}</p>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- LOGIKA TOMBOL --}}
            @if(!$absensiHariIni)
                {{-- BELUM ABSEN --}}
                <form action="{{ route('karyawan.absen.masuk') }}" method="POST">
                    @csrf
                    <button class="btn btn-success">✅ Absen Masuk</button>
                </form>

            @elseif($absensiHariIni && !$absensiHariIni->jam_pulang)
                {{-- SUDAH MASUK --}}
                <form action="{{ route('karyawan.absen.pulang') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">⏰ Absen Pulang</button>
                </form>

            @else
                {{-- SUDAH SELESAI --}}
                <button class="btn btn-secondary" disabled>
                    ✔ Absensi Hari Ini Selesai
                </button>
            @endif

        </div>
    </div>
</div>

</body>
</html>
