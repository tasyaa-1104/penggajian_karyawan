{{-- @extends('admin.template')

@section('title', 'Data Absensi')

@section('topbar')

    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Manajemen Absensi</h1>
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
    .modern-table tbody tr { font-size: 0.9rem; } /* Font sedikit lebih kecil karena kolom banyak */

    .modern-table::ad tr {
        background: linear-gradient(90deg, var(--secondary), var(--primary));
        color: white;
    }
    .modern-table::ad th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
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
        padding: 15px;
        color: #555;
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
    .btn-edit { background: linear-gradient(to right, #f6d365, #fda085); color: white; }
    .btn-edit:hover { filter: brightness(1.1); transform: translateY(-2px); }

    .btn-delete { background: #fee2e2; color: #ef4444; border: none; }
    .btn-delete:hover { background: #fecaca; transform: translateY(-2px); }


    .badge-absensi {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-hadir { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .badge-izin { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .badge-sakit { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .badge-alpha { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }


    .alert-modern {
        background: #fee2e2; color: #991b1b;
        padding: 15px; border-radius: 12px; margin-bottom: 20px;
        font-weight: 500; border: 1px solid #fecaca;
    }
    .alert-success-modern {
        background: #d1fae5; color: #065f46;
        padding: 15px; border-radius: 12px; margin-bottom: 20px;
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
            <h3 class="page-title">Data Absensi</h3>

        </div>


        @if ($errors->any())
            <div class="alert-modern">
                <i class="fa fa-exclamation-circle"></i>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('absensi') }}" method="GET" class="search-container">
            <input type="text"
                   name="search"
                   class="search-input"
                   placeholder="Cari nama karyawan / tanggal / status..."
                   value="{{ request('search') }}">
            <button class="btn-search" type="submit">
                🔍 Cari
            </button>

            @if(request('search'))
                <a href="{{ route('absensi') }}" class="btn-reset">
                    🔄 Reset
                </a>
            @endif
        </form>


        @if(session('success'))
            <div class="alert-success-modern">
                <span style="font-size: 1.2rem;">✅</span> {{ session('success') }}
            </div>
        @endif


        <div style="overflow-x: auto;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($absensi->count() == 0)
                        <tr>
                            <td colspan="8" class="empty-state">
                                Data absensi tidak ditemukan
                            </td>
                        </tr>
                    @endif

                    @foreach($absensi as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $a->karyawan->nama_karyawan ?? '-' }}</strong></td>
                            <td>{{ $a->tanggal }}</td>
                            <td style="font-family: monospace; color: #666;">{{ $a->jam_masuk ?? '-' }}</td>
                            <td style="font-family: monospace; color: #666;">{{ $a->jam_pulang ?? '-' }}</td>
                            <td>
                                @if($a->status_kehadiran == 'Hadir')
                                    <span class="badge-absensi badge-hadir">Hadir</span>
                                @elseif($a->status_kehadiran == 'Izin')
                                    <span class="badge-absensi badge-izin">Izin</span>
                                @elseif($a->status_kehadiran == 'Sakit')
                                    <span class="badge-absensi badge-sakit">Sakit</span>
                                @else
                                    <span class="badge-absensi badge-alpha">Alpha</span>
                                @endif
                            </td>
                            <td><small>{{ $a->keterangan ?? '-' }}</small></td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('absensi.edit', $a->id_absensi) }}"
                                       class="btn-action-sm btn-edit">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('absensi.destroy', $a->id_absensi) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action-sm btn-delete"
                                                onclick="return confirm('Yakin ingin menghapus data absensi ini?')">
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

@endsection --}}



@extends('admin.template')

@section('title', 'Data Absensi')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Manajemen Absensi</h1>
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
        width: 40px; height: 40px; background: var(--bg-gradient); color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size:1.2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* GLASS CARD */
    .glass-card {
        background: var(--glass); border-radius: 24px; box-shadow: var(--shadow);
        border: 1px solid rgba(255,255,255,0.6); padding: 30px;
        position: relative; overflow: hidden;
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px);
        background-size: 20px 20px;
    }
    .glass-card::after {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px;
        background: linear-gradient(90deg, var(--secondary), var(--primary));
    }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
    .page-title { font-size: 1.8rem; color: var(--text-dark); margin: 0; font-weight: 700; }

    .btn-modern {
        padding: 12px 25px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem;
        cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-add { background: linear-gradient(to right, #11998e, #38ef7d); color: white; }
    .btn-add:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(56, 239, 125, 0.4); }

    .search-wrapper {
        display: flex; gap: 10px; margin-bottom: 20px; background: #f8f9fa; padding: 10px; border-radius: 15px; border: 1px solid #eee;
    }
    .search-input {
        flex: 1; border: none; background: transparent; padding: 10px 15px; font-size: 0.95rem; outline: none; font-family: 'Poppins', sans-serif; color: #555;
    }
    .search-input::placeholder { color: #aaa; }
    .btn-icon { border: none; background: transparent; cursor: pointer; font-size: 1.2rem; transition: transform 0.2s; }
    .btn-icon:hover { transform: scale(1.1); }

    table.modern-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    table.modern-table thead tr { background: linear-gradient(90deg, var(--secondary), var(--primary)); color: white; }
    table.modern-table thead th { padding: 15px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; color: white; }
    table.modern-table thead th:first-child { border-radius: 15px 0 0 0; }
    table.modern-table thead th:last-child { border-radius: 0 15px 0 0; }

    table.modern-table tbody tr { background: rgba(255,255,255,0.6); border-bottom: 1px solid rgba(0,0,0,0.05); transition: all 0.2s ease; }
    table.modern-table tbody tr:hover { background: rgba(102, 126, 234, 0.05); transform: scale(1.005); box-shadow: 0 4px 15px rgba(0,0,0,0.05); z-index: 2; position: relative; }
    table.modern-table td { padding: 15px; color: #555; font-size: 0.9rem; vertical-align: middle; }
    table.modern-table td:first-child { font-weight: 700; color: var(--secondary); }

    .badge-absensi { padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .badge-hadir { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .badge-izin { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .badge-sakit { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .badge-alpha { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }

    .btn-action-sm { padding: 6px 12px; border-radius: 10px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
    .btn-edit { background: linear-gradient(to right, #f6d365, #fda085); color: white; border: none; }
    .btn-edit:hover { filter: brightness(1.1); transform: translateY(-2px); }
    .btn-delete { background: #fee2e2; color: #ef4444; border: none; }
    .btn-delete:hover { background: #fecaca; transform: translateY(-2px); }

    .alert-modern { background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 500; border: 1px solid #fecaca; }
    .alert-success-modern { background: #d1fae5; color: #065f46; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 500; border: 1px solid #a7f3d0; }

    /* MODAL */
    .modal {
        display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.6); backdrop-filter: blur(8px);
        align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;
    }
    .modal.show { display: flex; opacity: 1; }

    .modal-box {
        background-color: #fff; padding: 0; border-radius: 24px; width: 90%; max-width: 450px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2); transform: scale(0.8);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative; overflow: hidden;
        border: 1px solid rgba(255,255,255,0.6);
        background-image: radial-gradient(#e0e0e0 1px, transparent 1px); background-size: 20px 20px;
    }
    .modal.show .modal-box { transform: scale(1); }

    .modal-header {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        padding: 30px 20px; text-align: center; position: relative;
    }
    .modal-icon {
        width: 60px; height: 60px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4);
        border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .modal-header h3 { margin: 0; color: white; font-size: 1.5rem; font-weight: 700; }

    .modal-body { padding: 30px; max-height: 70vh; overflow-y: auto; }

    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.9rem; color: #555; margin-left: 5px; }
    .form-control {
        width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 12px;
        box-sizing: border-box; font-family: inherit; font-size: 0.95rem; transition: all 0.3s;
        background: #f9fafb; color: #333;
    }
    .form-control:focus { border-color: var(--primary); outline: none; background: #fff; box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1); }

    .modal-buttons { display: flex; gap: 15px; margin-top: 30px; }
    .btn-submit { flex: 1; background: var(--bg-gradient); color: white; padding: 14px; border-radius: 12px; border:none; font-weight: 700; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .btn-submit:hover { opacity: 0.9; transform: scale(0.98); }
    .btn-cancel { flex: 1; background: #f3f4f6; color: #666; padding: 14px; border-radius: 12px; border:none; font-weight: 600; cursor: pointer; transition: 0.2s; }
    .btn-cancel:hover { background: #e5e7eb; color: #333; }

    /* WAVE */
    .waves { position: fixed; bottom: 0; left: 0; width: 100%; height: 15vh; margin-bottom: -7px; min-height: 100px; max-height: 150px; z-index: 1; pointer-events: none; }
    .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }
    @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }
</style>

<div class="website-layout">

    <div class="glass-card">
        <div class="page-header">
            <h4 class="page-title">Data Absensi</h4>

        </div>

        <form action="{{ route('absensi') }}" method="GET" class="search-wrapper">
            <input type="text" name="search" class="search-input" placeholder="🔍 Cari nama karyawan..." value="{{ request('search') }}">
            @if(request('search'))
                <a href="{{ route('absensi') }}" class="btn-icon" title="Reset">❌</a>
                <button type="submit" class="btn-icon" title="Cari">🔍</button>
            @else
                <button type="submit" class="btn-icon" title="Cari">🔍</button>
            @endif
        </form>

        @if(session('success'))
            <div class="alert-success-modern">✅ {{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert-modern">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Karyawan</th>
                        <th width="15%">Tanggal</th>
                        <th width="15%">Status</th>
                        <th width="25%">Keterangan</th>
                        <th width="15%" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($absensi->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #999;">
                                Data absensi tidak ditemukan
                            </td>
                        </tr>
                    @endif

                    @foreach($absensi as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $a->karyawan->nama_karyawan ?? '-' }}</strong></td>
                            <td>{{ $a->tanggal }}</td>
                            <td>
                                @if($a->status_kehadiran == 'Hadir')
                                    <span class="badge-absensi badge-hadir">Hadir</span>
                                @elseif($a->status_kehadiran == 'Izin')
                                    <span class="badge-absensi badge-izin">Izin</span>
                                @elseif($a->status_kehadiran == 'Sakit')
                                    <span class="badge-absensi badge-sakit">Sakit</span>
                                @else
                                    <span class="badge-absensi badge-alpha">Alpha</span>
                                @endif
                            </td>
                            <td><small>{{ $a->keterangan ?? '-' }}</small></td>
                            <td style="text-align: center;">

                                <!-- TOMBOL EDIT (PERBAIKAN: MENGGUNAKAN json_encode) -->
                                <button class="btn-action-sm btn-edit"
                                    data-id="{{ $a->id_absensi }}"
                                    data-karyawan="{{ $a->id_karyawan }}"
                                    data-tanggal="{{ $a->tanggal }}"
                                    data-status="{{ $a->status_kehadiran }}"
                                    data-ket="{{ json_encode($a->keterangan) }}"
                                    onclick="openModal('edit', this)">
                                    ✏️ Edit
                                </button>

                                <form action="{{ route('absensi.destroy',$a->id_absensi) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn-action-sm btn-delete" onclick="return confirm('Yakin hapus data?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- MODAL ABSENSI -->
<div class="modal" id="absensiModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-icon">📅</div>
            <h3 id="modalTitle">Tambah Absensi</h3>
        </div>

        <div class="modal-body">
            <form id="absensiForm" action="{{ route('absensi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_absensi" id="absensiId">
                <input type="hidden" name="_method" value="POST" id="methodInput">

                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @if(isset($karyawan))
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id_karyawan }}">{{ $k->nama_karyawan }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Status Kehadiran</label>
                    <select name="status_kehadiran" id="status_kehadiran" class="form-control" required>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan..."></textarea>
                </div>

                <div class="modal-buttons">
                    <button type="submit" class="btn-submit">💾 Simpan Data</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">❌ Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<!-- JAVASCRIPT LOGIC -->
<script>
    function openModal(mode, element = null) {
        const modal = document.getElementById('absensiModal');
        const form = document.getElementById('absensiForm');
        const title = document.getElementById('modalTitle');

        // Tampilkan Modal
        modal.style.display = "flex";
        setTimeout(() => { modal.classList.add('show'); }, 10);

        if (mode === 'create') {
            // --- MODE CREATE ---
            form.action = "{{ route('absensi.store') }}";
            document.getElementById('methodInput').value = "POST";
            title.innerText = "Tambah Absensi";

            // Reset Form
            document.getElementById('absensiId').value = "";
            document.getElementById('id_karyawan').value = "";
            document.getElementById('tanggal').value = "";
            document.getElementById('status_kehadiran').value = "Hadir";
            document.getElementById('keterangan').value = "";

        } else {
            // --- MODE EDIT ---
            // Ambil Data dari Tombol
            const id = element.getAttribute('data-id');
            const karyawan = element.getAttribute('data-karyawan');
            const tanggal = element.getAttribute('data-tanggal');
            const status = element.getAttribute('data-status');
            const ket = element.getAttribute('data-ket');

            console.log("Data Edit:", id, status, ket); // Debugging

            // Set Form Edit
            form.action = "{{ route('absensi.update', ':id') }}".replace(':id', id);
            document.getElementById('methodInput').value = "PUT";
            title.innerText = "Edit Data Absensi";

            // Isi Data
            document.getElementById('absensiId').value = id;
            document.getElementById('id_karyawan').value = karyawan;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('status_kehadiran').value = status;
            document.getElementById('keterangan').value = ket;
        }
    }

    function closeModal() {
        const modal = document.getElementById('absensiModal');
        modal.classList.remove('show');
        setTimeout(() => { modal.style.display = "none"; }, 300);
    }

    // Klik di luar modal untuk menutup
    window.onclick = function(event) {
        const modal = document.getElementById('absensiModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

@endsection

