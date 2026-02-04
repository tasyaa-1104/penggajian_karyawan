@extends('template')

@section('title', 'Absensi Karyawan')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Halaman Absensi</h1>
            <div class="user-profile">
                <span>Hi, {{ $karyawan->nama_karyawan }} 👋</span>
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
        --glass: rgba(255, 255, 255, 0.85);
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
        max-width: 650px; /* Lebar dibatasi agar seragam dan rapi */
        margin: 0 auto;
        padding: 40px 20px;
        position: relative;
        z-index: 10;
        padding-top: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
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
    .animate-up {
        opacity: 0;
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }

    /* --- STYLING HEADER --- */
    .website-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 80px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        z-index: 100;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .website-header h1 { font-size: 1.4rem; color: var(--secondary); margin: 0; font-weight: 700; }
    .user-profile { display: flex; align-items: center; gap: 15px; font-weight: 600; color: var(--text-dark); }
    .avatar-small {
        width: 40px; height: 40px;
        background: var(--bg-gradient); color: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* --- LAYOUT STACKED --- */
    .attendance-grid {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* --- KARTU JAM (VISUAL RICH) --- */
    .clock-card {
        width: 100%;
        background: var(--glass);
        padding: 40px;
        border-radius: 30px;
        box-shadow: var(--shadow);
        text-align: center;
        border: 1px solid rgba(255,255,255,0.6);
        position: relative;
        overflow: hidden;
        /* Pola Background agar tidak polos */
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px);
        background-size: 20px 20px;
    }

    /* Dekorasi Background Jam */
    .clock-card::before {
        content: '🕒';
        position: absolute;
        font-size: 15rem;
        opacity: 0.05;
        top: -20px;
        right: -20px;
        z-index: 0;
        pointer-events: none;
    }

    .time-display {
        font-size: 4rem;
        font-weight: 700;
        line-height: 1;
        margin: 20px 0;
        font-variant-numeric: tabular-nums;
        background: linear-gradient(to right, var(--secondary), var(--primary));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
        z-index: 1;
    }

    .date-display {
        color: #555;
        font-size: 1.2rem;
        font-weight: 500;
        background: #fff;
        padding: 8px 25px;
        border-radius: 50px;
        display: inline-block;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: relative;
        z-index: 1;
    }

    .clock-subtext {
        margin-top: 15px;
        color: #777;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    /* --- KARTU AKSI (VISUAL RICH) --- */
    .action-card {
        width: 100%;
        /* Menjaga keseimbangan visual, pakai min-height supaya tidak terlihat gepeng */
        min-height: 350px;
        background: rgba(255, 255, 255, 0.95);
        padding: 35px;
        border-radius: 30px;
        box-shadow: var(--shadow);
        border: 2px solid rgba(255,255,255,0.8);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    /* Border gradient mengkilap */
    .action-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 5px;
        background: linear-gradient(90deg, var(--secondary), var(--primary));
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px dashed #eee;
    }

    .header-icon {
        width: 50px; height: 50px;
        background: var(--bg-gradient);
        color: white;
        border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    .card-header h2 { margin: 0; font-size: 1.3rem; color: var(--text-dark); }

    /* ALERT */
    .alert {
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        text-align: center;
        font-weight: 500;
    }
    .alert-success { background-color: #d4edda; color: #155724; border: none; }
    .alert-danger { background-color: #f8d7da; color: #721c24; border: none; }

    /* TOMBOL STYLE */
    .btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 18px;
        margin-bottom: 15px;
        border: none;
        border-radius: 16px;
        font-family: inherit;
        font-size: 1.05rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        position: relative;
        z-index: 2;
    }
    .btn:active { transform: scale(0.97); }

    .btn-success {
        background: linear-gradient(to right, #11998e, #38ef7d);
        color: white;
    }
    .btn-success:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(56, 239, 125, 0.4); }

    .btn-danger {
        background: linear-gradient(to right, #cb2d3e, #ef473a);
        color: white;
    }
    .btn-danger:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(239, 71, 58, 0.4); }

    .btn-secondary {
        background: #f8f9fa;
        color: var(--text-dark);
        border: 1px solid #e9ecef;
    }
    .btn-secondary:hover { background: #e2e6ea; transform: translateY(-2px); }

    .btn:disabled { background: #e9ecef; color: #adb5bd; cursor: not-allowed; box-shadow: none; }
    .btn-group { display: flex; gap: 12px; }

    /* TAMPILAN SELESAI */
    .finish-message {
        text-align: center;
        padding: 40px 10px;
        color: #555;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .finish-emoji { font-size: 5rem; margin-bottom: 15px; display: block; animation: bounce 2s infinite; }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-20px);}
        60% {transform: translateY(-10px);}
    }

    /* MODAL */
    .modal {
        display: none;
        position: fixed;
        z-index: 200;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter: blur(5px);
        align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
    }
    .modal.show { display: flex; opacity: 1; }
    .modal-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 20px;
        width: 90%; max-width: 400px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.2);
        transform: scale(0.7);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modal.show .modal-box { transform: scale(1); }
    .modal h3 { margin-top: 0; color: var(--text-dark); text-align: center; margin-bottom: 20px; }

    .form-group { margin-bottom: 15px; text-align: left; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; color: #555; }
    .form-control {
        width: 100%; padding: 12px;
        border: 2px solid #eee; border-radius: 12px;
        box-sizing: border-box; font-family: inherit; font-size: 0.95rem;
        transition: border-color 0.3s;
    }
    .form-control:focus { border-color: var(--primary); outline: none; background: #fafdff; }
    textarea.form-control { resize: vertical; min-height: 80px; }

    /* WAVE ANIMATION */
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
</style>

<!-- WEBSITE CONTENT -->
<div class="website-layout">

    <div class="attendance-grid">

        <!-- 1. KARTU JAM (ATAS - FULL WIDTH, PATTERN) -->
        <div class="clock-card animate-up delay-1">
            <div style="z-index: 1; position: relative;">
                <p style="margin:0; color:#666; font-weight:600; text-transform:uppercase; letter-spacing:2px; font-size:0.85rem;">
                    Waktu Lokal
                </p>

                <div class="time-display" id="realTimeClock">--:--:--</div>

                <div class="date-display">
                    📅 {{ now()->format('l, d F Y') }}
                </div>

                <p class="clock-subtext">
                    Pastikan status absensi Anda tercatat dengan benar.
                </p>
            </div>
        </div>

        <!-- 2. KARTU AKSI (BAWAH - VISUAL RICH) -->
        <div class="action-card animate-up delay-2">
            <div class="card-header">
                <div class="header-icon">📋</div>
                <h2>Aktivitas Absensi</h2>
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">⚠️ {{ session('error') }}</div>
            @endif

            {{-- LOGIKA TOMBOL --}}
            @if(!$absensiHariIni)

                <form action="{{ route('karyawan.absen.masuk') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        📍 Mulai Absen Masuk
                    </button>
                </form>

                <div style="text-align: center; color: #888; font-size: 0.9rem; margin: 15px 0;">
                    —— Atau beritahu jika tidak masuk ——
                </div>

                <div class="btn-group">
                    <button class="btn btn-secondary" style="flex:1;" onclick="openModal('izinModal')">
                        🏥 Sakit
                    </button>
                    <button class="btn btn-secondary" style="flex:1;" onclick="openModal('izinModal')">
                        📝 Izin
                    </button>
                </div>

            @elseif(
                $absensiHariIni &&
                $absensiHariIni->status_kehadiran === 'Hadir' &&
                !$absensiHariIni->jam_pulang
            )

                <div style="text-align: center; margin-bottom: 25px; padding: 15px; background: #f0fff4; border-radius: 12px; border: 1px solid #c6f6d5; color: #22543d; font-weight: 600;">
                    🟢 Status: Sedang Bekerja
                </div>

                <form action="{{ route('karyawan.absen.pulang') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        🏠 Akhiri Jam Kerja (Pulang)
                    </button>
                </form>

            @else
                <div class="finish-message">
                    <span class="finish-emoji">🎉</span>
                    <h3>Absensi Selesai!</h3>
                    <p>Status hari ini: <strong>{{ $absensiHariIni->status_kehadiran }}</strong></p>
                </div>
            @endif
        </div>

    </div>

</div>

<!-- WAVE ANIMATION SVG -->
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
    <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" />
        <use xlink:href="#gentle-wave" x="48" y="3" />
        <use xlink:href="#gentle-wave" x="48" y="5" />
        <use xlink:href="#gentle-wave" x="48" y="7" />
    </g>
</svg>

{{-- MODAL IZIN --}}
<div class="modal" id="izinModal">
    <div class="modal-box">
        <h3>Form Pengajuan</h3>

        <form action="{{ route('karyawan.absen.izin') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Status Kehadiran</label>
                <select name="status_kehadiran" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Keterangan --</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alasan</label>
                <textarea name="keterangan" class="form-control" required
                    placeholder="Tuliskan alasan Anda secara detail..."></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 25px;">
                <button type="submit" class="btn btn-success" style="margin-bottom: 0;">
                    Kirim
                </button>
                <button type="button" class="btn btn-secondary" style="margin-bottom: 0;"
                    onclick="closeModal('izinModal')">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById('realTimeClock').innerText = hours + ":" + minutes + ":" + seconds;
    }
    updateClock();
    setInterval(updateClock, 1000);

    function openModal(modalID) {
        const modal = document.getElementById(modalID);
        modal.style.display = "flex";
        setTimeout(() => { modal.classList.add('show'); }, 10);
    }

    function closeModal(modalID) {
        const modal = document.getElementById(modalID);
        modal.classList.remove('show');
        setTimeout(() => { modal.style.display = "none"; }, 300);
    }

    window.onclick = function(event) {
        const modal = document.getElementById('izinModal');
        if (event.target == modal) {
            closeModal('izinModal');
        }
    }
</script>

@endsection
