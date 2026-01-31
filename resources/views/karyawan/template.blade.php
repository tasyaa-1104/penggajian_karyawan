<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: #0d6efd;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255,255,255,0.2);
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .navbar {
            margin-left: 240px;
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar position-fixed">
    <h5 class="text-white text-center py-3 border-bottom">KARYAWAN</h5>

    <a href="{{ route('karyawan.dashboard') }}"
       class="{{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="#">
        Absensi
    </a>

    <a href="#">
        Rekap Absensi
    </a>

    <a href="#">
        Slip Gaji
    </a>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

{{-- TOP NAVBAR --}}
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <span class="navbar-text">
            Selamat datang, <strong>{{ auth()->user()->name ?? 'Karyawan' }}</strong>
        </span>
    </div>
</nav>

{{-- CONTENT --}}
<div class="content">
    @yield('content')
</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
