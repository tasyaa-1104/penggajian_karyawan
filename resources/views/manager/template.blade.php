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

<!-- Font (UPGRADE) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --maroon-primary: #800000;
    --maroon-mid: #5d1010;
    --maroon-dark: #3e2723;
    --sidebar-width: 270px;
}

/* BODY */
body{
    background:#f8f9fa;
    font-family:'Poppins',sans-serif;
    margin:0;
}

/* SIDEBAR */
.sidebar{
    width: var(--sidebar-width);
    height:100vh;
    position:fixed;
    left: 0;
    top: 0;
    background: linear-gradient(180deg, var(--maroon-primary) 0%, var(--maroon-mid) 50%, var(--maroon-dark) 100%);
    color:white;
    display:flex;
    flex-direction:column;
    overflow:hidden;
    z-index: 1000;
    box-shadow: 4px 0 15px rgba(0,0,0,0.2);
    transition: left 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* ANIMATION BG */
.sidebar::before{
    content:"";
    position:absolute;
    width:200%;
    height:100%;
    background-image:url("https://svgshare.com/i/uYk.svg");
    background-size:50% 150px;
    background-repeat:repeat-y;
    opacity:0.05;
    animation:waveUp 20s linear infinite;
}

.sidebar::after{
    content:"";
    position:absolute;
    width:200%;
    height:100%;
    background-image:url("https://svgshare.com/i/uYk.svg");
    background-size:50% 200px;
    background-repeat:repeat-y;
    opacity:0.03;
    animation:waveDown 25s linear infinite;
}

@keyframes waveUp {
    0%{transform:translateY(0);}
    100%{transform:translateY(-150px);}
}

@keyframes waveDown {
    0%{transform:translateY(-150px);}
    100%{transform:translateY(0);}
}

/* BRAND */
.sidebar-brand{
    padding:28px 20px;
    font-size:22px;
    font-weight:700;
    text-align:center;
    letter-spacing:0.5px;
    border-bottom:1px solid rgba(255,255,255,0.1);
    position:relative;
    z-index:2;
}

.sidebar-brand i{
    font-size:30px;
    margin-right:8px;
}

/* MENU */
.sidebar-menu{
    flex:1;
    padding:25px 12px;
    position:relative;
    z-index:2;
}

/* LINK */
.sidebar a{
    color:rgba(255,255,255,0.9);
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px 20px;
    margin:8px 8px;
    font-size:15px;
    font-weight:500;
    border-radius:10px;
    transition:all 0.3s ease;
}

/* ICON kiri */
.sidebar a span{
    display:flex;
    align-items:center;
    gap:12px;
}

/* HOVER */
.sidebar a:hover{
    background:rgba(255,255,255,0.18);
    transform:translateX(6px);
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
}

/* ACTIVE */
.sidebar a.active{
    background:white;
    color:#800000;
    font-weight:600;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

/* ICON */
.sidebar a i{
    font-size:17px;
    transition:0.3s;
}

.sidebar a:hover i{
    transform:scale(1.25) rotate(5deg);
}

/* BADGE */
.badge-notif{
    background:#ff4d4f;
    font-size:11px;
    padding:4px 8px;
    border-radius:20px;
    font-weight:600;
}

/* CONTENT */
.content{
    margin-left: var(--sidebar-width);
    padding:30px;
    width: calc(100% - var(--sidebar-width));
    min-height: 100vh;
    transition: margin-left 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* LOGOUT */
.sidebar-logout{
    padding:18px;
    border-top:1px solid rgba(255,255,255,0.1);
    position:relative;
    z-index:2;
}

/* =========================================
   TOGGLE BUTTON MOBILE
   ========================================= */
.mobile-toggle {
    display: none;
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1100;
    background: var(--maroon-primary);
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(128, 0, 0, 0.3);
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s;
}

.mobile-toggle:hover {
    background: var(--maroon-dark);
    transform: scale(1.05);
}

/* =========================================
   RESPONSIF
   ========================================= */
@media (max-width: 991px) {
    .sidebar {
        left: calc(-1 * var(--sidebar-width));
        box-shadow: none;
    }

    .sidebar.active {
        left: 0;
        box-shadow: 10px 0 50px rgba(0,0,0,0.5);
    }

    .content {
        margin-left: 0;
        width: 100%;
    }

    .mobile-toggle {
        display: block;
    }
}

@media (max-width: 575px) {
    .mobile-toggle {
        top: 12px;
        right: 12px;
        padding: 10px 14px;
        font-size: 1rem;
        border-radius: 6px;
    }

    .content {
        padding: 12px;
        padding-top: 60px;
    }
}
</style>
</head>

<body>

<!-- Tombol Toggle Mobile -->
<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Overlay Mobile -->
<div id="sidebarOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:999; backdrop-filter: blur(3px);" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <i class="bi bi-cash-stack"></i> SmartGaji
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
            <span>
                <i class="bi bi-calendar-check"></i> Persetujuan Cuti
            </span>

            @if(($cuti_pending ?? 0) > 0)
                <span class="badge-notif">{{ $cuti_pending }}</span>
            @endif
        </a>

        <a href="{{ route('manager.overtime') }}"
        class="{{ request()->routeIs('manager.overtime') ? 'active' : '' }}">
            <span>
                <i class="bi bi-clock-history"></i> Persetujuan Lembur
            </span>

            @if(($lembur_pending ?? 0) > 0)
                <span class="badge-notif">{{ $lembur_pending }}</span>
            @endif
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

    </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('active');

        if (window.innerWidth <= 991) {
            if (sidebar.classList.contains('active')) {
                overlay.style.display = 'block';
            } else {
                overlay.style.display = 'none';
            }
        }
    }

    window.addEventListener('resize', function() {
        const overlay = document.getElementById('sidebarOverlay');
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth > 991) {
            overlay.style.display = 'none';
            sidebar.classList.remove('active');
        }
    });
</script>

</body>
</html>
