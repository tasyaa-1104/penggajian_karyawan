<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggajian</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        *{box-sizing:border-box}
        html,body{
            margin:0;padding:0;width:100%;height:100%;
            font-family:'Poppins',sans-serif;
            background:#F8FAFC;color:#1F2937;
        }

        /* SIDEBAR */
        .sidebar{
            width:250px;height:100vh;
            background:linear-gradient(180deg,#3B82F6,#60A5FA);
            position:fixed;left:0;top:0;z-index:1000;
            box-shadow:4px 0 20px rgba(0,0,0,.08);
            overflow:hidden;
        }

        .sidebar h4{
            padding:24px 16px;
            text-align:center;
            color:#fff;font-weight:600;
            border-bottom:1px solid rgba(255,255,255,.15);
        }

        .sidebar ul{
            padding:20px 12px;
            margin:0;
            position:relative;
            z-index:2;
        }

        .nav-link{
            color:rgba(255,255,255,.85);
            padding:12px 14px;
            border-radius:12px;
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:6px;
            transition:.3s;
        }

        .nav-link:hover{
            background:rgba(255,255,255,.18);
            color:#fff;
            transform:translateX(5px);
        }

        .nav-link.active{
            background:#fff;
            color:#3B82F6;
            font-weight:600;
            box-shadow:0 8px 20px rgba(0,0,0,.15);
            transform:translateX(5px);
        }

        /* WAVE */
        .wave-container{
            position:absolute;
            bottom:0;left:0;
            width:100%;height:100px;
            z-index:1;
        }

        .wave{
            position:absolute;
            bottom:0;
            width:200%;height:100%;
            background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800z' fill='%23ffffff' fill-opacity='0.12'/%3E%3C/svg%3E");
            background-size:50% 100%;
            animation:wave 10s linear infinite;
        }

        .wave:nth-child(2){opacity:.5;animation-duration:8s}
        .wave:nth-child(3){opacity:.7;animation-duration:6s}

        @keyframes wave{
            from{transform:translateX(0)}
            to{transform:translateX(-50%)}
        }

        /* MAIN */
        .main-wrapper{
            margin-left:250px;
            min-height:100vh;
            width:calc(100% - 250px);
        }

        .content{
            padding:24px;
        }

        /* MOBILE */
        .mobile-toggle{
            display:none;
            position:fixed;
            top:15px;right:15px;
            background:#3B82F6;
            color:#fff;
            border:none;
            padding:10px 14px;
            border-radius:8px;
            z-index:1100;
        }

        @media(max-width:991px){
            .sidebar{left:-260px}
            .sidebar.active{left:0}
            .main-wrapper{margin-left:0;width:100%}
            .mobile-toggle{display:block}
        }
    </style>
</head>

<body>

<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- SIDEBAR -->
<nav class="sidebar" id="sidebar">
    <h4>
        <i class="fa-solid fa-money-check-dollar"></i> Karyawan
    </h4>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('karyawan.dashboard') }}"
               class="nav-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('karyawan.absensi.create') }}"
               class="nav-link {{ request()->routeIs('karyawan.absensi.create') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Absensi
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="{{ route('login') }}" class="nav-link text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </li>

    </ul>

    <div class="wave-container">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</nav>

<!-- MAIN -->
<div class="main-wrapper">
    <div class="content">
        @yield('content')
    </div>
</div>

<div id="sidebarOverlay"
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
     background:rgba(0,0,0,.5);z-index:999"
     onclick="toggleSidebar()"></div>

<script>
function toggleSidebar(){
    const sidebar=document.getElementById('sidebar');
    const overlay=document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('active');
    overlay.style.display=sidebar.classList.contains('active')?'block':'none';
}
</script>

</body>
</html>
