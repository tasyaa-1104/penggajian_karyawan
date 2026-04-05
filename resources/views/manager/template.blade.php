<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Manager</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Bootstrap -->


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    background:#FFF5F5;
    font-family:'Inter',sans-serif;
    margin:0;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:#9B1C20;
    color:white;
    display:flex;
    flex-direction:column;
}

.sidebar-brand{
    padding:20px;
    font-size:20px;
    font-weight:700;
    text-align:center;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.sidebar-brand i{
    font-size: 28px;
    color: white;
    margin-right: 8px;    /* ← Ditambahkan jarak */
}

.sidebar-menu{
    flex:1;
    padding:15px 0;
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 20px;
    margin:4px 12px;
    font-size:14px;
    border-radius:8px;
}

.sidebar a i{
    margin-right:10px;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.15);
}

.sidebar a.active{
    background:white;
    color:#9B1C20;
    font-weight:500;
}

.sidebar a.active i{
    color:#9B1C20;
}

/* BADGE NOTIF */
.badge-notif{
    background:#ff4d4f;
    font-size:11px;
    padding:3px 7px;
    border-radius:10px;
}

/* CONTENT */
.content{
    margin-left:250px;
    padding:25px;
}

/* LOGOUT */
.sidebar-logout{
    padding:15px 0;
    border-top:1px solid rgba(255,255,255,0.1);
}

</style>
</head>

<body>
{{--
<!-- SIDEBAR -->
<div class="sidebar">

<div class="sidebar-brand">
<i class="bi bi-person-circle"></i> SmartGaji
</div> --}}
<!-- SIDEBAR -->
<div class="sidebar">

<div class="sidebar-brand">
<i class="bi bi-cash-stack"></i>SmartGaji
</div>

<div class="sidebar-menu">

<a href="{{ route('manager.dashboard') }}"
class="{{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
<span><i class="bi bi-grid-1x2-fill"></i> Dashboard</span>
</a>

<a href="{{ route('manager.karyawan') }}"
class="{{ request()->routeIs('manager.karyawan') ? 'active' : '' }}">
<span><i class="bi bi-people-fill"></i> Data Karyawan</span>
</a>

<a href="{{ route('manager.cuti') }}"
class="{{ request()->routeIs('manager.cuti') ? 'active' : '' }}">
<span><i class="bi bi-calendar-check"></i> Persetujuan Cuti</span>
</a>

<a href="{{ route('manager.overtime') }}"
class="{{ request()->routeIs('manager.overtime') ? 'active' : '' }}">
<span><i class="bi bi-clock-history"></i> Persetujuan Lembur</span>
</a>

<a href="{{ route('manager.izin') }}"
class="{{ request()->routeIs('manager.izin') ? 'active' : '' }}">
<span>
<i class="bi bi-file-earmark-text"></i> Persetujuan Izin & Sakit
</span>

@if(($total_notif ?? 0) > 0)
<span class="badge-notif">{{ $total_notif }}</span>
@endif

</a>

{{-- <a href="{{ route('manager.sakit') }}"
class="{{ request()->routeIs('manager.sakit') ? 'active' : '' }}">
<span>
<i class="bi bi-heart-pulse"></i> Persetujuan Sakit
</span> --}}
{{-- 
@if(($sakit_pending ?? 0) > 0)
<span class="badge-notif">{{ $sakit_pending }}</span>
@endif

</a> --}}

<a href="{{ route('manager.laporan') }}"
class="{{ request()->routeIs('manager.laporan') ? 'active' : '' }}">
<span><i class="bi bi-file-earmark-text"></i> Laporan</span>
</a>

</div>
{{--
<!-- LOGOUT -->
<div class="sidebar-logout">
<a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
<i class="bi bi-power"></i> Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
</div> --}}
<!-- LOGOUT -->
<div class="sidebar-logout">
<a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
<span><i class="bi bi-power"></i> Logout</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
</div>
</div>

<!-- CONTENT -->
<div class="content">
@yield('content')
</div>

<!-- Bootstrap JS agar tab bisa diklik -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

</body>
</html>
