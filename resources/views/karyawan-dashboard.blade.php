@extends('template')

@section('title', 'Dashboard Karyawan')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Dashboard Karyawan</h1>
            <div class="user-profile">
                <span>Hi, {{ $karyawan->nama_karyawan }} 👋</span>
                <div class="avatar-small">👤</div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- CSS STYLING WEBSITE RESPONSIVE + ANIMASI -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #4facfe;
        --primary-dark: #00f2fe;
        --secondary: #667eea;
        --text-dark: #333;
        --glass: rgba(255, 255, 255, 0.85);
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.15);
        --bg-gradient: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
    }

    /* RESET & UTAMA */
    body {
        font-family: 'Poppins', sans-serif;
        background: var(--bg-gradient);
        min-height: 100vh;
        margin: 0;
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* LAYOUT WEBSITE */
    .website-layout {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        position: relative;
        z-index: 10;
        padding-top: 100px;
    }

    /* --- ANIMASI CSS --- */
    @keyframes slideDown {
        from { transform: translateY(-100%); }
        to { transform: translateY(0); }
    }
    .animate-header { animation: slideDown 0.8s ease-out; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { opacity: 0; animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .profile-avatar-lg { animation: float 4s ease-in-out infinite; }

    /* --- HEADER WEBSITE --- */
    .website-header {
        position: fixed;
        top: 0; left: 0; width: 100%;
        height: 80px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        z-index: 100;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .header-content {
        max-width: 1200px; margin: 0 auto; padding: 0 20px; height: 100%;
        display: flex; justify-content: space-between; align-items: center;
    }
    .website-header h1 { font-size: 1.4rem; color: var(--secondary); margin: 0; font-weight: 700; }
    .user-profile { display: flex; align-items: center; gap: 15px; font-weight: 600; color: var(--text-dark); }
    .avatar-small {
        width: 40px; height: 40px; background: var(--bg-gradient); color: white; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* --- GRID SYSTEM --- */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    @media (min-width: 768px) {
        .dashboard-grid { grid-template-columns: repeat(3, 1fr); }
        .main-grid { grid-template-columns: 2fr 1fr; }
    }
    .main-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }

    /* --- CARD BASE STYLE (RICH STYLE) --- */
    .card {
        background: var(--glass);
        padding: 30px;
        border-radius: 24px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(255,255,255,0.6);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;

        /* Pola Titik-titik agar tidak polos */
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }

    /* Garis Gradasi di Atas Kartu */
    .card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
        background: linear-gradient(90deg, var(--secondary), var(--primary));
        border-radius: 24px 24px 0 0;
        opacity: 0.8;
    }

    /* --- STATS CARDS --- */
    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 25px;
        min-height: 100px; /* Tinggi minimum seragam */
    }

    .stat-icon-lg {
        width: 55px; height: 55px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center; font-size: 1.8rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .stat-card:hover .stat-icon-lg { transform: rotate(10deg) scale(1.1); }

    .bg-hadir { background: linear-gradient(135deg, #a8edea, #fed6e3); color: #1a5c3e; }
    .bg-izin { background: linear-gradient(135deg, #ffecd2, #fcb69f); color: #6f4e37; }
    .bg-alpha { background: linear-gradient(135deg, #ff9a9e, #fecfef); color: #721c24; }

    .stat-info h3 { margin: 0; font-size: 2rem; font-weight: 700; line-height: 1; }
    .stat-info p { margin: 5px 0 0 0; font-size: 0.9rem; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

    /* --- PROFILE CARD --- */
    .profile-container { display: flex; align-items: center; gap: 25px; flex-wrap: wrap; position: relative; z-index: 2; }

    /* Dekorasi Besar di Belakang */
    .card.profile-card::before {
        content: '👤';
        position: absolute;
        font-size: 10rem;
        opacity: 0.03;
        top: 10px; right: -20px;
        z-index: 1;
        pointer-events: none;
    }

    .profile-avatar-lg {
        width: 100px; height: 100px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 3rem; color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        z-index: 2;
    }
    .profile-details { flex: 1; z-index: 2; }
    .profile-details h2 { font-size: 1.8rem; margin: 0 0 5px 0; color: var(--text-dark); }

    .nik-badge {
        background: #fff;
        padding: 6px 15px; border-radius: 50px;
        font-size: 0.85rem; font-weight: 600; color: #555;
        display: inline-block; margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .info-grid-web { display: grid; gap: 12px; margin-top: 20px; z-index: 2; }
    .info-item-web {
        display: flex; align-items: center; background: rgba(255,255,255,0.8);
        padding: 12px 15px; border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .info-icon-web { font-size: 1.3rem; margin-right: 15px; width: 35px; text-align: center; }
    .info-text { display: flex; flex-direction: column; }
    .info-label-web { font-size: 0.75rem; color: #888; margin-bottom: 2px; font-weight: 600; }
    .info-value-web { font-size: 1rem; font-weight: 600; color: #333; }

    /* --- SALARY CARD --- */
    /* Dekorasi Besar di Belakang Gaji */
    .card.salary-card::before {
        content: '💰';
        position: absolute;
        font-size: 8rem;
        opacity: 0.04;
        bottom: -20px; right: -10px;
        z-index: 1;
        pointer-events: none;
    }

    .salary-display {
        text-align: center; padding: 30px 10px; position: relative; z-index: 2;
        background: rgba(255,255,255,0.6);
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.5);
    }
    .salary-label { font-size: 0.9rem; color: #666; text-transform: uppercase; letter-spacing: 1px; margin: 0; }
    .salary-amount {
        font-size: 2.2rem; font-weight: 800;
        color: var(--secondary);
        margin: 10px 0;
        background: linear-gradient(to right, #667eea, #764ba2);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* Tombol Gaji (Samakan dengan Absensi) */
    .btn-web {
        display: block; width: 100%; padding: 16px;
        background: linear-gradient(to right, #11998e, #38ef7d);
        color: white; text-align: center; text-decoration: none;
        border-radius: 16px; font-weight: 600; margin-top: auto;
        transition: transform 0.2s, opacity 0.2s; box-shadow: 0 4px 15px rgba(56, 239, 125, 0.3); z-index: 2; position: relative;
    }
    .btn-web:hover { transform: translateY(-2px); opacity: 0.95; box-shadow: 0 6px 20px rgba(56, 239, 125, 0.4); }

    /* --- WAVE ANIMATION --- */
    .waves {
        position: fixed; bottom: 0; left: 0; width: 100%; height: 15vh;
        margin-bottom: -7px; min-height: 100px; max-height: 150px; z-index: 1; pointer-events: none;
    }
    .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }
    @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }

    .card-header {
        display: flex; align-items: center; margin-bottom: 25px;
        padding-bottom: 15px; border-bottom: 2px dashed rgba(0,0,0,0.05); position: relative; z-index: 2;
    }
    .card-header h2 { margin: 0; font-size: 1.3rem; color: var(--text-dark); }
    .header-dot { width: 8px; height: 25px; background: var(--primary); margin-right: 15px; border-radius: 10px; }
</style>

<!-- WEBSITE CONTENT -->
@isset($karyawan)
<div class="website-layout">

    <!-- 1. STATS ROW (BARIS ATAS) -->
    <div class="dashboard-grid">
        <!-- Hadir -->
        <div class="card stat-card animate-up delay-1">
            <div class="stat-icon-lg bg-hadir">✅</div>
            <div class="stat-info">
                <h3>{{ $totalHadir ?? 0 }}</h3>
                <p>Hadir</p>
            </div>
        </div>

        <!-- Izin -->
        <div class="card stat-card animate-up delay-2">
            <div class="stat-icon-lg bg-izin">📝</div>
            <div class="stat-info">
                <h3>{{ $totalIzin ?? 0 }}</h3>
                <p>Izin/Sakit</p>
            </div>
        </div>

        <!-- Alpha -->
        <div class="card stat-card animate-up delay-3">
            <div class="stat-icon-lg bg-alpha">⛔</div>
            <div class="stat-info">
                <h3>{{ $totalAlpha ?? 0 }}</h3>
                <p>Alpha</p>
            </div>
        </div>
    </div>

    <!-- 2. MAIN CONTENT (BARIS BAWAH) -->
    <div class="main-grid">

        <!-- KARTU INFO KARYAWAN -->
        <div class="card profile-card animate-up delay-4">
            <div class="card-header">
                <div class="header-dot"></div>
                <h2>Profil Karyawan</h2>
            </div>

            <div class="profile-container">
                <div class="profile-avatar-lg">👤</div>

                <div class="profile-details">
                    <h2>{{ $karyawan->nama_karyawan }}</h2>
                    <div class="nik-badge">NIK: {{ $karyawan->nik }}</div>

                    <div class="info-grid-web">
                        <div class="info-item-web">
                            <div class="info-icon-web">🏢</div>
                            <div class="info-text">
                                <span class="info-label-web">Divisi</span>
                                <span class="info-value-web">{{ $karyawan->divisi->nama_divisi }}</span>
                            </div>
                        </div>

                        <div class="info-item-web">
                            <div class="info-icon-web">💼</div>
                            <div class="info-text">
                                <span class="info-label-web">Jabatan</span>
                                <span class="info-value-web">{{ $karyawan->jabatan->nama_jabatan }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KARTU GAJI -->
        <div class="card salary-card animate-up delay-5">
            <div class="card-header">
                <div class="header-dot" style="background: var(--secondary);"></div>
                <h2>Info Gaji</h2>
            </div>

            <div class="salary-display">
                <p class="salary-label">Gaji Pokok</p>
                <div class="salary-amount">
                    Rp {{ number_format($karyawan->gaji_pokok,0,',','.') }}
                </div>
            </div>

            <a href="{{ route('karyawan.slip-gaji.show') }}" class="btn-web">
                📄 Lihat Slip Gaji
            </a>
        </div>

    </div>

</div>
@endisset

<!-- WAVE ANIMATION SVG -->
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" />
        <use xlink:href="#gentle-wave" x="48" y="3" />
        <use xlink:href="#gentle-wave" x="48" y="5" />
        <use xlink:href="#gentle-wave" x="48" y="7" />
    </g>
</svg>

@endsection
