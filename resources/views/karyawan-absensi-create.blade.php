
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

    body {
        background: #f1f5f9;
        font-family: 'Outfit', sans-serif;
    }

    /* --- LAYOUT UTAMA (Auto Height) --- */
    .split-layout {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: #e0f2fe;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 20px;
        width: 100%;
        max-width: 900px;
        /* TIDAK ADA HEIGHT TETAP, Supaya TIDAK KEPOTONG */
        min-height: 500px;
        height: auto;
        align-items: stretch; /* Agar kiri ikut memanjang saat kanan memanjang */
        position: relative;
        z-index: 10;
    }

    /* --- KARTU KIRI (AKSI) --- */
    .glass-card {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px -5px rgba(79, 172, 254, 0.15);
        display: flex;
        flex-direction: column;
    }

    .left-card {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Agar isi tersebar rapi saat kartu memanjang */
    }

    .header-action h2 { font-size: 1.35rem; font-weight: 800; color: var(--text-main); margin: 0 0 5px 0; letter-spacing: -0.5px; }
    .header-action p { color: var(--text-light); font-size: 0.85rem; font-weight: 500; margin: 0 0 20px 0; }

    .deadline-badge {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5;
        padding: 8px 12px; border-radius: 50px;
        font-size: 0.75rem; font-weight: 700; margin-bottom: 20px;
    }

    .btn-action {
        width: 100%; padding: 14px; border: none; border-radius: 14px;
        font-family: inherit; font-weight: 700; font-size: 0.9rem;
        cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
        transition: all 0.2s; margin-bottom: 10px;
    }
    .btn-action:hover { transform: translateY(-2px); }
    .btn-action:active { transform: scale(0.98); }

    .btn-main { background: linear-gradient(135deg, #2563eb, #06b6d4); color: white; box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3); }
    .btn-danger { background: linear-gradient(135deg, #ef4444, #f87171); color: white; box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3); }
    .btn-outline { background: #f8fafc; color: var(--text-light); border: 2px solid #e2e8f0; }
    .btn-outline:hover { border-color: var(--primary); color: var(--primary); background: white; }

    .btn-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

    .status-working {
        background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;
        padding: 12px; border-radius: 12px; text-align: center; font-weight: 700; margin-bottom: 15px;
        display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 0.9rem;
    }

    /* --- KARTU KANAN (JAM & KALENDER) --- */
    .right-card {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        position: relative;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(255,255,255,0.3);
        /* Tidak ada height fixed, biar bisa memanjang */
    }

    .bg-decoration { position: absolute; width: 100%; height: 100%; top: 0; left: 0; pointer-events: none; overflow: hidden; }
    .circle { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.1); animation: floatCircle 10s infinite ease-in-out; }
    .c1 { width: 150px; height: 150px; top: -50px; right: -50px; }
    .c2 { width: 100px; height: 100px; bottom: 20%; left: -20px; animation-delay: 2s; }
    @keyframes floatCircle { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(20px); } }

    .clock-section {
        flex: 0 0 auto; /* Jangan membesar secara paksa */
        padding: 40px 20px 10px 20px;
        text-align: center;
        position: relative; z-index: 2;
    }
    .big-time { font-size: 4rem; font-weight: 800; line-height: 1; text-shadow: 0 4px 15px rgba(0,0,0,0.1); letter-spacing: -2px; }
    .date-display { font-size: 0.9rem; font-weight: 600; opacity: 0.9; margin-top: 5px; background: rgba(255,255,255,0.2); display: inline-block; padding: 4px 15px; border-radius: 20px; backdrop-filter: blur(5px); }

    /* Tombol Toggle */
    .toggle-calendar-btn {
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        margin: 15px auto 20px auto;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: all 0.3s;
        position: relative; z-index: 5;
        width: fit-content;
    }
    .toggle-calendar-btn:hover { background: white; color: var(--primary); transform: scale(1.05); }

    /* Container Kalender */
    .calendar-wrapper {
        background: #ffffff;
        margin: 0 20px 20px 20px; /* Margin bawah agar tidak nempel ke bawah */
        border-radius: 20px;
        padding: 20px;
        color: var(--text-main);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        position: relative; z-index: 5;
        display: none; /* Hidden by default */
        animation: slideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    /* Style Kalender */
    .kalender-header { text-align: center; font-weight: 800; font-size: 1rem; color: var(--text-main); margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; }
    .kalender-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; width: 100%; }
    .kalender-day { text-align: center; font-size: 0.7rem; font-weight: 700; color: #94a3b8; padding-bottom: 8px; text-transform: uppercase; }
    .kalender-date { aspect-ratio: 1 / 1; display: grid; place-items: center; font-size: 0.85rem; font-weight: 600; border-radius: 10px; cursor: pointer; transition: all 0.2s; color: #475569; }
    .kalender-date:hover { background-color: #f1f5f9; color: var(--primary); }
    .kalender-date.today { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(79, 172, 254, 0.4); font-weight: 700; }
    .kalender-date.libur { background: #fee2e2; color: #ef4444; }

    /* Modal */
    .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); align-items: center; justify-content: center; }
    .modal-box { background: white; width: 90%; max-width: 380px; padding: 30px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    @keyframes popIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .form-group { margin-bottom: 15px; }
    .form-control { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px; font-family: inherit; font-size: 0.95rem; }
    .form-control:focus { border-color: var(--primary); outline: none; background: #f0f9ff; }

    /* Animations */
    @keyframes slideInLeft { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes slideInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    .anim-left { animation: slideInLeft 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
    .anim-right { animation: slideInRight 0.6s 0.1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }

    @media (max-width: 800px) {
        .split-layout { height: auto; padding: 20px 15px; display: block; }
        .dashboard-grid { grid-template-columns: 1fr; height: auto; min-height: auto; gap: 20px; max-width: 100%; }
        .right-card { min-height: 350px; order: -1; }
        .big-time { font-size: 3.5rem; }
        .left-card { min-height: auto; }
    }
</style>

<!-- DASHBOARD CONTAINER -->
<div class="split-layout">
    <div class="dashboard-grid">

        <!-- KARTU KIRI (TOMBOL) -->
        <div class="glass-card left-card anim-left">
            <div>
                <div class="header-action">
                    <h2>Menu Absensi</h2>
                    <p>Silakan lakukan absensi hari ini.</p>
                </div>

                <div class="deadline-badge">
                    <i class="fa-regular fa-clock"></i> Batas: 10.00 WIB
                </div>

                @if(session('success'))
                    <div style="background:#d1fae5; color:#065f46; padding:12px; border-radius:12px; margin-bottom:15px; text-align:center; font-weight:700; font-size:0.85rem; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:12px; margin-bottom:15px; text-align:center; font-weight:700; font-size:0.85rem; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                @if($isLibur)
                    <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:12px; text-align:center; font-weight:800; margin-bottom:15px; font-size:0.9rem; border:1px solid #fca5a5;">
                        🎌 LIBUR NASIONAL <br>
                        <span style="font-weight:600; font-size:0.85rem;">{{ $namaLibur }}</span>
                    </div>
                @endif
            </div>

            {{-- LOGIKA --}}
            @if($isLibur)
                <div style="text-align:center; color:#991b1b; font-weight:700; padding:15px; background:#fff5f5; border-radius:12px; border:1px dashed #fca5a5;">
                    🎉 Hari ini libur<br>Absensi dinonaktifkan
                </div>

            @elseif(!$absensiHariIni)
                <form action="{{ route('karyawan.absen.masuk') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-main">
                        <span>📍</span> Absen Masuk
                    </button>
                    <div class="btn-grid">
                        <button type="button" class="btn-action btn-outline" onclick="openModal()"><span>🏥</span> Sakit</button>
                        <button type="button" class="btn-action btn-outline" onclick="openModal()"><span>📝</span> Izin</button>
                    </div>
                </form>

            @elseif($absensiHariIni && $absensiHariIni->status_kehadiran === 'Hadir' && !$absensiHariIni->jam_pulang)
                <div class="status-working">
                    <span>⏳</span> Sedang Bekerja
                </div>
                <form action="{{ route('karyawan.absen.pulang') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-danger">
                        <span>🏠</span> Absen Pulang
                    </button>
                </form>

            @else
                <div style="text-align: center; color: var(--text-light); padding: 20px;">
                    <div style="font-size: 2.5rem; margin-bottom: 5px;">🎉</div>
                    <h3 style="color:var(--text-main); font-size:1.1rem;">Selesai!</h3>
                    <p style="font-size:0.85rem;">Status: <strong>{{ $absensiHariIni->status_kehadiran }}</strong></p>
                </div>
            @endif

        </div>

        <!-- KARTU KANAN (JAM & KALENDER) -->
        <div class="glass-card right-card anim-right">

            <div class="bg-decoration">
                <div class="circle c1"></div>
                <div class="circle c2"></div>
            </div>

            <!-- JAM -->
            <div class="clock-section">
                <div class="big-time" id="clock">00:00</div>
                <div class="date-display">
                    📅 {{ now()->format('l, d F Y') }}
                </div>
            </div>

            <!-- TOMBOL TOGGLE KALENDER -->
            <button class="toggle-calendar-btn" onclick="toggleCalendar()">
                <span id="calendar-icon">📅</span> <span id="calendar-text">Lihat Jadwal Libur</span>
            </button>

            <!-- CONTAINER KALENDER (TIDAK AKAN KEPOTONG KARENA HEIGHT AUTO) -->
            <div id="calendar-wrapper" class="calendar-wrapper">
                <div id="kalender"></div>
            </div>
        </div>

    </div>
</div>

<!-- MODAL -->
<div class="modal" id="izinModal">
    <div class="modal-box">
        <h3 style="margin:0 0 20px 0; color:#1e293b; font-weight:800;">Form Izin</h3>
        <form action="{{ route('karyawan.absen.izin') }}" method="POST">
            @csrf
            <div class="form-group">
                <label style="display:block; margin-bottom:8px; font-weight:700; font-size:0.9rem; color:#64748b;">Jenis Izin</label>
                <select name="status_kehadiran" class="form-control" required>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                </select>
            </div>
            <div class="form-group">
                <label style="display:block; margin-bottom:8px; font-weight:700; font-size:0.9rem; color:#64748b;">Alasan</label>
                <textarea name="keterangan" class="form-control" rows="3" required placeholder="Tulis alasan anda..."></textarea>
            </div>
            <div style="display:flex; gap:10px; margin-top:25px;">
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

    // --- FUNGSI TOGGLE KALENDER ---
    function toggleCalendar() {
        const wrapper = document.getElementById('calendar-wrapper');
        const btnText = document.getElementById('calendar-text');
        const btnIcon = document.getElementById('calendar-icon');

        if (wrapper.style.display === 'none') {
            // Tampilkan
            wrapper.style.display = 'block';
            btnText.innerText = "Tutup Jadwal";
            btnIcon.innerText = "✖";
        } else {
            // Sembunyikan
            wrapper.style.display = 'none';
            btnText.innerText = "Lihat Jadwal Libur";
            btnIcon.innerText = "📅";
        }
    }

    // --- LOGIKA KALENDER (TETAP SAMA) ---
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
