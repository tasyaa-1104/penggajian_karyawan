{{-- @extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>tambah tunjangan</h4>

       @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tunjangan.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label>nama tunjangan</label>
            <input type="text" name="nama_tunjangan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <button class="btn btn-success">simpan</button>
        <a href="{{ route('tunjangan.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection --}}
@extends('admin.template')

@section('title', 'Generate Rekap')

@section('topbar')
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Generate Rekap</h1>
            <div class="user-profile">
                <span>Admin 👋</span>
                <div class="avatar-small">🛡️</div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- CSS STYLING (GLASS CARD STYLE - SAMA DENGAN REKAP/INDEX) -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #4facfe;
        --secondary: #667eea;
        --text-dark: #333;
        --glass: rgba(255, 255, 255, 0.95);
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --bg-gradient: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--bg-gradient);
        min-height: 100vh;
        margin: 0;
        color: var(--text-dark);
        overflow-x: hidden;
    }

    .container-custom {
        width: 100%;
        max-width: 800px; /* Ukuran lebih kecil untuk form */
        margin: 40px auto;
        padding: 20px;
        position: relative;
        z-index: 10;
        padding-top: 100px;
    }

    /* Animasi Header */
    @keyframes slideDown { from { transform: translateY(-100%); } to { transform: translateY(0); } }
    .animate-header { animation: slideDown 0.8s ease-out; }

    /* Header */
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

    /* Glass Card */
    .glass-card {
        background: var(--glass); border-radius: 24px; box-shadow: var(--shadow);
        border: 1px solid rgba(255,255,255,0.6); padding: 30px;
        position: relative; overflow: hidden;
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px); background-size: 20px 20px;
    }
    .glass-card::after {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px;
        background: linear-gradient(90deg, var(--secondary), var(--primary));
    }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .page-title { font-size: 1.8rem; color: var(--text-dark); margin: 0; font-weight: 700; }

    /* Buttons (Glass Style) */
    .btn-modern {
        padding: 12px 25px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem;
        cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-add { background: linear-gradient(to right, #11998e, #38ef7d); color: white; }
    .btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(56, 239, 125, 0.4); }
    .btn-back { background: #e2e8f0; color: #64748b; }
    .btn-back:hover { background: #cbd5e1; color: #333; }

    /* Form Style (Modern) */
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.9rem; color: #555; margin-left: 5px; }
    .form-control {
        width: 100%; padding: 14px 20px; border: 2px solid #eee; border-radius: 12px;
        box-sizing: border-box; font-family: inherit; font-size: 1rem; transition: all 0.3s;
        background: #f9fafb; color: #333;
    }
    .form-control:focus { border-color: var(--primary); outline: none; background: #fff; box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1); }

    /* Alert */
    .alert-modern {
        background: #fee2e2; color: #991b1b;
        padding: 15px; border-radius: 12px; margin-bottom: 25px;
        font-weight: 500; border: 1px solid #fecaca;
    }

    /* WAVE */
    .waves { position: fixed; bottom: 0; left: 0; width: 100%; height: 15vh; margin-bottom: -7px; min-height: 100px; max-height: 150px; z-index: 1; pointer-events: none; }
    .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }
    @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }
</style>

<div class="container-custom">
    <div class="glass-card">

        <!-- Header & Tombol Kembali -->
        <div class="page-header">
            <h3 class="page-title">Generate Rekap</h3>
            <a href="{{ route('rekap-absensi.index') }}" class="btn-modern btn-back">
                ⬅️ Kembali
            </a>
        </div>

        <!-- Alert Validasi Error -->
        @if ($errors->any())
            <div class="alert-modern">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Input -->
        <form action="{{ route('rekap-absensi.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label>Pilih Bulan Rekap</label>
                <input type="month"
                       name="bulan" class="form-control"
                       placeholder="Pilih Bulan (YYYY-MM)"
                       required>
                <small style="color: #888; font-style: italic; margin-top: 5px; display: block;">
                    Pilih bulan untuk melakukan rekapitasi absensi bulanan.
                </small>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 20px;">
                <button type="submit" class="btn-modern btn-add">
                    📊 Generate Data
                </button>

                <a href="{{ route('rekap-absensi.index') }}" class="btn-modern btn-back">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>

</div>

<!-- WAVE ANIMATION -->
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88 18 58 18 88 18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" />
        <use xlink:href="#gentle-wave" x="48" y="3" />
        <use xlink:href="#gentle-wave" x="48" y="5" />
        <use xlink:href="#gentle-wave" x="48" y="7" />
    </g>
</svg>

@endsection
