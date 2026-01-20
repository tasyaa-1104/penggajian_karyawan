<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penggajian Karyawan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 40px;
            color: #2a5298;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fa fa-money-check-dollar"></i> Penggajian
        </a>
        <div class="ms-auto">
            <a href="/login" class="btn btn-light btn-sm">Login</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero text-center">
    <div class="container">
        <h1 class="fw-bold mb-3">Sistem Penggajian Karyawan</h1>
        <p class="mb-4">
            Kelola data karyawan, absensi, gaji, tunjangan, dan potongan<br>
            secara cepat, akurat, dan terintegrasi
        </p>
        <a href="/login" class="btn btn-light btn-lg">
            <i class="fa fa-right-to-bracket"></i> Mulai Sekarang
        </a>
    </div>
</section>

<!-- FITUR -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <h3 class="fw-bold">Fitur Unggulan</h3>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center p-4">
                    <i class="fa fa-users feature-icon mb-3"></i>
                    <h5>Manajemen Karyawan</h5>
                    <p>Kelola data karyawan, jabatan, dan divisi dengan mudah.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center p-4">
                    <i class="fa fa-calendar-check feature-icon mb-3"></i>
                    <h5>Absensi</h5>
                    <p>Catat dan rekap absensi karyawan secara otomatis.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center p-4">
                    <i class="fa fa-file-invoice-dollar feature-icon mb-3"></i>
                    <h5>Slip Gaji</h5>
                    <p>Hitung gaji, tunjangan, potongan, dan cetak slip gaji.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h4 class="fw-bold mb-3">Kelola Penggajian Lebih Mudah & Profesional</h4>
        <a href="/login" class="btn btn-light btn-lg">
            <i class="fa fa-user-lock"></i> Login Sekarang
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3">
    <small>
        © {{ date('Y') }} Sistem Penggajian Karyawan | Laravel
    </small>
</footer>

</body>
</html>
