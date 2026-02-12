@extends('admin.template')

@section('title', 'Data Gaji')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Data Gaji Karyawan</h1>
            <div class="user-profile">
                <span>Admin 👋</span>
                <div class="avatar-small">🛡️</div>
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
    }

    /* CONTAINER UTAMA */
    .container-custom {
        width: 100%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
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

    /* HEADER STYLE */
    .website-header {
        position: fixed; top: 0; left: 0; width: 100%; height: 80px;
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
        z-index: 100; border-bottom: 1px solid rgba(0,0,0,0.05);
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

    /* GLASS CARD WRAPPER */
    .glass-card {
        background: var(--glass);
        border-radius: 24px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(255,255,255,0.6);
        padding: 30px;
        position: relative;
        overflow: hidden;
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px);
        background-size: 20px 20px;
    }
    .glass-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 5px;
        background: linear-gradient(90deg, var(--secondary), var(--primary));
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .page-title {
        font-size: 1.8rem;
        color: var(--text-dark);
        margin: 0;
        font-weight: 700;
    }

    /* BUTTONS */
    .btn-modern {
        padding: 12px 25px;
        border-radius: 50px;
        border: none;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-add { background: linear-gradient(to right, #11998e, #38ef7d); color: white; }
    .btn-add:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(56, 239, 125, 0.4); }

    /* TABEL MODERN */
   /* TABEL MODERN */
.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

/* ❌ SALAH: ::ad */
/* ✅ BENAR: thead */
.modern-table thead tr {
    background: linear-gradient(90deg, var(--secondary), var(--primary));
    color: white;
}

.modern-table thead th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    color: white;
    white-space: nowrap; /* 🔥 Biar teks gak nempel */
}

.modern-table thead th:first-child {
    border-radius: 15px 0 0 0;
}

.modern-table thead th:last-child {
    border-radius: 0 15px 0 0;
}

    .modern-table tbody tr {
        background: rgba(255,255,255,0.7);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }
    .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.005);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        z-index: 2;
        position: relative;
    }
    .modern-table td {
        padding: 15px;
        color: #555;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .modern-table td:first-child { font-weight: 700; color: var(--secondary); }

    /* Format Uang Monospace */
    .currency-text {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #333;
    }
    .currency-bold {
        color: var(--secondary);
        font-weight: 800;
    }

    /* TOMBOL AKSI KECIL */
    .btn-action-sm {
        padding: 8px 15px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center; gap: 5px;
        transition: all 0.2s;
    }

    /* Warna tombol aksi berbeda */
    .btn-slip-view { background: linear-gradient(to right, #4facfe, #00f2fe); color: white; } /* Biru */
    .btn-slip-view:hover { transform: translateY(-2px); filter: brightness(1.1); }

    .btn-slip-create { background: linear-gradient(to right, #11998e, #38ef7d); color: white; } /* Hijau */
    .btn-slip-create:hover { transform: translateY(-2px); filter: brightness(1.1); }

    .btn-delete { background: #fee2e2; color: #ef4444; border: none; }
    .btn-delete:hover { background: #fecaca; transform: translateY(-2px); }

    /* ALERT */
    .alert-modern {
        background: #d1fae5; color: #065f46;
        padding: 15px; border-radius: 12px; margin-bottom: 25px;
        font-weight: 500; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 10px;
    }
    .empty-state { text-align: center; padding: 30px; color: #888; font-style: italic; }

    /* WAVE ANIMATION */
    .waves { position: fixed; bottom: 0; left: 0; width: 100%; height: 15vh; margin-bottom: -7px; min-height: 100px; max-height: 150px; z-index: 1; pointer-events: none; }
    .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }
    @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }
</style>

<div class="container-custom">

    <!-- GLASS CARD CONTAINER -->
    <div class="glass-card">

        <!-- HEADER & TOMBOL HITUNG -->
        <div class="page-header">
            <h4 class="page-title">Data Gaji Karyawan</h4>
            <a href="{{ route('gaji.create') }}" class="btn-modern btn-add">
                🧮 Hitung Gaji
            </a>
        </div>

        <!-- ALERT SUKSES -->
        @if(session('success'))
            <div class="alert-modern">
                <span style="font-size: 1.2rem;">✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- TABEL MODERN -->
        <div style="overflow-x: auto;">
            <table class="modern-table">
               <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Bulan</th>
        <th>Tunjangan</th>
        <th>Lembur</th>
        <th>Potongan</th>
        <th>Gaji Bersih</th>
        <th>Aksi</th>
    </tr>
</thead>

                <tbody>
                    @if($gaji->count() == 0)
                        <tr>
                            <td colspan="9" class="empty-state">

                                Data gaji tidak ditemukan
                            </td>
                        </tr>
                    @endif

                    @foreach($gaji as $g)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $g->karyawan->nama_karyawan }}</strong></td>
                            <td><small>{{ $g->karyawan->jabatan->nama_jabatan }}</small></td>
                            <td>{{ $g->bulan }}</td>
                           <td>
    <span class="currency-text">
        Rp {{ number_format($g->total_tunjangan,0,',','.') }}
    </span>
</td>

{{-- 🔥 TOTAL LEMBUR --}}
<td>
    <span class="currency-text">
        Rp {{ number_format($g->total_overtime ?? 0,0,',','.') }}
    </span>
</td>

<td>
    <span class="currency-text">
        Rp {{ number_format($g->total_potongan,0,',','.') }}
    </span>
</td>

                            <td>
                                <strong class="currency-text currency-bold">
                                    Rp {{ number_format($g->gaji_bersih,0,',','.') }}
                                </strong>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">

                                    @if ($g->slipGaji)
                                        <a href="{{ route('admin.slip-gaji.show', $g->slipGaji->id_slip) }}"
                                           class="btn-action-sm btn-slip-view">
                                            📄 Lihat Slip
                                        </a>
                                    @else
                                        <form action="{{ route('admin.slip-gaji.store', $g->id_gaji) }}"
                                              method="POST" style="display: inline;">
                                            @csrf
                                            <button class="btn-action-sm btn-slip-create">
                                                📝 Buat Slip
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('gaji.destroy',$g->id_gaji) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action-sm btn-delete"
                                                onclick="return confirm('Yakin ingin menghapus data gaji ini?')">
                                            🗑️
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
