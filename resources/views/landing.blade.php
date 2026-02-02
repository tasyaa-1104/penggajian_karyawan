<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penggajian Karyawan</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {

            --primary: #0284c7;
            --secondary: #38bdf8;
            --dark: #0c4a6e;
            --light: #f0f9ff;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--light);
            overflow-x: hidden;
        }


        .bg-animation {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            overflow: hidden;
            background: linear-gradient(180deg, #e0f2fe 0%, #ffffff 100%); /* Gradien biru sangat muda */
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.5;
            animation: floatBlob 12s infinite alternate ease-in-out;
        }
        .blob-1 { width: 500px; height: 500px; background: var(--secondary); top: -150px; left: -100px; }
        .blob-2 { width: 400px; height: 400px; background: #7dd3fc; bottom: -100px; right: -100px; animation-duration: 18s; }

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 50px) scale(1.1); }
        }


        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            font-size: 1.5rem;
        }
        .btn-login {
            background: var(--primary);
            color: white;
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.2);
        }
        .btn-login:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 10px 25px rgba(56, 189, 248, 0.4);
        }


        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            text-align: center;
            padding-top: 60px;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--dark);
        }
        .hero p {
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-main {
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: .3s;
            background: var(--dark);
            color: white;
            border: none;
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.15);
        }
        .btn-main:hover {
            transform: translateY(-3px);
            background: var(--primary);
            box-shadow: 0 15px 30px rgba(2, 132, 199, 0.3);
            color: white;
        }

        /* --- FEATURES --- */
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 24px;
            padding: 40px 30px;
            text-align: center;
            transition: .4s;
            height: 100%;
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.05); /* Shadow biru sangat tipis */
        }
        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 50px rgba(2, 132, 199, 0.15);
            border-color: var(--secondary);
        }
        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            /* Gradien Biru Muda */
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            transition: transform 0.4s;
            box-shadow: 0 10px 20px rgba(56, 189, 248, 0.4);
        }
        .feature-card:hover .feature-icon {
            transform: rotateY(180deg) scale(1.1);
        }

        /* Style Khusus Angka Karyawan */
        .stat-value {
            font-size: 2.8rem;
            font-weight: 800;
            /* Gradien Teks Biru Langit */
            background: linear-gradient(to right, var(--dark), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: block;
            margin: 10px 0;
            line-height: 1;
        }
        .stat-label {
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            color: #94a3b8;
            font-weight: 600;
        }

        /* --- CTA --- */
        .cta-box {
            /* Gradien Biru Langit */
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 30px;
            padding: 80px 20px;
            color: white;
            margin-top: 80px;
            box-shadow: 0 20px 50px rgba(2, 132, 199, 0.25);
            position: relative;
            overflow: hidden;
        }
        .cta-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.3) 0%, transparent 60%);
        }

        /* --- FOOTER --- */
        footer {
            background: var(--dark);
            color: #bae6fd; /* Teks footer biru muda pucat */
            padding: 30px 0;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.2rem; }
            .blob { display: none; }
        }
    </style>
</head>
<body>

    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-wallet me-2"></i> Penggajian
            </a>
            <a href="/login" class="btn btn-login">Login</a>
        </div>
    </nav>


    <section class="hero">
        <div class="container position-relative">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1>Sistem Penggajian Karyawan</h1>
                <p class="mt-3 mb-4">
                    Kelola karyawan, absensi, tunjangan, dan penggajian <br>
                    dengan sistem modern, cepat, dan terintegrasi.
                </p>
                <a href="/login" class="btn btn-main btn-lg">
                    Mulai Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h3 class="fw-bold">Fitur Unggulan</h3>
                <p class="text-muted">Dirancang untuk efisiensi pengelolaan perusahaan</p>
            </div>

            <div class="row g-4">
                <!-- MANAJEMEN KARYAWAN (DATA OTOMATIS DARI LARAVEL) -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-users"></i></div>
                        <h5 class="fw-bold mb-3">Manajemen Karyawan</h5>

                        <!-- ID 'count-karyawan' ditambahkan untuk JavaScript -->
                        <div id="count-karyawan" class="stat-value">
                            {{ $jumlahKaryawan }}
                        </div>

                        <div class="stat-label">Total Karyawan Terdaftar</div>

                        <p class="text-muted mt-3 small">
                            Database terpusat yang aman, mudah diakses, dan terorganisir rapi.
                        </p>
                    </div>
                </div>

                <!-- ABSENSI -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <h5 class="fw-bold mb-3">Absensi Otomatis</h5>
                        <div class="stat-value" style="font-size: 2.5rem;">98%</div>
                        <div class="stat-label">Akurasi Kehadiran</div>
                        <p class="text-muted mt-3 small">Rekap kehadiran karyawan real-time & terintegrasi dengan GPS.</p>
                    </div>
                </div>

                <!-- SLIP GAJI -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        <h5 class="fw-bold mb-3">Slip Gaji Digital</h5>
                        <div class="stat-value" style="font-size: 2.5rem;">Detik</div>
                        <div class="stat-label">Waktu Proses</div>
                        <p class="text-muted mt-3 small">Perhitungan gaji akurat lengkap tunjangan & potongan otomatis.</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="zoom-in">
                    <div class="cta-box text-center position-relative">
                        <div class="position-relative z-1">
                            <h4 class="fw-bold mb-3">Kelola Penggajian Lebih Mudah & Profesional</h4>
                            <a href="/login" class="btn btn-light btn-main rounded-pill px-5 shadow-none text-primary">
                                Login Sekarang <i class="fa-solid fa-user-lock ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-3">
        <small>&copy; {{ date('Y') }} Sistem Penggajian Karyawan | Laravel</small>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // 1. Inisialisasi Animasi Scroll (AOS)
        AOS.init({
            once: true, // Animasi hanya sekali saat scroll ke bawah
            offset: 100,
            duration: 800,
            easing: 'ease-out-cubic',
        });

        // 2. Script untuk Mengambil Data Laravel dan Menganimasikannya
        window.addEventListener('DOMContentLoaded', () => {
            const counterElement = document.getElementById('count-karyawan');

            if (counterElement) {
                // Ambil nilai mentah dari Blade (misal: "150" atau "1,500")
                const rawValue = counterElement.innerText.trim();

                // Bersihkan format angka (hapus koma/titik agar bisa dikalkulasi JS)
                const finalValue = parseInt(rawValue.replace(/,/g, ''));

                // Jika nilai valid angka, jalankan animasi
                if (!isNaN(finalValue)) {
                    // Set awal ke 0 sebelum animasi
                    counterElement.innerText = "0";

                    animateValue(counterElement, 0, finalValue, 2000);
                }
            }
        });

        // Fungsi Animasi Angka (Count Up)
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);

                // Hitung angka saat ini
                const currentVal = Math.floor(progress * (end - start) + start);

                // Tampilkan dengan format pemisah ribuan (misal: 1,250)
                obj.innerHTML = currentVal.toLocaleString('id-ID');

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    // Pastikan angka akhir sesuai format Laravel aslinya jika perlu
                    obj.innerHTML = end.toLocaleString('id-ID');
                }
            };
            window.requestAnimationFrame(step);
        }

        // 3. Efek Scroll pada Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = "0 4px 20px rgba(2, 132, 199, 0.1)";
                navbar.style.background = "rgba(255, 255, 255, 0.95)";
            } else {
                navbar.style.boxShadow = "0 4px 6px -1px rgba(0, 0, 0, 0.03)";
                navbar.style.background = "rgba(255, 255, 255, 0.9)";
            }
        });
    </script>
</body>
</html>
