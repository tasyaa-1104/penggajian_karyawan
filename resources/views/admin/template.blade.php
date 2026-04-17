<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penggajian</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ================= 1. SETUP WARNA (MAROON ELEGAN) ================= */
        :root {
            --primary-maroon: #800000;   /* Maroon Utama */
            --dark-maroon: #5c0000;      /* Maroon Gelap (Background Atas) */
            --light-maroon: #a52a2a;     /* Aksen */
            --text-white: #ffffff;
            --text-gray: #e2e8f0;
            --active-bg: #ffffff;
            --active-text: #800000;
            --sidebar-width: 260px;
        }

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
            background-color: #F8FAFC; /* Background konten utama tetap bersih */
            color: #1F2937;
        }

        /* ================= 2. SIDEBAR UTAMA ================= */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            /* Gradasi Maroon Mewah */
            background: linear-gradient(180deg, var(--dark-maroon) 0%, var(--primary-maroon) 60%, #4a0000 100%);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 5px 0 25px rgba(128, 0, 0, 0.2); /* Bayangan Merah Halus */
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
        }

        /* Scrollbar kustom */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
        }

        /* Header Sidebar */
        .sidebar h4 {
            padding: 30px 20px;
            margin: 0;
            font-weight: 700;
            text-align: center;
            color: var(--text-white);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            position: relative;
            z-index: 5;
            background: transparent;
            letter-spacing: 0.5px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar h4 i {
            color: #ffcccc;
            animation: floatIcon 3s ease-in-out infinite;
            font-size: 28px;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        /* Navigasi */
        .sidebar ul.nav {
            padding: 25px 15px;
            margin: 0;
            position: relative;
            z-index: 5;
            flex-grow: 1; /* Mengisi ruang kosong */
        }

        .sidebar .nav-item {
            opacity: 0;
            animation: slideInFade 0.5s ease forwards;
            margin-bottom: 6px;
        }

        /* Delay Animasi Menu */
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
        .sidebar .nav-item:nth-child(11) { animation-delay: 0.6s; } /* Logout */

        @keyframes slideInFade {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Link Style */
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            padding: 14px 16px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-size: 0.95rem;
        }

        /* Garis Indikator Kiri */
        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 4px;
            height: 0%;
            background-color: #ffcccc;
            border-radius: 0 4px 4px 0;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #ffcccc;
        }

        .sidebar .nav-link i {
            width: 22px;
            text-align: center;
            transition: transform 0.3s ease;
            font-size: 1.05em;
            color: #ffcccc;
        }

        /* Hover State */
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            transform: translateX(6px);
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.1);
        }

        .sidebar .nav-link:hover::before {
            height: 70%;
            transform: translateY(-50%) scaleY(1);
        }

        /* Active State (Menu Terpilih) */
        .sidebar .nav-link.active {
            background: #fff;
            color: var(--primary-maroon);
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateX(6px);
        }

        .sidebar .nav-link.active i {
            color: var(--primary-maroon);
            transform: translateX(-2px); /* Sedikit geser ke kiri agar rapi */
        }

        .sidebar .nav-link.active::before {
            background-color: var(--primary-maroon);
            height: 80%;
            transform: translateY(-50%) scaleY(1);
        }

        /* ================= 3. LOGOUT STYLE KHUSUS ================= */
        .sidebar-logout {
            margin-top: auto; /* Dorong ke bawah sebelum gelombang */
            padding: 0 15px 20px 15px;
            position: relative;
            z-index: 5;
        }

        .sidebar .nav-link.logout-link {
            background: rgba(220, 38, 38, 0.15); /* Merah transparan */
            color: #ffcccc;
            border: 1px solid rgba(255, 100, 100, 0.2);
        }

        .sidebar .nav-link.logout-link:hover {
            background: #ef4444;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }

        .sidebar .nav-link.logout-link i {
            color: #ff9999;
        }

        /* ================= 4. GELOMBANG ANIMATION (RED THEME) ================= */
        .wave-container {
            pointer-events: none;
            position: absolute;
            bottom: -10px; /* Sedikit overlap ke bawah */
            left: 0;
            width: 100%;
            height: 120px;
            z-index: 4; /* Di bawah menu logout */
            opacity: 0.6;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 100%;
            /* SVG Putih Transparan agar terlihat elegan di background merah */
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800v-.2-31.6z' fill='%23ffffff' fill-opacity='0.1'/%3E%3C/svg%3E");
            background-size: 50% 100%;
            animation: waveMove 12s linear infinite;
        }

        .wave:nth-of-type(2) {
            bottom: 10px;
            opacity: 0.5;
            animation: waveMove 15s linear infinite reverse;
        }

        .wave:nth-of-type(3) {
            bottom: 20px;
            opacity: 0.3;
            animation: waveMove 20s linear infinite;
        }

        @keyframes waveMove {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ================= MAIN CONTENT WRAPPER ================= */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
            transition: margin-left 0.4s ease, width 0.4s ease;
            background-color: #f3f4f6;
        }

        .content {
            padding: 30px;
        }

        /* Toggle Button Mobile */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
            background: var(--primary-maroon);
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
            background: var(--dark-maroon);
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none; /* Hilangkan shadow di mobile saat tutup */
            }
            .sidebar.active {
                left: 0;
                box-shadow: 10px 0 50px rgba(0,0,0,0.5);
            }
            .main-wrapper { margin-left: 0; width: 100%; }
            .mobile-toggle { display: block; }
        }
    </style>
