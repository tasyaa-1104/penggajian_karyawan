@extends('template')

@section('title', 'Slip Gaji')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Slip Gaji</h1>
            <div class="user-profile">
                <span>Hi, {{ $slip->gaji->karyawan->nama_karyawan }} 👋</span>
                <div class="avatar-small">👤</div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- CSS STYLING -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #4facfe;
        --primary-dark: #00f2fe;
        --secondary: #667eea;
        --text-dark: #333;
        --glass: rgba(255, 255, 255, 0.95);
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
        max-width: 600px; /* Lebar mirip struk kertas */
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
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { opacity: 0; animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }

    /* --- HEADER STYLE --- */
    .website-header {
        position: fixed; top: 0; left: 0; width: 100%; height: 80px;
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
        z-index: 100; border-bottom: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .header-content { max-width: 1200px; margin: 0 auto; padding: 0 20px; height: 100%; display: flex; justify-content: space-between; align-items: center; }
    .website-header h1 { font-size: 1.4rem; color: var(--secondary); margin: 0; font-weight: 700; }
    .user-profile { display: flex; align-items: center; gap: 15px; font-weight: 600; color: var(--text-dark); }
    .avatar-small { width: 40px; height: 40px; background: var(--bg-gradient); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

    /* --- SLIP CARD STYLE (RECEIPT LOOK) --- */
    .slip-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        padding: 0; /* Padding handled by inner sections */
        position: relative;
        overflow: hidden;
        /* Pola background agar tidak polos */
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px);
        background-size: 15px 15px;
    }

    /* Header Slip */
    .slip-header {
        background: var(--bg-gradient);
        padding: 30px 20px;
        text-align: center;
        color: white;
        position: relative;
    }

    .slip-header h2 { margin: 0; font-size: 1.5rem; }
    .slip-header p { margin: 5px 0 0 0; opacity: 0.9; font-size: 0.9rem; }

    /* Konten Slip */
    .slip-body { padding: 30px 25px; }

    /* Bagian Profil Ringkas */
    .profile-mini {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #eee;
    }
    .avatar-mini { font-size: 1.8rem; }
    .info-mini div { font-size: 0.85rem; color: #666; }
    .info-mini strong { display: block; color: #333; font-size: 1rem; }

    /* List Struk */
    .slip-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed #e0e0e0;
    }
    .slip-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

    .slip-label { color: #777; font-size: 0.95rem; font-weight: 500; }
    .slip-value { color: #333; font-weight: 700; font-size: 1rem; }

    .total-row {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .total-label { color: var(--secondary); font-size: 1.1rem; font-weight: 700; text-transform: uppercase; }
    .total-amount {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--secondary);
        background: linear-gradient(to right, #667eea, #764ba2);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* TOMBOL KEMBALI */
    .btn-back {
        display: block;
        width: 100%;
        padding: 15px;
        margin-top: 25px;
        background: #fff;
        color: var(--text-dark);
        border: 2px solid var(--secondary);
        border-radius: 15px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .btn-back:hover { background: var(--secondary); color: white; transform: translateY(-2px); box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3); }

    /* Dekorasi Background */
    .slip-card::after {
        content: '💰';
        position: absolute;
        font-size: 10rem;
        opacity: 0.03;
        bottom: -20px; right: -20px;
        pointer-events: none;
    }

    /* WAVE ANIMATION */
    .waves { position: fixed; bottom: 0; left: 0; width: 100%; height: 15vh; margin-bottom: -7px; min-height: 100px; max-height: 150px; z-index: 1; pointer-events: none; }
    .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }
    @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }
</style>

<!-- WEBSITE CONTENT -->
<div class="website-layout">

    <div class="slip-card animate-up">
        <!-- Header Slip -->
        <div class="slip-header">
            <h2>Slip Gaji</h2>
            <p>{{ $slip->gaji->bulan }}</p>
        </div>

        <!-- Body Slip -->
        <div class="slip-body">

            <!-- Profil Mini -->
            <div class="profile-mini">
                <div class="avatar-mini">👤</div>
                <div class="info-mini">
                    <strong>{{ $slip->gaji->karyawan->nama_karyawan }}</strong>
                    <div>{{ $slip->gaji->karyawan->jabatan->nama_jabatan }}</div>
                </div>
            </div>

            <!-- Rincian (Receipt Style) -->
            <div class="slip-row">
                <span class="slip-label">Total Tunjangan</span>
                <span class="slip-value">Rp {{ number_format($slip->gaji->total_tunjangan,0,',','.') }}</span>
            </div>

            <div class="slip-row">
                <span class="slip-label">Total Potongan</span>
                <span class="slip-value" style="color:#dc3545">- Rp {{ number_format($slip->gaji->total_potongan,0,',','.') }}</span>
            </div>

            <!-- Grand Total -->
            <div class="total-row">
                <span class="total-label">Gaji Bersih</span>
                <span class="total-amount">Rp {{ number_format($slip->gaji->gaji_bersih,0,',','.') }}</span>
            </div>

            <!-- Dekorasi Cap / Stempel Digital -->
            <div style="text-align: center; margin-top: 25px; color: #28a745; font-weight: 700; border: 2px dashed #28a745; padding: 10px; border-radius: 10px; opacity: 0.7;">
                ✅ DIBAYARKAN LUNAS
            </div>

            <!-- Tombol Kembali -->
            <a href="{{ route('karyawan.dashboard') }}" class="btn-back">
                ⬅️ Kembali ke Dashboard
            </a>

        </div>
    </div>

</div>

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
