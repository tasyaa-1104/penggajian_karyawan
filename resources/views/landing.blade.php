<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Penggajian Karyawan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body{
    font-family:'Poppins',sans-serif;
    background:#f6f8fc;
}

/* NAVBAR */
.navbar{
    background:rgba(13,110,253,.95);
    backdrop-filter:blur(10px);
}

/* HERO */
.hero{
    min-height:100vh;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    display:flex;
    align-items:center;
    color:white;
    position:relative;
    overflow:hidden;
}

.hero::before{
    content:"";
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
    top:-150px;
    right:-150px;
}

.hero h1{
    font-size:3.2rem;
    font-weight:700;
}

.hero p{
    font-size:1.15rem;
    opacity:.9;
}

/* BUTTON */
.btn-main{
    padding:12px 34px;
    border-radius:50px;
    font-weight:600;
    transition:.3s;
}
.btn-main:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

/* FEATURES */
.feature-card{
    background:white;
    border:none;
    border-radius:18px;
    padding:30px;
    text-align:center;
    transition:.35s;
    height:100%;
}
.feature-card:hover{
    transform:translateY(-12px);
    box-shadow:0 25px 50px rgba(0,0,0,.12);
}

.feature-icon{
    width:75px;
    height:75px;
    margin:auto;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    color:white;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    margin-bottom:20px;
}

/* CTA */
.cta-box{
    background:linear-gradient(135deg,#2a5298,#1e3c72);
    border-radius:28px;
    padding:60px 20px;
    color:white;
    margin-top:80px;
}

/* FOOTER */
footer{
    background:#0b1c39;
    color:white;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
<div class="container">
    <a class="navbar-brand fw-bold fs-4" href="#">
        <i class="fa fa-money-check-dollar"></i> Penggajian
    </a>
    <a href="/login" class="btn btn-light btn-sm rounded-pill px-4 fw-semibold">Login</a>
</div>
</nav>

<!-- HERO -->
<section class="hero text-center">
<div class="container position-relative">
    <h1>Sistem Penggajian Karyawan</h1>
    <p class="mt-3 mb-4">
        Kelola karyawan, absensi, tunjangan, dan penggajian <br>
        dengan sistem modern, cepat, dan terintegrasi.
    </p>
    <a href="/login" class="btn btn-light btn-main">
        <i class="fa fa-right-to-bracket"></i> Mulai Sekarang
    </a>
</div>
</section>

<!-- FEATURES -->
<section class="py-5">
<div class="container">
<div class="text-center mb-5">
    <h3 class="fw-bold">Fitur Unggulan</h3>
    <p class="text-muted">Dirancang untuk efisiensi pengelolaan perusahaan</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon"><i class="fa fa-users"></i></div>
          <h5 class="fw-semibold">Manajemen Karyawan</h5>

<h2 class="fw-bold text-primary mt-2">
    {{ $jumlahKaryawan }}
</h2>


<p class="text-muted">
    Total Karyawan Terdaftar
</p>


        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon"><i class="fa fa-calendar-check"></i></div>
            <h5 class="fw-semibold">Absensi Otomatis</h5>
            <p class="text-muted">Rekap kehadiran karyawan real-time & terintegrasi.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon"><i class="fa fa-file-invoice-dollar"></i></div>
            <h5 class="fw-semibold">Slip Gaji Digital</h5>
            <p class="text-muted">Perhitungan gaji akurat lengkap tunjangan & potongan.</p>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-box text-center mt-5">
    <h4 class="fw-bold mb-3">Kelola Penggajian Lebih Mudah & Profesional</h4>
    <a href="/login" class="btn btn-light btn-main">
        <i class="fa fa-user-lock"></i> Login Sekarang
    </a>
</div>
</div>
</section>

<!-- FOOTER -->
<footer class="text-center py-3">
<small>© {{ date('Y') }} Sistem Penggajian Karyawan | Laravel</small>
</footer>

</body>
</html>
