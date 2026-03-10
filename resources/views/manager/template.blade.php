<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Manager</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display.css" rel="stylesheet">

    <style>
        body {
            background: #FFF5F5;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #9B1C20;
            color: white;
            display: flex;
            flex-direction: column;
        }

        /* Brand/Logo */
        .sidebar-brand {
            padding: 20px;
            font-size: 20px;
            font-weight: 700;
            color: white;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand i {
            margin-right: 10px;
        }

        /* Menu Container */
        .sidebar-menu {
            flex: 1;
            padding: 15px 0;
        }

        /* Menu Items */
        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 4px 12px;
            font-size: 14px;
            font-weight: 400;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
        }

        /* Hover State */
        .sidebar a:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        /* Active/Clicked State - BACKGROUND PUTIH, TEKS MERAH */
        .sidebar a.active {
            background: #FFFFFF;
            color: #9B1C20;
            font-weight: 500;
        }

        .sidebar a.active i {
            color: #9B1C20;
        }

        .sidebar a.active:hover {
            background: #FFFFFF;
            color: #9B1C20;
        }

        /* Logout Section */
        .sidebar-logout {
            padding: 15px 0;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            margin-left: 250px;
            background: #9B1C20;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            color: white;
            padding: 15px 25px;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
        }

        .navbar-text {
            color: white;
        }

        .navbar-text i {
            margin-right: 8px;
        }

        /* CARD DASHBOARD */
        .card-dashboard {
            background: #FFFFFF;
            border-radius: 10px;
            border: none;
            border-left: 4px solid;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-dashboard:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        }

        .card-dashboard .card-body {
            padding: 20px;
        }

        .card-dashboard h6 {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .card-dashboard h3 {
            font-size: 28px;
            color: #333;
            margin-bottom: 0;
        }

        .border-primary { border-left-color: #0d6efd !important; }
        .border-warning { border-left-color: #ffc107 !important; }
        .border-success { border-left-color: #198754 !important; }
        .border-danger { border-left-color: #dc3545 !important; }
        .border-secondary { border-left-color: #6c757d !important; }
        .border-info { border-left-color: #0dcaf0 !important; }
        .border-dark { border-left-color: #212529 !important; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
        <i class="bi bi-person-circle"></i> SmartGaji
    </div>

    <!-- Menu -->
    <div class="sidebar-menu">
        <a href="{{ route('manager.dashboard') }}" class="{{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('manager.karyawan') }}" class="{{ request()->routeIs('manager.karyawan') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Data Karyawan
        </a>
        <a href="{{ route('manager.cuti') }}" class="{{ request()->routeIs('manager.cuti') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Persetujuan Cuti
        </a>
        <a href="{{ route('manager.overtime') }}" class="{{ request()->routeIs('manager.overtime') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Persetujuan Lembur
        </a>
        <a href="{{ route('manager.laporan') }}" class="{{ request()->routeIs('manager.laporan') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Laporan
        </a>
    </div>

    <!-- Logout -->
    <div class="sidebar-logout">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-power"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

{{-- <!-- NAVBAR -->
<nav class="navbar">
    <div class="container-fluid">
        <span class="navbar-brand">Manager Panel</span>
        <div class="ms-auto">
            <span class="navbar-text">
                <i class="bi bi-person-circle"></i>
                {{ Auth::user()->nama }}
            </span>
        </div>
    </div>
</nav> --}}

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
