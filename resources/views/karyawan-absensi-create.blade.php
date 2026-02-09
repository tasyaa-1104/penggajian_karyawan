@extends('template')

@section('title', 'Absensi Karyawan')

@section('topbar')
    <div style="display:none;"></div>
@endsection

@section('content')
{{-- <pre>{{ json_encode($liburList, JSON_PRETTY_PRINT) }}</pre> --}}


<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');

    :root {
        --primary: #4facfe;
        --secondary: #00f2fe;
        --text-main: #1e293b;
        --text-light: #64748b;
        --bg-body: #f0f9ff;
        --alert-orange: #f97316;
    }

    /* --- LAYOUT UTAMA (No Scroll) --- */
    .split-layout {
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e0f2fe;
        overflow: hidden;
        position: relative;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 25px;
        width: 95%;
        max-width: 1200px;
        height: 85vh;
        position: relative;
        z-index: 10;
    }

    /* --- CARD SHARED --- */
    .glass-card {
        border-radius: 32px;
        padding: 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(79, 172, 254, 0.25);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
    }

    /* --- KARTU KANAN (JAM) --- */
    .right-card {
        background: linear-gradient(160deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        border: 2px solid rgba(255,255,255,0.4);
        order: 2;
    }

    /* Gelombang & Gelembung (Kanan) */
    .wave-container { position: absolute; bottom: 0; left: 0; width: 100%; height: 150px; z-index: 1; pointer-events: none; }
    .wave { position: absolute; bottom: 0; left: 0; width: 200%; height: 100%; background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800z' fill='rgba(255,255,255,0.4)'/%3E%3C/svg%3E"); background-size: 50% 100%; animation: moveWave 8s linear infinite; }
    .wave:nth-child(2) { bottom: 10px; opacity: 0.3; animation-duration: 12s; animation-direction: reverse; }
    .wave:nth-child(3) { bottom: 20px; opacity: 0.2; animation-duration: 15s; }

    .bubble { position: absolute; border-radius: 50%; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.9), rgba(255,255,255,0.1)); box-shadow: 0 0 10px rgba(255,255,255,0.3); z-index: 1; animation: bubbleUp linear infinite; }
    .b1 { width: 30px; height: 30px; left: 10%; animation-duration: 6s; }
    .b2 { width: 50px; height: 50px; left: 30%; animation-duration: 9s; animation-delay: 2s; }
    .b3 { width: 20px; height: 20px; left: 70%; animation-duration: 5s; animation-delay: 1s; }
    .b4 { width: 40px; height: 40px; left: 85%; animation-duration: 8s; animation-delay: 3s; }
    .b5 { width: 15px; height: 15px; left: 50%; animation-duration: 7s; animation-delay: 0s; }

    @keyframes bubbleUp { 0% { bottom: -50px; transform: translateX(0) scale(0.8); opacity: 0; } 20% { opacity: 0.8; } 100% { bottom: 100%; transform: translateX(-20px) scale(1.2); opacity: 0; } }
    @keyframes moveWave { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    .content-clock { position: relative; z-index: 5; padding: 40px; display: flex; flex-direction: column; justify-content: center; height: 100%; }
    .big-time { font-size: 7rem; font-weight: 800; line-height: 0.9; text-shadow: 0 10px 30px rgba(0,0,0,0.1); letter-spacing: -2px; animation: breathe 4s ease-in-out infinite; }
    @keyframes breathe { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.02); } }

    /* --- KARTU KIRI (MENU ABSENSI - ENHANCED) --- */
    .left-card {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 35px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        order: 1;
        position: relative;
        /* 1. Pola Background agar tidak polos */
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 24px 24px;
    }

    /* 2. Ikon Melayang di Background (Dekorasi) */
    .deco-icon {
        position: absolute;
        font-size: 6rem;
        opacity: 0.03;
        z-index: 0;
        pointer-events: none;
        animation: floatDeco linear infinite;
    }
    .deco-1 { top: 10%; right: 10%; animation-duration: 10s; }
    .deco-2 { bottom: 15%; left: 10%; animation-duration: 12s; animation-delay: 2s; }

    @keyframes floatDeco {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    .header-action { position: relative; z-index: 2; margin-bottom: 25px; }
    .header-action h2 { font-size: 1.6rem; font-weight: 800; color: var(--text-main); margin-bottom: 5px; }
    .header-action p { color: var(--text-light); margin-bottom: 25px; font-weight: 500; }

    /* Deadline Badge with Glow */
    .deadline-badge {
        position: relative; z-index: 2;
        background: #fff7ed;
        border: 1px solid #ffedd5;
        color: #c2410c;
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.1);
        animation: glowPulse 3s infinite alternate;
    }
    @keyframes glowPulse {
        from { box-shadow: 0 0 5px rgba(249, 115, 22, 0.2); border-color: #ffedd5; }
        to { box-shadow: 0 0 15px rgba(249, 115, 22, 0.4); border-color: #fdba74; }
    }

    /* Tombol dengan Efek Kilau (Shine) */
    .btn-action {
        position: relative; z-index: 2;
        width: 100%; padding: 18px; border: none; border-radius: 16px;
        font-family: inherit; font-weight: 700; font-size: 1rem;
        cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 12px;
        transition: all 0.3s; margin-bottom: 15px;
        overflow: hidden; /* Penting untuk efek shine */
    }

    /* Efek Kilau */
    .btn-action::before {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
        z-index: 1;
    }
    .btn-action:hover::before { left: 100%; }
    .btn-action span { z-index: 2; transition: transform 0.2s; }
    .btn-action:hover span { transform: scale(1.2) rotate(-10deg); }

    .btn-main { background: linear-gradient(90deg, #2563eb, #06b6d4); color: white; box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3); }
    .btn-main:hover { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4); }

    .btn-danger { background: linear-gradient(90deg, #ef4444, #f87171); color: white; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3); }
    .btn-danger:hover { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(239, 68, 68, 0.4); }

    .btn-outline { background: #f1f5f9; color: var(--text-light); border: 2px solid transparent; }
    .btn-outline:hover { background: white; border-color: var(--primary); color: var(--primary); }
    .btn-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    .status-working {
        background: #ecfdf5; border: 1px solid #a7f3d0; color: #059669;
        padding: 15px; border-radius: 12px; text-align: center; font-weight: 700; margin-bottom: 25px;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        animation: pulseStatus 2s infinite;
    }
    @keyframes pulseStatus { 0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); } 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); } }

    /* Modal */
    .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(5px); align-items: center; justify-content: center; }
    .modal-box { background: white; width: 90%; max-width: 380px; padding: 30px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    @keyframes popIn { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .form-group { margin-bottom: 20px; }
    .form-control { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px; font-family: inherit; }
    .form-control:focus { border-color: var(--primary); outline: none; background: #f0f9ff; }

    /* Animations Slide */
    @keyframes slideInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes slideInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
    .anim-left { animation: slideInLeft 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
    .anim-right { animation: slideInRight 0.8s 0.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }

    @media (max-width: 900px) {
        .split-layout { height: auto; padding: 80px 20px 20px; overflow-y: auto; }
        .dashboard-grid { grid-template-columns: 1fr; height: auto; gap: 20px; }
        .right-card, .left-card { order: initial; }
        .right-card { min-height: 350px; }
        .big-time { font-size: 5rem; }
    }

    .kalender {
    background:#f8fafc;
    border-radius:16px;
    padding:15px;
    font-size:0.85rem;
}

.kalender-header {
    text-align:center;
    font-weight:800;
    margin-bottom:10px;
}

.kalender-grid {
    display:grid;
    grid-template-columns: repeat(7, 1fr);
    gap:6px;
    text-align:center;
}

.kalender-day {
    font-weight:700;
    color:#64748b;
}

.kalender-date {
    padding:8px 0;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.kalender-date:hover {
    background:#e0f2fe;
}

.libur {
    background:#fee2e2;
    color:#991b1b;
}

.today {
    background:#2563eb;
    color:white;
}

</style>

<!-- SPLIT LAYOUT -->
<div class="split-layout">
    <div class="dashboard-grid">

        <!-- KARTU KIRI (TOMBOL AKSI) -->
        <div class="glass-card left-card anim-left">

            <!-- Dekorasi Icon Melayang (Agar Tidak Polos) -->
            <div class="deco-icon deco-1">📍</div>
            <div class="deco-icon deco-2">🏠</div>

            <div class="header-action">
                <h2>Menu Absensi</h2>
                <p>Lakukan aktivitas harian Anda.</p>
            </div>

            <!-- BADGE DEADLINE -->
            <div class="deadline-badge">
                <i class="fa-regular fa-clock"></i>
                Batas Absen Masuk: 10.00 WIB
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div style="background:#d1fae5; color:#065f46; padding:12px; border-radius:10px; margin-bottom:20px; text-align:center; font-weight:600; position:relative; z-index:2;">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:10px; margin-bottom:20px; text-align:center; font-weight:600; position:relative; z-index:2;">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

                        @if($isLibur)
                <div style="
                    background:#fee2e2;
                    color:#991b1b;
                    padding:16px;
                    border-radius:14px;
                    text-align:center;
                    font-weight:800;
                    margin-bottom:25px;
                    position:relative;
                    z-index:2;
                ">
                    🎌 LIBUR NASIONAL <br>
                    <span style="font-size:0.95rem; font-weight:600;">
                        {{ $namaLibur }}
                    </span>
                </div>
            @endif
            {{-- KALENDER LIBUR --}}
<div style="margin-bottom:25px; position:relative; z-index:2;">
    <div id="kalender"></div>
</div>


            {{-- LOGIKA --}}
             @if($isLibur)

            <div style="text-align:center; color:#991b1b; font-weight:700;">
                🎉 Hari ini libur nasional<br>
                <small>Absensi dinonaktifkan</small>
            </div>

        @elseif(!$absensiHariIni)


                <form action="{{ route('karyawan.absen.masuk') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-main">
                        <span style="font-size:1.3rem;">📍</span> Absen Masuk
                    </button>
                </form>

                <div class="btn-grid">
                    <button class="btn-action btn-outline" onclick="openModal()"><span>🏥</span> Sakit</button>
                    <button class="btn-action btn-outline" onclick="openModal()"><span>📝</span> Izin</button>
                </div>

            @elseif($absensiHariIni && $absensiHariIni->status_kehadiran === 'Hadir' && !$absensiHariIni->jam_pulang)

                <div class="status-working">
                    <span>⏳</span> Sedang Bekerja
                </div>

                <form action="{{ route('karyawan.absen.pulang') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-danger">
                        <span style="font-size:1.3rem;">🏠</span> Absen Pulang
                    </button>
                </form>

            @else
                <div style="text-align: center; color: var(--text-light); margin-top: 20px; position: relative; z-index:2;">
                    <div style="font-size: 4rem; margin-bottom: 10px;">🎉</div>
                    <h3>Selesai!</h3>
                    <p>Status: <strong>{{ $absensiHariIni->status_kehadiran }}</strong></p>
                </div>
            @endif

        </div>

        <!-- KARTU KANAN (JAM & ANIMASI) -->
        <div class="glass-card right-card anim-right">
            <div class="wave-container">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
            </div>

            <div class="bubble b1"></div>
            <div class="bubble b2"></div>
            <div class="bubble b3"></div>
            <div class="bubble b4"></div>
            <div class="bubble b5"></div>

            <div class="content-clock">
                <div class="big-time" id="clock">00:00</div>
            <div class="date-box"
        style="
            margin-top:10px;
            background: {{ $isLibur ? '#fee2e2' : 'white' }};
            color: {{ $isLibur ? '#991b1b' : 'var(--primary)' }};
        ">
        📅 {{ now()->format('l, d F Y') }}
        @if($isLibur)
            <div style="font-size:0.8rem; font-weight:700;">
                {{ $namaLibur }}
            </div>
        @endif
    </div>

            </div>
        </div>

    </div>
</div>

<!-- MODAL -->
<div class="modal" id="izinModal">
    <div class="modal-box">
        <h3 style="margin:0 0 20px 0; color:#1e293b;">Form Izin</h3>
        <form action="{{ route('karyawan.absen.izin') }}" method="POST">
            @csrf
            <div class="form-group">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:0.9rem;">Jenis Izin</label>
                <select name="status_kehadiran" class="form-control" required>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                </select>
            </div>
            <div class="form-group">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:0.9rem;">Alasan</label>
                <textarea name="keterangan" class="form-control" rows="3" required></textarea>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="button" class="btn-action btn-outline" style="margin-bottom:0;" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-action btn-main" style="margin-bottom:0;">Kirim</button>
            </div>
        </form>
    </div>
</div>

<script>
    setInterval(() => {
        const now = new Date();
        document.getElementById('clock').innerText =
            now.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
    }, 1000);

    function openModal() { document.getElementById('izinModal').style.display = 'flex'; }
    function closeModal() { document.getElementById('izinModal').style.display = 'none'; }
    window.onclick = (e) => { if(e.target == document.getElementById('izinModal')) closeModal(); };
    const liburData = @json($liburList);

function renderCalendar() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth();

    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    let html = `<div class="kalender">
        <div class="kalender-header">
            ${now.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' })}
        </div>
        <div class="kalender-grid">
            <div class="kalender-day">M</div>
            <div class="kalender-day">S</div>
            <div class="kalender-day">S</div>
            <div class="kalender-day">R</div>
            <div class="kalender-day">K</div>
            <div class="kalender-day">J</div>
            <div class="kalender-day">S</div>
    `;

    for (let i = 1; i < (firstDay === 0 ? 7 : firstDay); i++) {
        html += `<div></div>`;
    }

    for (let d = 1; d <= totalDays; d++) {
        const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
        const libur = liburData.find(l => l.tanggal === dateStr);

        let cls = 'kalender-date';
        if (libur) cls += ' libur';
        if (d === now.getDate()) cls += ' today';

        html += `
            <div class="${cls}" 
                 onclick="${libur ? `alert('Libur Nasional: ${libur.keterangan}')` : ''}">
                ${d}
            </div>`;
    }

    html += `</div></div>`;
    document.getElementById('kalender').innerHTML = html;
}

renderCalendar();

</script>

@endsection


