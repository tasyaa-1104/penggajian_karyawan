<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Finance Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-success shadow">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">Finance Panel</span>

        <div class="text-white">
            {{ Auth::user()->nama }}
            <a href="{{ route('logout') }}" class="btn btn-sm btn-light ms-3">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 bg-light vh-100 shadow-sm p-3">

            <h6 class="text-muted">MENU FINANCE</h6>

            <ul class="nav flex-column">

                <li class="nav-item mb-2">
                    <a href="{{ route('finance.dashboard') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{route('tunjangan.index')}}" class="nav-link">
                        Tunjangan
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{route('gaji.index')}}" class="nav-link">
                        Gaji
                    </a>
                </li>

            </ul>

        </div>

        <!-- CONTENT -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>
