<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Finance Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* --- CSS TEMA MAROON & ANIMASI --- */
        :root {
            --maroon-primary: #800000;   /* Warna Maroon Utama */
            --maroon-mid: #5d1010;       /* Warna Tengah */
            --maroon-dark: #3e2723;      /* Warna Coklat Tua (Bawah) */
            --text-white: #ffffff;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .container-fluid {
            flex-grow: 1;
            display: flex;
            padding: 0;
        }

        .row {
            flex-grow: 1;
            margin: 0;
            width: 100%;
        }

        /* =========================================
           SIDEBAR BARU (GRADASI & ANIMASI AWAN)
           ========================================= */

        .sidebar-maroon {
            /* 1. Background Gradasi Maroon ke Coklat Tua */
            background: linear-gradient(180deg, var(--maroon-primary) 0%, var(--maroon-mid) 50%, var(--maroon-dark) 100%) !important;

            color: white;
            display: flex;
            flex-direction: column;
            height: 100vh;

            /* Ukuran Tetap */
            width: var(--sidebar-width) !important;
            max-width: var(--sidebar-width) !important;
            min-width: var(--sidebar-width) !important;
            flex-shrink: 0;

            /* Fixed positioning seperti HRD */
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);

            /* Transisi slide seperti HRD */
            transition: left 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);

            /* Penting: Agar elemen animasi background tidak keluar */
            overflow: hidden;
        }

        /* --- 2. EFEK AWAN GELOMBANG (Latar Belakang Bergerak) --- */

        /* Lapisan Gelombang 1 */
        .sidebar-maroon::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 200%; /* Lebar ganda untuk pergerakan mulus */
            height: 100%;
            /* Menggunakan SVG gelombang yang sama, diulang vertikal */
            background-image: url("https://svgshare.com/i/uYk.svg");
            background-size: 50% 150px; /* Potongan vertikal */
            background-repeat: repeat-y;
            opacity: 0.05; /* Sangat transparan seperti kabut */
            animation: waveFlowUp 20s linear infinite;
            z-index: 0; /* Di belakang konten */
            pointer-events: none;
        }

        /* Lapisan Gelombang 2 (Berlawanan arah/speed untuk kedalaman) */
        .sidebar-maroon::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 200%;
            height: 100%;
            background-image: url("https://svgshare.com/i/uYk.svg");
            background-size: 50% 200px; /* Potongan lebih besar */
            background-repeat: repeat-y;
            opacity: 0.03;
            animation: waveFlowDown 25s linear infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes waveFlowUp {
            0% { transform: translateY(0); }
            100% { transform: translateY(-150px); }
        }

        @keyframes waveFlowDown {
            0% { transform: translateY(-150px); }
            100% { transform: translateY(0); }
        }

        /* --- User Info --- */
        .sidebar-user-info {
            padding: 40px 20px 30px 20px;
            text-align: center;
            /* Background semi-transparan agar teks terbaca di atas gelombang */
            background: rgba(0,0,0,0.1);
            backdrop-filter: blur(2px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: relative;
            z-index: 2; /* Di atas gelombang */
        }

        .sidebar-user-info i {
            font-size: 4rem;
            margin-bottom: 15px;
            opacity: 0.9;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
            transition: transform 0.4s ease;
            /* Animasi melayang */
            animation: floatIcon 3s ease-in-out infinite;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .sidebar-user-info:hover i {
            transform: scale(1.1) rotate(5deg);
            animation: none; /* Hentikan float saat hover agar interaksi lebih responsif */
        }

        .sidebar-user-info h5 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.2rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .sidebar-user-info small {
            opacity: 0.7;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* --- Menu Container --- */
        .sidebar-menu {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 5px; /* Space untuk scrollbar internal jika ada */
        }

        .sidebar-menu-title {
            color: rgba(255,255,255,0.6);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            margin: 25px 0 10px 20px;
            letter-spacing: 1px;
        }

        /* --- Animasi Masuk Menu (Staggered) --- */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .nav-item {
            opacity: 0; /* Mulai tersembunyi */
            animation: slideInLeft 0.5s ease-out forwards;
        }

        /* Delay berbeda untuk setiap item */
        .nav-item:nth-child(1) { animation-delay: 0.2s; }
        .nav-item:nth-child(2) { animation-delay: 0.3s; }
        .nav-item:nth-child(3) { animation-delay: 0.4s; }
        .nav-item:nth-child(4) { animation-delay: 0.5s; }

        /* Styling Link Sidebar */
        .nav-link-custom {
            color: rgba(255,255,255,0.9);
            border-radius: 8px;
            margin-bottom: 8px;
            padding: 14px 25px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            font-weight: 500;
            border-left: 4px solid transparent;
            position: relative;
            z-index: 2;
        }

        .nav-link-custom:hover {
            background-color: rgba(255,255,255,0.15); /* Sedikit transparan */
            color: white;
            text-decoration: none;
            transform: translateX(5px);
            border-left: 4px solid #ffcccc;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2); /* Efek melayang saat hover */
        }

        .nav-link-custom i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-link-custom:hover i {
            transform: scale(1.3) rotate(10deg);
            color: #fff;
            text-shadow: 0 0 10px rgba(255,255,255,0.5); /* Efek Glow Ikon */
        }

        /* --- Content Area --- */
        .content-area {
            background-color: #f8f9fa;
            height: 100vh;
            overflow-y: auto;
            position: relative;

            /* Margin kiri agar tidak tertutup sidebar fixed */
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));

            /* Transisi seperti HRD */
            transition: margin-left 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .content-area::-webkit-scrollbar { width: 8px; }
        .content-area::-webkit-scrollbar-track { background: #f1f1f1; }
        .content-area::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        .content-area::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

        /* =========================================
           TOGGLE BUTTON MOBILE (Seperti HRD)
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
           RESPONSIF (Pola HRD: slide sidebar)
           ========================================= */
        @media (max-width: 991px) {
            .sidebar-maroon {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }

            .sidebar-maroon.active {
                left: 0;
                box-shadow: 10px 0 50px rgba(0,0,0,0.5);
            }

            .content-area {
                margin-left: 0;
                width: 100%;
            }

            .mobile-toggle {
                display: block;
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

<!-- TIDAK ADA NAVBAR DI ATAS -->

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR (Berisi User Info + Menu + Logout) -->
        <div class="col-md-2 sidebar-maroon shadow-sm" id="sidebar">

            <!-- 1. USER INFO -->
            <div class="sidebar-user-info">
                <i class="fas fa-user-circle"></i>
                <h5>{{ Auth::user()->nama }}</h5>
            </div>

            <!-- 2. MENU -->
            <div class="sidebar-menu">
                <ul class="nav flex-column px-2">

                    <!-- Dashboard -->
                    <li class="nav-item mb-2">
                        <a href="{{ route('finance.dashboard') }}" class="nav-link-custom">
                            <i class="fas fa-home"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Tunjangan -->
                    <li class="nav-item mb-2">
                        <a href="{{route('tunjangan.index')}}" class="nav-link-custom">
                            <i class="fas fa-hand-holding-usd"></i> <span>Tunjangan</span>
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="{{route('finance.karyawan')}}" class="nav-link-custom">
                            <i class="fas fa-user"></i> <span>Karyawan</span>
                        </a>
                    </li>

                    <!-- Gaji -->
                    <li class="nav-item mb-2">
                        <a href="{{route('gaji.index')}}" class="nav-link-custom">
                            <i class="fas fa-money-bill-wave"></i> <span>Gaji</span>
                        </a>
                    </li>

                </ul>
            </div>

            <!-- 3. LOGOUT (Di Paling Bawah) -->
            <div class="mt-auto pb-4 px-2 sidebar-logout" style="position: relative; z-index: 2;">
                <a href="{{ route('logout') }}" class="nav-link-custom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </a>

                <!-- Form Logout Tersembunyi -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

        </div>

        <!-- CONTENT (Tanpa Navbar, Konten langsung mulai) -->
        <div class="col-md-10 content-area p-4">
            @yield('content')
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
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