</head>

<body>

<!-- Tombol Toggle Mobile -->
<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

{{-- SIDEBAR --}}
<nav class="sidebar" id="sidebar">
    <!-- Header Brand -->
    <h4>
        <i class="bi bi-cash-stack"></i>
        <span>SmartGaji</span>
    </h4>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('user.list') }}"
               class="nav-link {{ request()->routeIs('user.list*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-gear"></i> User
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('karyawan') }}"
               class="nav-link {{ request()->routeIs('karyawan*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-group"></i> Karyawan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('divisi.index') }}"
               class="nav-link {{ request()->routeIs('divisi*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i> Divisi
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
                <i class="fa-solid fa-calendar-day"></i> Absensi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rekap-absensi.index') }}"
               class="nav-link {{ request()->routeIs('rekap-absensi*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-contract"></i> Rekap Absensi
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('tunjangan.index') }}"
               class="nav-link {{ request()->routeIs('tunjangan*') ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-dollar"></i> Tunjangan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('gaji.index') }}"
               class="nav-link {{ request()->routeIs('gaji*') ? 'active' : '' }}">
                <i class="fa-solid fa-sack-dollar"></i> Gaji
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('overtime.index') }}"
               class="nav-link {{ request()->routeIs('overtime*') ? 'active' : '' }}">
                <i class="fa-regular fa-clock"></i> Overtime
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.cuti') }}"
               class="nav-link {{ request()->routeIs('admin.cuti*') ? 'active' : '' }}">
                <i class="fa-solid fa-plane-departure"></i> Pengajuan Cuti
            </a>
        </li>

         {{-- <li class="nav-item">
            <a href="{{ route('login') }}"
               class="nav-link {{ request()->routeIs('login*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-lock"></i> Login
            </a>
        </li> --}}
    </ul> <!-- Akhir Menu Utama -->

    <!-- MENU LOGOUT (Ditaruh di bawah) -->
    <div class="sidebar-logout">
        <li class="nav-item" style="list-style: none;">
            <!-- Mengarah ke route logout -->
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                @csrf
                <!-- Menggunakan button yang didesain seperti link agar lebih aman (POST request) -->
                <button type="submit" class="nav-link logout-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </li>
    </div>

    <!-- 🌊 GELOMBANG ELEGAN -->
    <div class="wave-container">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</nav>

{{-- MAIN CONTENT --}}
<div class="main-wrapper">
    <div class="content">
        @yield('content')
    </div>
</div>

<!-- Overlay Mobile -->
<div id="sidebarOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:999; backdrop-filter: blur(3px);" onclick="toggleSidebar()"></div>

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
            sidebar.classList.remove('active'); // Reset saat desktop
        }
    });
</script>
</body>
</html>
