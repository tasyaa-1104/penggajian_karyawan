<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Karyawan')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* TEMA BIRU MUDA & CYAN */
            --primary-gradient: linear-gradient(160deg, #4FACFE 0%, #00F2FE 100%);
            --sidebar-width: 280px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f9ff;
            color: #334155;
            overflow-x: hidden;
        }

        /* --- SIDEBAR (Container Utama) --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;

            background: var(--primary-gradient);
            box-shadow: 5px 0 30px rgba(79, 172, 254, 0.25);

            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);

            /* Penting: Supaya gelombang & gelembung tidak keluar */
            overflow: hidden;
        }

        /* --- GELEMBUNG (BUBBLES) --- */
        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            bottom: -20px;
            pointer-events: none; /* Klik tembus ke menu */
            z-index: 1;
            animation: rise 10s infinite ease-in;
        }

        /* Ukuran & Posisi Random (Diatur inline di HTML) */
        .b1 { width: 20px; height: 20px; left: 20%; animation-duration: 8s; animation-delay: 0s; }
        .b2 { width: 40px; height: 40px; left: 40%; animation-duration: 12s; animation-delay: 2s; }
        .b3 { width: 15px; height: 15px; left: 70%; animation-duration: 6s; animation-delay: 4s; }
        .b4 { width: 25px; height: 25px; left: 85%; animation-duration: 9s; animation-delay: 1s; }
        .b5 { width: 35px; height: 35px; left: 10%; animation-duration: 11s; animation-delay: 3s; }

        @keyframes rise {
            0% { bottom: -50px; transform: translateX(0) scale(1); opacity: 0; }
            50% { opacity: 0.8; }
            100% { bottom: 110%; transform: translateX(-50px) scale(1.2); opacity: 0; }
        }

        /* --- HEADER SIDEBAR --- */
        .sidebar-header {
            padding: 30px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            position: relative;
            z-index: 5; /* Di atas gelombang */
        }

        .brand-circle {
            width: 45px; height: 45px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: floatLogo 3s ease-in-out infinite;
        }

        .brand-name {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* --- MENU --- */
        .sidebar ul {
            list-style: none;
            padding: 30px 20px;
            margin: 0;
            flex-grow: 1;
            z-index: 5;
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
            transition: transform 0.3s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.25);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .nav-link:hover i { transform: scale(1.2) rotate(5deg); }

        .nav-link.active {
            background: white;
            color: #0ea5e9;
            font-weight: 700;
            border-left: 5px solid #0ea5e9;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .nav-link.active i { color: #0ea5e9; }

        .nav-link.text-danger:hover {
            background: rgba(255,255,255,0.3);
            color: #ef4444;
        }

        /* --- WAVE ANIMATION CSS (Bottom & Top) --- */
        .wave-container {
            position: absolute;
            width: 100%;
            height: 150px;
            overflow: hidden;
            z-index: 2;
            pointer-events: none;
        }

        /* Gelombang Bawah */
        .wave-bottom { bottom: 0; transform: rotate(180deg); }
        /* Gelombang Atas */
        .wave-top { top: -20px; transform: rotate(0deg); }

        .wave {
            position: absolute;
            width: 200%;
            height: 100%;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800z' fill='rgba(255,255,255,0.4)'/%3E%3C/svg%3E");
            background-size: 50% 100%;
            animation: moveWave 12s linear infinite;
        }

        /* Variasi Kecepatan & Transparansi */
        .wave:nth-child(1) { opacity: 0.4; animation-duration: 12s; }
        .wave:nth-child(2) { bottom: 8px; opacity: 0.2; animation-duration: 9s; animation-direction: reverse; }
        .wave:nth-child(3) { bottom: 15px; opacity: 0.1; animation-duration: 15s; }

        @keyframes moveWave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes floatLogo {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* --- MAIN CONTENT --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            background-color: #f0f9ff;
            background-image:
                radial-gradient(at 0% 0%, rgba(255,255,255,0.8) 0, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.05) 0, transparent 50%);
            transition: margin-left 0.4s ease, width 0.4s ease;
            position: relative;
            z-index: 900;
        }
        .content { padding: 40px; max-width: 1400px; margin: 0 auto; }

        /* --- MOBILE TOGGLE --- */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 20px; right: 20px;
            width: 55px; height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4FACFE, #00F2FE);
            color: white; border: none; z-index: 1100;
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.5);
            cursor: pointer; transition: transform 0.2s; font-size: 1.3rem;
        }
        .mobile-toggle:active { transform: scale(0.9); }

        /* Overlay */
        #sidebarOverlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.3); backdrop-filter: blur(3px); z-index: 999;
        }

        /* Staggered Animation */
        .nav-item { opacity: 0; transform: translateX(-20px); animation: slideInLeft 0.5s forwards; }
        @keyframes slideInLeft { to { opacity: 1; transform: translateX(0); } }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); }
            .sidebar.active { left: 0; }
            .main-wrapper { margin-left: 0; width: 100%; padding-top: 80px; }
            .mobile-toggle { display: flex; align-items: center; justify-content: center; }
            .content { padding: 20px; }
        }
    </style>
</head>

<body>

<!-- TOGGLE MOBILE -->
<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- SIDEBAR -->
<nav class="sidebar" id="sidebar">

    <!-- GELOMBANG ATAS -->
    <div class="wave-container wave-top">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- ANIMASI GELEMBUNG (Bubble Effect) -->
    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="bubble b3"></div>
    <div class="bubble b4"></div>
    <div class="bubble b5"></div>

    <!-- Brand: KARYAWAN -->
    <div class="sidebar-header">
        <div class="brand-circle">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <h2 class="brand-name">Karyawan</h2>
    </div>

    <!-- Menu -->
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('karyawan.dashboard') }}"
               class="nav-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('karyawan.absensi.create') }}"
               class="nav-link {{ request()->routeIs('karyawan.absensi.create') ? 'active' : '' }}">
                <i class="fa-solid fa-fingerprint"></i>
                <span>Absensi</span>
            </a>
        </li>

        <li class="nav-item" style="margin-top: auto;"></li>

        <li class="nav-item mt-3">
            <a href="{{ route('login') }}" class="nav-link text-danger">
                <i class="fa-solid fa-power-off"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

    <!-- GELOMBANG BAWAH -->
    <div class="wave-container wave-bottom">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</nav>

<!-- OVERLAY -->
<div id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- MAIN WRAPPER -->
<div class="main-wrapper">
    <div class="content">
        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('active');
        overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    }

    // Script Staggered Animation
    document.addEventListener("DOMContentLoaded", () => {
        const items = document.querySelectorAll('.nav-item');
        items.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.15}s`;
        });
    });
</script>

</body>
</html>
