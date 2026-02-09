@extends('admin.template')

@section('title', 'Rekap Absensi')

@section('topbar')

    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Rekap Absensi</h1>
            <div class="user-profile">
                <span>Admin 👋</span>
                <div class="avatar-small">🛡️</div>
            </div>
        </div>
    </div>
@endsection

@section('content')


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


    body {
        font-family: 'Poppins', sans-serif;
        background: var(--bg-gradient);
        min-height: 100vh;
        margin: 0;
        color: var(--text-dark);
    }


    .container-custom {
        width: 100%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        position: relative;
        z-index: 10;
        padding-top: 100px;
    }


    @keyframes slideDown {
        from { transform: translateY(-100%); }
        to { transform: translateY(0); }
    }
    .animate-header { animation: slideDown 0.8s ease-out; }


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


    .search-container {
        background: #fff;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 25px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .search-input {
        flex: 1;
        padding: 12px 20px;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: border-color 0.3s;
    }
    .search-input:focus { border-color: var(--primary); outline: none; }
    .btn-search { background: var(--bg-gradient); color: white; border-radius: 12px; border:none; padding: 10px 25px; font-weight: 600; cursor: pointer; transition: opacity 0.3s; }
    .btn-search:hover { opacity: 0.9; }
    .btn-reset { background: transparent; color: #dc3545; border: 2px solid #dc3545; border-radius: 12px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
    .btn-reset:hover { background: #dc3545; color: white; }


    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .modern-table::ad tr {
        background: linear-gradient(90deg, var(--secondary), var(--primary));
        color: white;
    }
    .modern-table::ad th {
        padding: 18px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: white;
    }
    .modern-table::ad th:first-child { border-radius: 15px 0 0 0; }
    .modern-table::ad th:last-child { border-radius: 0 15px 0 0; }

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
        padding: 18px;
        color: #555;
        font-size: 0.95rem;
        vertical-align: middle;
    }
    .modern-table td:first-child { font-weight: 700; color: var(--secondary); }


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
    .btn-delete { background: #fee2e2; color: #ef4444; border: none; }
    .btn-delete:hover { background: #fecaca; transform: translateY(-2px); }


    .badge-stat {
        padding: 5px 12px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-block;
        min-width: 40px;
        text-align: center;
    }
    .stat-h { background: #d1fae5; color: #065f46; }
    .stat-i { background: #fef3c7; color: #92400e; }
    .stat-a { background: #fee2e2; color: #991b1b; }


    .alert-modern {
        background: #d1fae5; color: #065f46;
        padding: 15px; border-radius: 12px; margin-bottom: 25px;
        font-weight: 500; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 10px;
    }
    .empty-state { text-align: center; padding: 30px; color: #888; font-style: italic; }


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


        <div class="page-header">
            <h3 class="page-title">Rekap Absensi</h3>
            <a href="{{ route('rekap-absensi.create') }}" class="btn-modern btn-add">
                📊 Generate Rekap
            </a>
        </div>


        <form action="{{ route('rekap-absensi.index') }}" method="GET" class="search-container">
            <input type="text"
                   name="search"
                   class="search-input"
                   placeholder="Cari nama karyawan / bulan (YYYY-MM)..."
                   value="{{ request('search') }}">
            <button class="btn-search" type="submit">
                🔍 Cari
            </button>

            @if(request('search'))
                <a href="{{ route('rekap-absensi.index') }}" class="btn-reset">
                    🔄 Reset
                </a>
            @endif
        </form>

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
                        <th>Nama Karyawan</th>
                        <th>Bulan</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Alpha</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($rekap->count() == 0)
                        <tr>
                            <td colspan="7" class="empty-state">
                                Data rekap absensi tidak ditemukan
                            </td>
                        </tr>
                    @endif

                    @foreach($rekap as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $r->karyawan->nama_karyawan ?? '-' }}</strong></td>
                            <td>{{ $r->bulan }}</td>
                            <td><span class="badge-stat stat-h">{{ $r->jumlah_hadir }}</span></td>
                            <td><span class="badge-stat stat-i">{{ $r->jumlah_izin }}</span></td>
                            <td><span class="badge-stat stat-a">{{ $r->jumlah_alpha }}</span></td>
                            <td>
                                <form action="{{ route('rekap-absensi.delete', $r->id_rekap) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin hapus data ini?')"
                                            class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
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
