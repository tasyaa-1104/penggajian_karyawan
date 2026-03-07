<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manager Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#1f2d3d;
            color:white;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 20px;
            transition:0.3s;
        }

        .sidebar a:hover{
            background:#3c8dbc;
        }

        .content{
            margin-left:250px;
            padding:20px;
        }

        .navbar{
            margin-left:250px;
            background:white;
            box-shadow:0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h4 class="text-center py-3 border-bottom">Manager</h4>

    <a href="{{ route('manager.dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

  <li>
<a href="{{ route('manager.karyawan') }}">
Data Karyawan
</a>
</li>
    <a href="#">
        <i class="bi bi-calendar-check"></i> Persetujuan Cuti
    </a>
    <a href="{{ route('manager.overtime') }}">
    <i class="bi bi-clock-history"></i> Persetujuan Lembur
</a>

   <li>
<a href="{{ route('manager.laporan') }}">
Laporan
</a>
</li>

    <hr>

    <a href="{{ route('logout') }}">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4 py-2">
    <div class="container-fluid">

        <span class="navbar-brand fw-bold">Manager Panel</span>

        <div class="ms-auto">
            <span class="fw-semibold">
                <i class="bi bi-person-circle"></i>
                {{ Auth::user()->nama }}
            </span>
        </div>

    </div>
</nav>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
