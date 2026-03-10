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
        }

        /* 1. Navbar Maroon */
        .navbar-maroon {
            background-color: var(--maroon-primary) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* 2. Sidebar Maroon */
        .sidebar-maroon {
            background-color: var(--maroon-primary) !important;
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }

        .sidebar-maroon h6 {
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            margin-bottom: 20px;
            padding-left: 10px;
        }

        /* Styling Link Sidebar */
        .nav-link-custom {
            color: rgba(255,255,255,0.9);
            border-radius: 0 25px 25px 0;
            margin-bottom: 5px;
            padding: 12px 15px;
            transition: all 0.3s ease; /* Animasi Transisi */
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        /* Efek Hover Sidebar */
        .nav-link-custom:hover {
            background-color: var(--maroon-dark);
            color: white;
            padding-left: 25px; /* Animasi Geser Kanan */
            text-decoration: none;
        }

        /* Animasi Ikon Sidebar */
        .nav-link-custom i {
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .nav-link-custom:hover i {
            transform: scale(1.3) rotate(10deg); /* Ikon membesar & berputar */
            color: #ffcccc;
        }
    </style>
</head>
<body>

<!-- NAVBAR (Logout SUDAH DIHAPUS, Hanya tersisa Nama User) -->
<nav class="navbar navbar-dark navbar-maroon shadow">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">
            <i class="fas fa-wallet me-2"></i>Finance Panel
        </span>

        <div class="text-white">
            <i class="fas fa-user-circle me-2"></i>
            <!-- Logika Auth Tetap -->
            {{ Auth::user()->nama }}
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR (Logout dipindahkan ke bawah Gaji) -->
        <div class="col-md-2 sidebar-maroon shadow-sm">

            
            <ul class="nav flex-column">

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

                <!-- LOGOUT (Dipindahkan ke sini, di bawah Gaji) -->
                <!-- mt-3 ditambahkan untuk memberi jarak sedikit -->
                <li class="nav-item mt-3 mb-2">
                    <a href="{{ route('login') }}" class="nav-link-custom">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>

            </ul>

        </div>

        <!-- CONTENT -->
        <div class="col-md-10 p-4 bg-light" style="min-height: 100vh;">
            @yield('content')
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
