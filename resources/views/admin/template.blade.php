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


    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
            color: #1F2937;
            margin: 0;
            min-height: 100vh;
            display: flex;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #1E3A8A, #1E40AF);
            min-height: 100vh;
            padding: 1.2rem 1rem;
            position: fixed;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
            transition: left 0.3s ease;
            left: 0;
        }

        .sidebar h4 {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-link {
            color: #E5E7EB;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 6px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(6px);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #ffffff;
            color: #1E40AF;
            font-weight: 600;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .sidebar .nav-link i {
            font-size: 1rem;
        }

        /* ================= MAIN WRAPPER ================= */
        .main-wrapper {
            flex: 1;
            margin-left: 250px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .content {
            padding: 30px;
        }

        /* ================= BUTTON ================= */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1D4ED8, #1E40AF);
        }
        .img-wrapper {
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 12px;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -250px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

{{-- SIDEBAR --}}
<nav class="sidebar">
    <h4 class="text-white text-center mb-4">
        <i class="fa-solid fa-money-check-dollar"></i> Penggajian
    </h4>

    <ul class="nav flex-column">

    {{-- dashboard --}}
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>dashboard</span>
        </a>
    </li>

    {{-- master data --}}
    <li class="nav-item">
        <a href="{{ route('karyawan') }}"
           class="nav-link {{ request()->routeIs('karyawan*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            <span>karyawan</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('divisi.index') }}"
           class="nav-link {{ request()->routeIs('divisi*') ? 'active' : '' }}">
            <i class="fa-solid fa-sitemap"></i>
            <span>divisi</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('jabatan.index') }}"
           class="nav-link {{ request()->routeIs('jabatan*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-tie"></i>
            <span>jabatan</span>
        </a>
    </li>

    {{-- absensi --}}
    <li class="nav-item">
        <a href="{{ route('absensi') }}"
           class="nav-link {{ request()->routeIs('absensi*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i>
            <span>absensi</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('rekap-absensi.index') }}"
           class="nav-link {{ request()->routeIs('rekap-absensi*') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>rekap absensi</span>
        </a>
    </li>

    {{-- penggajian --}}
    <li class="nav-item">
        <a href="{{ route('potongan.index') }}"
           class="nav-link {{ request()->routeIs('potongan*') ? 'active' : '' }}">
            <i class="fa-solid fa-minus-circle"></i>
            <span>potongan gaji</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('tunjangan.index') }}"
           class="nav-link {{ request()->routeIs('tunjangan*') ? 'active' : '' }}">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <span>tunjangan</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('gaji.index') }}"
           class="nav-link {{ request()->routeIs('gaji*') ? 'active' : '' }}">
            <i class="fa-solid fa-wallet"></i>
            <span>gaji</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('slip-gaji.index') }}"
           class="nav-link {{ request()->routeIs('slipgaji*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>slip gaji</span>
        </a>
    </li>

    {{-- logout --}}
    <li class="nav-item mt-3">
        <a href="#" class="nav-link text-danger">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>logout</span>
        </a>
    </li>

</ul>
</nav>

{{-- MAIN --}}
<div class="main-wrapper">
    <div class="content">
        @yield('content')
    </div>
</div>
<!-- Bootstrap JS Bundle -->
<script src="{{ asset('bootstrap1/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
