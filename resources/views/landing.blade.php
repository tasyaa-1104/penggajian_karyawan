<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Penggajian Karyawan</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts: Outfit (Modern & Elegant) -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* TEMA MERAH TUA (SMARTGAJI) */
            --primary: #8B0000;       /* Merah Tua */
            --secondary: #cc0000;    /* Merah Terang */
            --dark: #5a0000;          /* Merah Gelap */
            --bg-body: #fff5f5;       /* Background halaman merah muda sangat pucat */
            --text-main: #1e293b;
            --text-muted: #64748b;

    <title>SmartGaji - Sistem Penggajian Terpadu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* --- PALET WARNA MAROON ELEGAN --- */
            --primary: #800000;      /* Maroon Utama */
            --secondary: #a52a2a;    /* Merah Bata */
            --dark: #450b0b;         /* Maroon Gelap */
            --light: #fff0f0;       /* Putih Kemerahan */
            --text-main: #2c3e50;
            --text-sub: #7f8c8d;

        }

        body {
            font-family: 'Outfit', sans-serif;

            background: var(--bg-body);
            color: var(--text-main);

            background: #ffffff;

            overflow-x: hidden;
            color: var(--text-main);
        }


        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(139, 0, 0, 0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }

        .btn-login {

        /* --- BACKGROUND BLOBS (ANIMASI BESAR) --- */
        .bg-blobs {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: floatBlob 25s infinite alternate ease-in-out;
        }

        .blob-1 { width: 600px; height: 600px; background: var(--primary); top: -150px; left: -200px; animation-duration: 20s; }
        .blob-2 { width: 500px; height: 500px; background: #ff9999; bottom: -100px; right: -150px; animation-duration: 28s; }
        .blob-3 { width: 350px; height: 350px; background: var(--secondary); top: 40%; left: 70%; animation-duration: 22s; }
        .blob-4 { width: 250px; height: 250px; background: #ffcdd2; top: 30%; left: 10%; animation-duration: 18s; }
        .blob-5 { width: 300px; height: 300px; background: var(--dark); bottom: 10%; left: 40%; animation-duration: 30s; }

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 70px) scale(1.1); }
        }

        /* --- ANIMASI GELEMBUNG AIR (BARU) --- */
        .bubble-container {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            pointer-events: none;
            overflow: hidden; /* Gelembung hilang di pinggir */
        }

        .bubble {
            position: absolute;
            bottom: -100px; /* Mulai dari bawah layar */
            background: rgba(255, 255, 255, 0.2); /* Putih transparan halus */
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            animation: riseUp linear infinite; /* Animasi naik ke atas */
        }

        /* Keyframe: Bergerak dari bawah ke atas lalu membesar sedikit */
        @keyframes riseUp {
            0% {
                transform: translateY(0) scale(0.5);
                opacity: 0;
            }
            20% {
                opacity: 0.6; /* Muncul perlahan */
            }
            100% {
                transform: translateY(-120vh) scale(1.2); /* Pergi ke layar atas (di luar viewport) */
                opacity: 0; /* Hilang */
            }
        }

        /* --- NAVBAR STYLE --- */
        .navbar {
            padding: 15px 0;
            transition: all 0.4s ease;
            background: transparent; /* Transparan di awal */
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 10px 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-main) !important;
            margin: 0 10px;
            transition: 0.3s;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: 0; left: 0;
            background-color: var(--primary);
            transition: width 0.3s;
        }
        .nav-link:hover::after { width: 100%; }

        .btn-login-nav {

            background: var(--primary);
            color: white;
            padding: 8px 25px;
            border-radius: 50px;

            padding: 8px 25px;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid var(--primary);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: white;
            color: var(--primary);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.1);
        }

        /* --- HERO SECTION (CLEAN) --- */

            font-weight: 600;
            transition: 0.3s;
            border: none;
            box-shadow: 0 4px 10px rgba(128, 0, 0, 0.2);
        }
        .btn-login-nav:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            color: white;
        }

        /* --- HERO SECTION (SPLIT LAYOUT) --- */

        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;

            padding-top: 80px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--primary); /* Merah Tua */
            margin-bottom: 25px;
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 35px;
            line-height: 1.7;
            max-width: 550px;

            position: relative;
            padding-top: 80px; /* Space untuk navbar */
            padding-bottom: 50px;
        }

        /* Foto Gedung di Kiri */
        .hero-img-wrapper {
            position: relative;
            border-radius: 10px; /* Sedikit Kotak */
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(128, 0, 0, 0.2);
            transform: perspective(1000px) rotateY(-3deg);
            transition: transform 0.5s ease;
            height: 550px;
        }

        .hero-img-wrapper:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        .hero-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Gradasi Maroon di Foto */
        .img-gradient {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(128, 0, 0, 0.6) 0%, rgba(255, 255, 255, 0) 100%);
            mix-blend-mode: multiply;
        }

        /* Teks di Kanan */
        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(to right, var(--dark), var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .typing-cursor::after {
            content: '|';
            animation: blink 1s step-start infinite;
            color: var(--primary);
        }
        @keyframes blink { 50% { opacity: 0; } }

        .hero-text p {
            font-size: 1.1rem;
            color: var(--text-sub);
            margin-bottom: 30px;
            line-height: 1.7;

        }

        .btn-main {
            padding: 15px 40px;
            border-radius: 50px;

            font-weight: 700;
            background: var(--dark);
            color: white;
            border: none;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(90, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .btn-main:hover {
            transform: scale(1.02); /* Hanya sedikit membesar, tidak berpindah tempat */
            background: var(--primary);
            box-shadow: 0 15px 30px rgba(139, 0, 0, 0.25);
        }

        /* --- FITUR UNGGULAN (ELEGANT & STATIC) --- */
        /* TIDAK ADA ANIMASI HOVER YANG MENGANGKAT */

        .section-title {
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 50px;

            font-weight: 600;
            transition: .3s;
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
            border: none;
            box-shadow: 0 10px 30px rgba(128, 0, 0, 0.3);
        }
        .btn-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(128, 0, 0, 0.4);
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;

        }

        .feature-card {

            background: #ffffff;

            background: white;
            border: 1px solid rgba(0,0,0,0.05);

            border-radius: 20px;
            padding: 40px 30px;
            border: 1px solid rgba(0,0,0,0.04);
            /* Aksen Merah di Atas (Signature Style) */
            border-top: 5px solid var(--primary);
            box-shadow: 0 4px 25px rgba(0,0,0,0.02); /* Bayangan sangat halus */
            height: 100%;

            position: relative;
            /* Tidak ada transition transform agar diam */

            box-shadow: 0 10px 30px rgba(128, 0, 0, 0.03);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(128, 0, 0, 0.1);
            border-color: var(--secondary);

        }

        .feature-icon {

            width: 65px;
            height: 65px;
            background: #fff5f5; /* Lingkaran merah sangat muda */
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 25px;
        }

        .feature-card h5 {
            font-weight: 700;
            color: var(--text-main);
            font-size: 1.25rem;
            margin-bottom: 5px;

            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            transition: transform 0.4s;
            box-shadow: 0 10px 20px rgba(165, 42, 42, 0.3);
        }
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(to right, var(--dark), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: block;
            margin: 10px 0;
            line-height: 1;

        }

        /* Style Statistik Angka */
        .stat-value {
            font-family: 'Outfit', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;


            font-size: 0.75rem;

            letter-spacing: 1px;
            color: var(--text-sub);
            font-weight: 600;
        }


        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-top: 20px;
        }

        /* --- CTA BOX --- */
        .cta-box {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            border-radius: 24px;
            padding: 80px 40px;
            color: white;
            box-shadow: 0 20px 50px rgba(139, 0, 0, 0.2);

        /* --- CTA & FOOTER --- */
        .cta-box {
            background: linear-gradient(-45deg, #450b0b, #800000, #a52a2a, #450b0b);
            background-size: 400% 400%;
            animation: gradientMove 10s ease infinite;
            border-radius: 30px;
            padding: 60px 20px;
            color: white;
            margin-top: 80px;
            box-shadow: 0 20px 50px rgba(128, 0, 0, 0.3);

            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .cta-box::before {

            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1), transparent 60%);
            pointer-events: none;
        }

        .cta-box h4 {
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 20px;
            position: relative; z-index: 2;
        }

        .btn-white {
            background: white;
            color: var(--primary);
            border-radius: 50px;
            padding: 12px 35px;
            font-weight: 700;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            position: relative; z-index: 2;
        }
        .btn-white:hover { background: #f8f8f8; transform: translateY(-2px); }

        /* --- FOOTER --- */
        footer {
            background: var(--primary);
            color: rgba(255,255,255,0.8);
            padding: 40px 0;
            font-size: 0.9rem;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; text-align: center; }
            .hero p { text-align: center; margin: 0 auto 30px auto; }
            .hero { text-align: center; padding-top: 100px; }
            .feature-card { margin-bottom: 30px; }

            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.2) 0%, transparent 60%);
        }

        footer {
            background: var(--dark);
            color: #ffcccc;
            padding: 40px 0;
            border-top: 3px solid var(--secondary);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-img-wrapper {
                height: 380px;
                margin-bottom: 30px;
                transform: none;
                border-radius: 10px;
            }
            .hero-text h1 { font-size: 2.5rem; text-align: center; }
            .hero-text { text-align: center; }
            .hero { padding-top: 100px; }
            /* Matikan animasi berat di mobile */
            .blob, .bubble { display: none; }
            body { background: linear-gradient(180deg, #fff5f5 0%, #ffffff 100%); }

        }
    </style>
</head>
<body>


    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-briefcase me-2"></i> Penggajian
            </a>
            <div class="ms-auto">
                <a href="/login" class="btn btn-login">Login</a>

    <!-- CONTAINER ANIMASI GELEMBUNG AIR (BARU) -->
    <div class="bubble-container" id="bubbleContainer"></div>

    <!-- BACKGROUND BLOBS ANIMATION (BESAR) -->
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="blob blob-4"></div>
        <div class="blob blob-5"></div>
    </div>

    <!-- NAVBAR (Scrollable) -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-building-columns me-2"></i> SmartGaji
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">About Us</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="/login" class="btn btn-login-nav">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Login
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- HERO SECTION (Split Layout) -->
    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">

                <!-- KOLOM KIRI: FOTO GEDUNG -->
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1200">
                    <div class="hero-img-wrapper">
                        <!-- Foto Gedung Biru -->
                        <img src="https://z-cdn-media.chatglm.cn/files/635e2c78-09b6-4586-bc9c-9f4a99f5a461.jpg?auth_key=1870906914-a253b36a29b44a8c8c7c46b285a08957-0-0b54851ae1e42d403e79eb0b7346b5e9" alt="SmartGaji Office">
                        <!-- Overlay Gradasi Maroon -->
                        <div class="img-gradient"></div>
                    </div>
                </div>

                <!-- KOLOM KANAN: TEKS & DESKRIPSI -->
                <div class="col-lg-6 hero-text" data-aos="fade-left" data-aos-duration="1200">
                    <h1>SmartGaji</h1>

                    <!-- Typewriter Animation -->
                    <h4 class="fw-bold mb-3" style="color: var(--secondary);">
                        <span id="typewriter" class="typing-cursor"></span>
                    </h4>

                    <p>
                        Solusi cerdas untuk mengelola karyawan, absensi, tunjangan, dan penggajian
                        dengan sistem modern, cepat, dan terintegrasi.
                        Tingkatkan efisiensi HRD perusahaan Anda hari ini.
                    </p>

                    <a href="/login" class="btn btn-main btn-lg">
                        Mulai Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>


    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <!-- Menghapus data-aos agar tidak ada animasi -->
                    <h1>Sistem Penggajian<br>Karyawan Modern</h1>
                    <p>
                        Kelola karyawan, absensi, tunjangan, dan penggajian dengan sistem yang terintegrasi, aman, dan profesional. Dibuat untuk efisiensi perusahaan Anda.
                    </p>
                    <a href="/login" class="btn btn-main btn-lg">
                        Mulai Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- FITUR UNGGULAN (CLEAN & ELEGANT - TANPA ANIMASI) -->
    <section class="py-5" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-title">Fitur Unggulan</div>
                <p class="section-subtitle">Solusi lengkap untuk kebutuhan HRD dan Karyawan</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- MANAJEMEN KARYAWAN -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-users"></i>

    <!-- FEATURES SECTION (About Us) -->
    <section class="py-5" id="features">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h3 class="fw-bold" style="color: var(--dark);">Tentang Kami & Fitur</h3>
                <p class="text-muted">Kenapa memilih SmartGaji untuk bisnis Anda?</p>
            </div>

            <div class="row g-4">
                <!-- MANAJEMEN KARYAWAN -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-users"></i></div>
                        <h5 class="fw-bold mb-3">Manajemen Karyawan</h5>

                        <!-- LOGIKA LARAVEL TIDAK DIUBAH -->
                        <div id="count-karyawan" class="stat-value">
                            {{ $jumlahKaryawan }}

                        </div>
                        <h5>Manajemen Karyawan</h5>


                        <!-- Counter Data Laravel -->
                        <div id="count-karyawan" class="stat-value">
                            {{ $jumlahKaryawan ?? 0 }}
                        </div>
                        <div class="stat-label">Total Karyawan</div>

                        <p>
                            Database karyawan yang terpusat, aman, dan mudah diakses. Kelola data personal secara efisien.

                        <div class="stat-label">Total Karyawan Terdaftar</div>
                        <p class="text-muted mt-3 small">
                            Database terpusat yang aman, mudah diakses, dan terorganisir rapi.

                        </p>
                    </div>
                </div>

                <!-- ABSENSI -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <h5>Absensi Otomatis</h5>

                        <div class="stat-value" style="font-size: 2.5rem;">98%</div>
                        <div class="stat-label">Akurasi Kehadiran</div>

                        <p>
                            Rekap kehadiran real-time, terintegrasi dengan lokasi GPS, dan laporan otomatis.
                        </p>
                    </div>
                </div>

                <!-- SLIP GAJI -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <h5>Slip Gaji Digital</h5>

                        <div class="stat-value" style="font-size: 2.5rem;">Detik</div>
                        <div class="stat-label">Waktu Proses</div>

                        <p>
                            Perhitungan gaji akurat lengkap dengan tunjangan, potongan, dan pajak otomatis.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA -->

            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <div class="cta-box">
                        <h4>Kelola Penggajian Lebih Mudah & Profesional</h4>
                        <a href="/login" class="btn btn-white">
                            Login Sekarang <i class="fa-solid fa-user-lock ms-2"></i>
                        </a>

            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="zoom-in">
                    <div class="cta-box text-center position-relative">
                        <div class="position-relative z-1">
                            <h4 class="fw-bold mb-3">Kelola Penggajian Lebih Mudah & Profesional</h4>
                            <a href="/login" class="btn btn-light btn-main rounded-pill px-5 shadow-none text-primary fw-bold">
                                Login Sekarang <i class="fa-solid fa-user-lock ms-2"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Penggajian Karyawan | Laravel</p>
        </div>
    </footer>

    <!-- SCRIPTS -->

    <footer class="text-center py-3">
        <small>&copy; {{ date('Y') }} SmartGaji | Sistem Penggajian Terpadu</small>
    </footer>

    <!-- Scripts (LOGIKA TIDAK DIUBAH) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT COUNTER (LOGIKA ANGKA NAIK) -->
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const counterElement = document.getElementById('count-karyawan');

            if (counterElement) {
                // Ambil nilai dari blade (misal: "150" atau "1,200")
                const rawValue = counterElement.innerText.trim();
                // Bersihkan format angka
                const finalValue = parseInt(rawValue.replace(/,/g, ''));

                if (!isNaN(finalValue)) {
                    // Set awal ke 0
                    counterElement.innerText = "0";
                    // Jalankan animasi

        // 1. Inisialisasi AOS
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
            easing: 'ease-out-cubic',
        });

        // 2. Script Counter (Laravel Logic)
        window.addEventListener('DOMContentLoaded', () => {
            const counterElement = document.getElementById('count-karyawan');

            if (counterElement) {
                const rawValue = counterElement.innerText.trim();
                const finalValue = parseInt(rawValue.replace(/,/g, ''));

                if (!isNaN(finalValue)) {
                    counterElement.innerText = "0";

                    animateValue(counterElement, 0, finalValue, 2000);
                }
            }
        });

        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const currentVal = Math.floor(progress * (end - start) + start);
                obj.innerHTML = currentVal.toLocaleString('id-ID');
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {

                    // Set nilai akhir format Indonesia

                    obj.innerHTML = end.toLocaleString('id-ID');
                }
            };
            window.requestAnimationFrame(step);
        }



        // 3. Efek Scroll pada Navbar (Jadi Putih Solid saat discroll)
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // 4. ANIMASI TYPEWRITER
        const textToType = "Solusi Cerdas Pengelolaan Gaji";
        const typeWriterElement = document.getElementById('typewriter');
        let i = 0;

        function typeWriter() {
            if (i < textToType.length) {
                typeWriterElement.innerHTML += textToType.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }

        // Mulai mengetik setelah delay
        setTimeout(typeWriter, 800);

        // 5. SCRIPT GENERATOR GELEMBUNG AIR (BARU)
        function createBubble() {
            const container = document.getElementById('bubbleContainer');
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');

            // Ukuran acak
            const size = Math.random() * 30 + 10 + 'px';
            bubble.style.width = size;
            bubble.style.height = size;

            // Posisi horizontal acak
            bubble.style.left = Math.random() * 100 + '%';

            // Durasi naik acak (antara 5s sampai 10s)
            const duration = Math.random() * 5 + 5 + 's';
            bubble.style.animationDuration = duration;

            container.appendChild(bubble);

            // Hapus gelembung setelah animasi selesai agar DOM tidak penuh
            setTimeout(() => {
                bubble.remove();
            }, parseFloat(duration) * 1000);
        }

        // Buat gelembung baru setiap 400ms
        setInterval(createBubble, 400);


    </script>
</body>
</html>
