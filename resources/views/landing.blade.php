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
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
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
            background: var(--primary);
            color: white;
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
        }

        .feature-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            border: 1px solid rgba(0,0,0,0.04);
            /* Aksen Merah di Atas (Signature Style) */
            border-top: 5px solid var(--primary);
            box-shadow: 0 4px 25px rgba(0,0,0,0.02); /* Bayangan sangat halus */
            height: 100%;
            position: relative;
            /* Tidak ada transition transform agar diam */
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
            letter-spacing: 1px;
            color: #94a3b8;
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
            </div>
        </div>
    </nav>


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
                        </div>
                        <h5>Manajemen Karyawan</h5>

                        <!-- Counter Data Laravel -->
                        <div id="count-karyawan" class="stat-value">
                            {{ $jumlahKaryawan ?? 0 }}
                        </div>
                        <div class="stat-label">Total Karyawan</div>

                        <p>
                            Database karyawan yang terpusat, aman, dan mudah diakses. Kelola data personal secara efisien.
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
    </script>
</body>
</html>
