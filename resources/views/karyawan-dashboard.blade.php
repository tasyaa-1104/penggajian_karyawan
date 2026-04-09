@extends('template')

@section('title', 'Dashboard Karyawan')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Dashboard Karyawan</h1>
            <div class="user-profile">
                <span>Hi, {{ $karyawan->nama_karyawan }} </span>
                <div class="avatar-small">👤</div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- CSS STYLING WEBSITE RESPONSIVE + TEMA MERAH TUA -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #8B0000;
        --primary-dark: #5c0000;
        --secondary: #8B0000;
        --text-dark: #333;
        --glass: rgba(255, 255, 255, 0.95);
        --shadow: 0 10px 30px rgba(139, 0, 0, 0.1);
        --shadow-hover: 0 15px 35px rgba(139, 0, 0, 0.2);
        --bg-gradient: linear-gradient(135deg, #fff0f0 0%, #ffffff 100%);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--bg-gradient);
        min-height: 100vh;
        margin: 0;
        color: var(--text-dark);
        overflow-x: hidden;
    }

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

    /* --- HEADER WEBSITE --- */
    .website-header {
        position: fixed;
        top: 0; left: 0; width: 100%;
        height: 80px;
        background: rgba(255, 255, 255, 0.95);
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
        width: 40px; height: 40px; background: var(--bg-gradient); color: var(--primary); border-radius: 50%;
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

    /* --- CARD BASE STYLE --- */
    .card {
        background: var(--glass);
        padding: 30px;
        border-radius: 24px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(255,255,255,0.8);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }

    .card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
        background: linear-gradient(90deg, var(--primary), #cc0000);
        border-radius: 24px 24px 0 0;
        opacity: 0.8;
    }

    /* --- STATS CARDS --- */
    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 25px;
        min-height: 100px;
    }

    .stat-icon-lg {
        width: 55px; height: 55px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center; font-size: 1.8rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .stat-card:hover .stat-icon-lg { transform: scale(1.1); }

    .bg-hadir { background: #E8F5E9; color: #2E7D32; }
    .bg-izin { background: #FFF3E0; color: #F57C00; }
    .bg-alpha { background: #FFEBEE; color: #D32F2F; }

    .stat-info h3 { margin: 0; font-size: 2rem; font-weight: 700; line-height: 1; }
    .stat-info p { margin: 5px 0 0 0; font-size: 0.85rem; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

    /* --- PROFILE CARD --- */
    .profile-container { display: flex; align-items: center; gap: 25px; flex-wrap: wrap; position: relative; z-index: 2; }

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
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 3rem; color: white;
        box-shadow: 0 10px 20px rgba(139, 0, 0, 0.4);
        z-index: 2;
    }
    .profile-details { flex: 1; z-index: 2; }
    .profile-details h2 { font-size: 1.8rem; margin: 0 0 5px 0; color: var(--text-dark); }

    .nik-badge {
        background: #fff;
        padding: 6px 15px; border-radius: 50px;
        font-size: 0.85rem; font-weight: 600; color: var(--primary-dark);
        display: inline-block; margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .info-grid-web { display: grid; gap: 12px; margin-top: 20px; z-index: 2; }
    .info-item-web {
        display: flex; align-items: center; background: rgba(255,255,255,0.8);
        padding: 12px 15px; border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .info-icon-web { font-size: 1.3rem; margin-right: 15px; width: 35px; text-align: center; color: var(--primary); }
    .info-text { display: flex; flex-direction: column; }
    .info-label-web { font-size: 0.75rem; color: #888; margin-bottom: 2px; font-weight: 600; }
    .info-value-web { font-size: 1rem; font-weight: 600; color: #333; }

    /* --- SLIP GAJI BUTTON (SETENGAH, KIRI) --- */
    .slip-gaji-section {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 2px dashed rgba(139, 0, 0, 0.12);
        position: relative;
        z-index: 2;
    }

    .btn-slip-gaji {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 55%;
        padding: 15px 24px;
        background: linear-gradient(135deg, var(--primary) 0%, #b30000 50%, var(--primary) 100%);
        background-size: 200% 200%;
        color: #fff;
        text-decoration: none;
        border-radius: 14px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        border: none;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(139, 0, 0, 0.3), inset 0 1px 0 rgba(255,255,255,0.15);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-slip-gaji::before {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
        transition: left 0.5s ease;
    }
    .btn-slip-gaji:hover::before { left: 100%; }

    .btn-slip-gaji:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(139, 0, 0, 0.4), inset 0 1px 0 rgba(255,255,255,0.2);
        background-position: 100% 100%;
    }
    .btn-slip-gaji:active { transform: translateY(-1px); }

    .btn-slip-gaji .btn-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .btn-slip-gaji .btn-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        line-height: 1.2;
    }
    .btn-slip-gaji .btn-label {
        font-size: 0.7rem;
        font-weight: 400;
        opacity: 0.85;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .btn-slip-gaji .btn-title {
        font-size: 0.95rem;
        font-weight: 700;
    }

    .btn-slip-gaji .btn-arrow {
        margin-left: auto;
        font-size: 0.85rem;
        opacity: 0;
        transform: translateX(-8px);
        transition: all 0.3s ease;
    }
    .btn-slip-gaji:hover .btn-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    @media (max-width: 640px) {
        .btn-slip-gaji { width: 80%; }
    }

    /* --- SALARY CARD --- */
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
        background: rgba(255,255,255,0.8);
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .salary-label { font-size: 0.9rem; color: #666; text-transform: uppercase; letter-spacing: 1px; margin: 0; }
    .salary-amount {
        font-size: 2.2rem; font-weight: 800;
        color: var(--primary);
        margin: 10px 0;
    }

    .btn-web {
        display: block; width: 100%; padding: 16px;
        background: linear-gradient(to right, var(--primary), #cc0000);
        color: white; text-align: center; text-decoration: none;
        border-radius: 16px; font-weight: 600; margin-top: auto;
        transition: transform 0.2s, opacity 0.2s; box-shadow: 0 4px 15px rgba(139, 0, 0, 0.3); z-index: 2; position: relative;
        border: none; cursor: pointer;
    }
    .btn-web:hover { transform: translateY(-2px); opacity: 0.95; box-shadow: 0 6px 20px rgba(139, 0, 0, 0.4); }

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

    <!-- 1. STATS ROW -->
    <div class="dashboard-grid">
        <div class="card stat-card animate-up delay-1">
            <div class="stat-icon-lg bg-hadir">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalHadir ?? 0 }}</h3>
                <p>Hadir</p>
            </div>
        </div>

        <div class="card stat-card animate-up delay-2">
            <div class="stat-icon-lg bg-izin">
                <i class="fa-solid fa-calendar-minus"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalIzin ?? 0 }}</h3>
                <p>Izin/Sakit</p>
            </div>
        </div>

        <div class="card stat-card animate-up delay-3">
            <div class="stat-icon-lg bg-alpha">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalAlpha ?? 0 }}</h3>
                <p>Alpha</p>
            </div>
        </div>
    </div>

    <!-- 2. MAIN CONTENT -->
    <div class="main-grid">

        <!-- KARTU INFO KARYAWAN -->
        <div class="card profile-card animate-up delay-4">
            <div class="card-header">
                <div class="header-dot" style="background: var(--primary);"></div>
                <h2 style="margin:0;">Profil Karyawan</h2>
            </div>

            <div class="profile-container">
                <div class="profile-avatar-lg">👤</div>

                <div class="profile-details">
                    <h2>{{ $karyawan->nama_karyawan }}</h2>
                    <div class="nik-badge">NIK: {{ $karyawan->nik }}</div>

                    <div class="info-grid-web">
                        <div class="info-item-web">
                            <div class="info-icon-web"><i class="fa-solid fa-building"></i></div>
                            <div class="info-text">
                                <span class="info-label-web">Divisi</span>
                                <span class="info-value-web">{{ $karyawan->divisi->nama_divisi }}</span>
                            </div>
                        </div>
                        <div class="info-item-web">
                            <div class="info-icon-web"><i class="fa-solid fa-briefcase"></i></div>
                            <div class="info-text">
                                <span class="info-label-web">Jabatan</span>
                                <span class="info-value-web">{{ $karyawan->jabatan->nama_jabatan }}</span>
                            </div>
                        </div>
                        <div class="info-item-web">
                            <div class="info-icon-web"><i class="fa-solid fa-money-bill-wave"></i></div>
                            <div class="info-text">
                                <span class="info-label-web">Gaji Pokok</span>
                                <span class="info-value-web">Rp {{ number_format($karyawan->gaji_pokok,0,',','.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOMBOL SLIP GAJI — setengah lebar, kiri -->
            <div class="slip-gaji-section">
                <a href="{{ route('karyawan.slip-gaji.download') }}" class="btn-slip-gaji">
                    <span class="btn-icon">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </span>
                    <span class="btn-text">
                        <span class="btn-label">Dokumen</span>
                        <span class="btn-title">Lihat Slip Gaji</span>
                    </span>
                    <span class="btn-arrow">
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>


        <!-- KARTU HISTORY ABSEN & CUTI TERPISAH -->
        <div class="row" style="display: flex; gap: 24px; flex-wrap: wrap;">
            <div class="card animate-up delay-5" style="flex:1 1 350px; min-width:300px;">
                <div class="card-header">
                    <div class="header-dot" style="background:#8B0000;"></div>
                    <h2>History Absen</h2>
                </div>
                <p style="margin-bottom:15px; color: #666;">Riwayat absensi Anda.</p>
                <div style="overflow-x:auto;">
                    <table class="table" style="width:100%; background:#fff; border-radius:8px; box-shadow:0 2px 8px #eee;">
                        <thead style="background:#f8d7da;">
                            <tr>
                                <th style="padding:8px;">Tanggal</th>
                                <th style="padding:8px;">Jam Masuk</th>
                                <th style="padding:8px;">Jam Pulang</th>
                                <th style="padding:8px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absensi as $absen)
                            <tr>
                                <td style="padding:8px;">{{ $absen->tanggal }}</td>
                                <td style="padding:8px;">{{ $absen->jam_masuk }}</td>
                                <td style="padding:8px;">{{ $absen->jam_pulang }}</td>
                                <td style="padding:8px;">{{ $absen->status_kehadiran }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card animate-up delay-5" style="flex:1 1 350px; min-width:300px;">
                <div class="card-header">
                    <div class="header-dot" style="background:#8B0000;"></div>
                    <h2>History Cuti</h2>
                </div>
                <p style="margin-bottom:15px; color: #666;">Riwayat cuti Anda.</p>
                <div style="overflow-x:auto;">
                    <table class="table" style="width:100%; background:#fff; border-radius:8px; box-shadow:0 2px 8px #eee;">
                        <thead style="background:#f8d7da;">
                            <tr>
                                <th style="padding:8px;">Periode</th>
                                <th style="padding:8px;">Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cuti as $c)
                            <tr>
                                <td style="padding:8px;">{{ $c->tanggal_mulai }} s/d {{ $c->tanggal_selesai }}</td>
                                <td style="padding:8px;">{{ $c->alasan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endisset

<style>
/* MODAL STYLING */
.modal {
    display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;
    backdrop-filter: blur(5px); opacity: 0; transition: opacity 0.3s;
}
.modal.show { opacity: 1; }
.modal-box {
    background: white; width: 90%; max-width: 450px; border-radius: 16px; padding: 30px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2); position: relative; transform: scale(0.9); transition: transform 0.3s;
    border-top: 5px solid #8B0000;
}
.modal.show .modal-box { transform: scale(1); }
.modal-header { text-align: center; margin-bottom: 25px; }
.modal-icon { font-size: 3rem; margin-bottom: 10px; display: block; }
.modal-header h3 { margin: 0; color: #8B0000; font-size: 1.4rem; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 5px; color: #555; }
.form-control {
    width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;
    font-family: 'Poppins', sans-serif;
}
.form-control:focus { outline: none; border-color: #8B0000; }
.modal-buttons { display: flex; gap: 10px; margin-top: 25px; }
.btn-submit { flex: 1; background: #8B0000; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; }
.btn-cancel { flex: 1; background: #f5f5f5; color: #666; border: 1px solid #ddd; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; }
.btn-cancel:hover { background: #e0e0e0; }
</style>

@endsection
