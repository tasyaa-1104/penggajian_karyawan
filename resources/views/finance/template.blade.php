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
            --maroon-dark: #5c0000;      /* Warna Hover */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            /* --- PERBAIKAN LAYOUT (Agar pas di layar, tidak scroll ganda) --- */
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        /* Container Fluid agar mengisi layar penuh */
        .container-fluid {
            flex-grow: 1;
            display: flex;
            padding: 0; /* Hapus padding default agar sidebar mentok pinggir */
        }

        /* Row agar mengisi tinggi container */
        .row {
            flex-grow: 1;
            margin: 0;
            width: 100%;
        }

        /* 2. Sidebar Maroon (Sekarang jadi pengganti Navbar utama) */
        .sidebar-maroon {
            background-color: var(--maroon-primary) !important;
            color: white;
            display: flex;
            flex-direction: column;
            height: 100%; /* Tinggi sidebar mengikuti layar */
        }

        /* Bagian User Info di Atas Sidebar */
        .sidebar-user-info {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background-color: rgba(0,0,0,0.1); /* Sedikit gelap */
        }

        .sidebar-user-info h5 {
            font-weight: 700;
            margin-bottom: 0;
            font-size: 1.1rem;
        }

        .sidebar-user-info small {
            opacity: 0.8;
            font-size: 0.8rem;
        }

        .sidebar-menu-title {
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            margin: 20px 0 10px 15px;
        }

        /* Styling Link Sidebar */
        .nav-link-custom {
            color: rgba(255,255,255,0.9);
            border-radius: 0 25px 25px 0;
            margin-bottom: 5px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        /* Efek Hover Sidebar */
        .nav-link-custom:hover {
            background-color: var(--maroon-dark);
            color: white;
            padding-left: 25px;
            text-decoration: none;
        }

        /* Animasi Ikon Sidebar */
        .nav-link-custom i {
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .nav-link-custom:hover i {
            transform: scale(1.3) rotate(10deg);
            color: #ffcccc;
        }

        /* Area Konten agar bisa discroll jika panjang */
        .content-area {
            background-color: #f8f9fa;
            height: 100vh;
            overflow-y: auto; /* Scroll hanya di konten, bukan sidebar */
        }
    </style>
</head>
<body>

<!-- TIDAK ADA NAVBAR DI ATAS -->

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR (Berisi User Info + Menu + Logout) -->
        <div class="col-md-2 sidebar-maroon shadow-sm">

            <!-- 1. USER INFO (Dipindah dari Navbar ke Sini) -->
            <div class="sidebar-user-info">
                <i class="fas fa-user-circle fa-3x mb-2 opacity-75"></i>
                <h5>{{ Auth::user()->nama }}</h5>
                <small>Administrator</small>
            </div>

            <!-- 2. MENU -->
            <div class="sidebar-menu-title">MENU FINANCE</div>

            <ul class="nav flex-column px-2 flex-grow-1">

                <!-- Dashboard -->
                <li class="nav-item mb-2">
                    <a href="{{ route('finance.dashboard') }}" class="nav-link-custom">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <!-- Tunjangan -->
                <li class="nav-item mb-2">
                    <a href="{{route('tunjangan.index')}}" class="nav-link-custom">
                        <i class="fas fa-hand-holding-usd"></i> Tunjangan
                    </a>
                </li>

                <!-- Gaji -->
                <li class="nav-item mb-2">
                    <a href="{{route('gaji.index')}}" class="nav-link-custom">
                        <i class="fas fa-money-bill-wave"></i> Gaji
                    </a>
                </li>

            </ul>

            <!-- 3. LOGOUT (Di Paling Bawah) -->
            <div class="mt-auto pb-4 px-2">
                <a href="{{ route('logout') }}" class="nav-link-custom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
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
</body>
</html>
