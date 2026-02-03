<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggajian</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ================= RESET GLOBAL ================= */
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
            color: #1F2937;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #3B82F6, #60A5FA); /* Warna dasar */
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
            overflow: hidden; /* Overflow hidden penting agar gelombang tidak pecah keluar */
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Scrollbar kustom */
        .sidebar::-webkit-scrollbar {
            width: 0px; /* Disembunyikan agar tampilan lebih bersih */
        }

        .sidebar h4 {
            padding: 24px 16px;
            margin: 0;
            font-weight: 600;
            text-align: center;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: relative;
            z-index: 2; /* Di atas gelombang */
            background: transparent;
        }

        .sidebar h4 i {
            margin-right: 8px;
            animation: spinIcon 10s linear infinite;
        }

        .sidebar ul.nav {
            padding: 20px 12px;
            margin: 0;
            position: relative;
            z-index: 2; /* Menu di atas gelombang */
            margin-bottom: 120px; /* Ruang untuk gelombang di bawah */
        }

        .sidebar .nav-item {
            opacity: 0;
            animation: slideInLeft 0.5s ease forwards;
        }

        /* Delay animasi menu */
        .sidebar .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .sidebar .nav-item:nth-child(2) { animation-delay: 0.15s; }
        .sidebar .nav-item:nth-child(3) { animation-delay: 0.2s; }
        .sidebar .nav-item:nth-child(4) { animation-delay: 0.25s; }
        .sidebar .nav-item:nth-child(5) { animation-delay: 0.3s; }
        .sidebar .nav-item:nth-child(6) { animation-delay: 0.35s; }
        .sidebar .nav-item:nth-child(7) { animation-delay: 0.4s; }
        .sidebar .nav-item:nth-child(8) { animation-delay: 0.45s; }
        .sidebar .nav-item:nth-child(9) { animation-delay: 0.5s; }
        .sidebar .nav-item:nth-child(10) { animation-delay: 0.55s; }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            font-weight: 500;
            padding: 12px 14px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 4px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 4px;
            height: 70%;
            background-color: #fff;
            border-radius: 0 4px 4px 0;
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
            font-size: 1.1em;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .sidebar .nav-link:hover::before {
            transform: translateY(-50%) scaleY(1);
        }

        .sidebar .nav-link.active {
            background: #fff;
            color: #3B82F6;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active::before {
            transform: translateY(-50%) scaleY(1);
            background-color: #3B82F6;
        }

        .sidebar .nav-link.text-danger {
            color: #FFE4E6 !important;
        }
        .sidebar .nav-link.text-danger:hover {
            background: rgba(220,38,38,0.2);
            color: #fff !important;
        }
        .sidebar .nav-link.text-danger:hover::before {
            background-color: #ef4444;
        }

        /* ================= WAVE ANIMATION ================= */
        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Tinggi area gelombang */
            z-index: 1;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%; /* Lebar 200% untuk efek sliding */
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800v-.2-31.6z' fill='%23ffffff' fill-opacity='0.1'/%3E%3C/svg%3E");
            background-size: 50% 100%;
            animation: wave 10s linear infinite;
        }

        .wave:nth-of-type(2) {
            bottom: 5px;
            opacity: 0.5;
            animation: wave 8s linear infinite reverse; /* Berlawanan arah */
        }

        .wave:nth-of-type(3) {
            bottom: 10px;
            opacity: 0.7;
            animation: wave 6s linear infinite; /* Lebih cepat */
        }

        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ================= MAIN ================= */
        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            width: calc(100% - 250px);
            transition: margin-left 0.4s ease, width 0.4s ease;
        }

        .content {
            padding: 24px;
            margin: 0;
        }

        .mobile-toggle {
            display: none;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1100;
            background: #3B82F6;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4);
            cursor: pointer;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes spinIcon {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 991px) {
            .sidebar { left: -260px; }
            .sidebar.active { left: 0; }
            .main-wrapper { margin-left: 0; width: 100%; }
            .mobile-toggle { display: block; }
        }
    </style>
</head>

<body>

<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

{{-- SIDEBAR --}}
<nav class="sidebar" id="sidebar">
    <h4>
        <i class="fa-solid fa-money-check-dollar"></i> Penggajian
    </h4>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('user.list') }}"
               class="nav-link {{ request()->routeIs('user.list*') ? 'active' : '' }}">
                <i class="fa-solid fa-minus-circle"></i> User
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('karyawan') }}"
               class="nav-link {{ request()->routeIs('karyawan*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Karyawan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('divisi.index') }}"
               class="nav-link {{ request()->routeIs('divisi*') ? 'active' : '' }}">
                <i class="fa-solid fa-sitemap"></i> Divisi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('jabatan.index') }}"
               class="nav-link {{ request()->routeIs('jabatan*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-tie"></i> Jabatan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('absensi') }}"
               class="nav-link {{ request()->routeIs('absensi*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Absensi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rekap-absensi.index') }}"
               class="nav-link {{ request()->routeIs('rekap-absensi*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-list"></i> Rekap Absensi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('tunjangan.index') }}"
               class="nav-link {{ request()->routeIs('tunjangan*') ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-dollar"></i> Tunjangan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('gaji.index') }}"
               class="nav-link {{ request()->routeIs('gaji*') ? 'active' : '' }}">
                <i class="fa-solid fa-wallet"></i> Gaji
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="{{ route('login') }}" class="nav-link text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </li>

    </ul>

    <!-- EFEK GELOMBANG BARU -->
    <div class="wave-container">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</nav>

{{-- MAIN --}}
<div class="main-wrapper">
    <div class="content">
        @yield('content')
    </div>
</div>

<div id="sidebarOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;" onclick="toggleSidebar()"></div>

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
        if (window.innerWidth > 991) {
            overlay.style.display = 'none';
        }
    });
</script>
</body>
</html>
