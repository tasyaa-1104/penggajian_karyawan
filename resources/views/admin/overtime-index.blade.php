@extends('admin.template')

@section('title', 'Data Overtime')

@section('topbar')
    <!-- Topbar Style Website (Header) -->
    <div class="website-header animate-header">
        <div class="header-content">
            <h1>Manajemen Lembur</h1>
            <div class="user-profile">
                <span>Admin 👋</span>
                <div class="avatar-small">⏰</div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- CSS STYLING (Sama dengan style User + Tambahan untuk Overtime) -->
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

        /* Warna Status Overtime */
        --color-pending: #f59e0b;
        --color-approved: #10b981;
        --color-rejected: #ef4444;
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
        padding-top: 100px; /* Space untuk fixed header */
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
        width: 40px; height: 40px; background: var(--bg-gradient); color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* --- TABEL STYLE --- */
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

    /* Table Modern */
    table.modern-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    table.modern-table thead tr { background: linear-gradient(90deg, var(--secondary), var(--primary)); color: white; }
    table.modern-table th { padding: 18px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; color: white; }
    table.modern-table th:first-child { border-radius: 15px 0 0 0; }
    table.modern-table th:last-child { border-radius: 0 15px 0 0; }

    table.modern-table tbody tr { background: rgba(255,255,255,0.6); border-bottom: 1px solid rgba(0,0,0,0.05); transition: all 0.2s ease; }
    table.modern-table tbody tr:hover { background: rgba(102, 126, 234, 0.05); transform: scale(1.005); box-shadow: 0 4px 15px rgba(0,0,0,0.05); z-index: 2; position: relative; }
    table.modern-table td { padding: 16px 18px; color: #555; font-size: 0.9rem; vertical-align: middle; }
    table.modern-table td:first-child { font-weight: 700; color: var(--secondary); text-align: center; width: 50px; }

    /* Badge Status Custom */
    .badge-status { padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; }

    /* Warna Overtime */
    .badge-pending { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; }
    .badge-approved { background: #d1fae5; color: #059669; border: 1px solid #6ee7b7; }
    .badge-rejected { background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }

    /* Button Action */
    .btn-action-sm { padding: 8px 15px; border-radius: 10px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s; border: none; display: inline-flex; align-items: center; gap: 5px; color: white;}
    .btn-approve { background: linear-gradient(to right, #11998e, #38ef7d); box-shadow: 0 4px 10px rgba(17, 153, 142, 0.3); }
    .btn-approve:hover { filter: brightness(1.1); transform: translateY(-2px); }

    /* Currency Styling */
    .text-currency { font-weight: 600; color: #333; font-family: 'Consolas', monospace; }

    .alert-modern { background: #d1fae5; color: #065f46; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 500; text-align: center; border: 1px solid #a7f3d0; }

    /* --- MODAL STYLE --- */
    .modal {
        display: none; position: fixed; z-index: 200; left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.6); backdrop-filter: blur(8px);
        align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;
    }
    .modal.show { display: flex; opacity: 1; }

    .modal-box {
        background-color: #fff; padding: 0; border-radius: 24px; width: 90%; max-width: 550px;
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

    .modal-body { padding: 30px; }

    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.9rem; color: #555; margin-left: 5px; }
    .form-control {
        width: 100%; padding: 14px 20px; border: 2px solid #eee; border-radius: 12px;
        box-sizing: border-box; font-family: inherit; font-size: 1rem; transition: all 0.3s;
        background: #f9fafb; color: #333;
    }
    .form-control:focus { border-color: var(--primary); outline: none; background: #fff; box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1); }

    .modal-buttons { display: flex; gap: 15px; margin-top: 30px; }
    .btn-submit { flex: 1; background: var(--bg-gradient); color: white; padding: 14px; border-radius: 12px; border:none; font-weight: 700; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .btn-submit:hover { opacity: 0.9; transform: scale(0.98); }
    .btn-cancel { flex: 1; background: #f3f4f6; color: #666; padding: 14px; border-radius: 12px; border:none; font-weight: 600; cursor: pointer; transition: 0.2s; }
    .btn-cancel:hover { background: #e5e7eb; color: #333; }

    /* WAVE ANIMATION */
    .waves { position: fixed; bottom: 0; left: 0; width: 100%; height: 15vh; margin-bottom: -7px; min-height: 100px; max-height: 150px; z-index: 1; pointer-events: none; }
    .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }
    @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }
</style>

<div class="website-layout">

    <!-- GLASS CARD CONTAINER -->
    <div class="glass-card">

        <!-- HEADER & TOMBOL ADD -->
        <div class="page-header">
            <h4 class="page-title">Data Overtime</h4>
            <button class="btn-modern btn-add" onclick="openModal()">
                ➕ Tambah Overtime
            </button>
        </div>

        <!-- ALERT SUKSES -->
        @if(session('success'))
            <div class="alert-modern">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- TABEL MODERN -->
        <div style="overflow-x: auto;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Karyawan</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Jam Kerja</th>
                        <th style="text-align: center;">Total Jam</th>
                        <th>Total Upah</th>
                        <th style="text-align: center;">Sumber</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>

                    </tr>
                </thead>
               <td style="text-align: center;">
                <tbody>
@forelse($overtimes as $overtime)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $overtime->karyawan->nama_karyawan }}</td>
   <td>{{ \Carbon\Carbon::parse($overtime->tanggal)->format('d-m-Y') }}</td>

    <td>{{ $overtime->jam_mulai }} - {{ $overtime->jam_selesai }}</td>
    <td>{{ $overtime->total_jam }} Jam</td>
    <td>Rp {{ number_format($overtime->total_upah,0,',','.') }}</td>

    {{-- SUMBER (TIDAK DIUBAH) --}}
    <td>
        <span style="
            padding:5px 12px;
            border-radius:14px;
            font-size:0.75rem;
            font-weight:700;
            background: {{ $overtime->sumber == 'absensi' ? '#dcfce7' : '#e0e7ff' }};
            color: {{ $overtime->sumber == 'absensi' ? '#166534' : '#3730a3' }};
        ">
            {{ strtoupper($overtime->sumber) }}
        </span>
    </td>

    {{-- STATUS --}}
    <td>
        <span class="badge
            {{ $overtime->status == 'approved' ? 'bg-success' :
               ($overtime->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
            {{ ucfirst($overtime->status) }}
        </span>
    </td>

    {{-- AKSI --}}
    <td style="text-align:center;">
    <div style="display:flex; gap:6px; justify-content:center;">

        {{-- APPROVE (HANYA JIKA PENDING) --}}
        @if($overtime->status == 'pending')
            <form action="{{ route('overtime.approve', $overtime->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button class="btn-action-sm btn-approve">
                    ✔ Approve
                </button>
            </form>
        @endif

        {{-- HAPUS (SELALU BISA) --}}
        <form action="{{ route('overtime.destroy', $overtime->id) }}" method="POST"
              onsubmit="return confirm('Yakin hapus overtime ini?')">
            @csrf
            @method('DELETE')
            <button class="btn-action-sm" style="background:#ef4444;">
                🗑 Hapus
            </button>
        </form>

    </div>
</td>


</tr>
@empty
<tr>
    <td colspan="9" class="text-center">Data lembur kosong</td>
</tr>
@endforelse
</tbody>


            </table>
        </div>

    </div>

</div>

<!-- MODAL TAMBAH OVERTIME (Custom Modal, Bukan Bootstrap) -->
<div class="modal" id="overtimeModal">
    <div class="modal-box">

        <!-- HEADER GRADASI -->
        <form action="{{ route('overtime.generate') }}" method="POST">
    @csrf
    <button class="btn-modern btn-add">
        🔄 Generate dari Absensi
    </button>
</form>



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

<!-- JAVASCRIPT LOGIC (Modal Sederhana untuk Add) -->
<script>
    function openModal() {
        const modal = document.getElementById('overtimeModal');
        modal.style.display = "flex";
        // Sedikit delay agar transisi CSS opacity berjalan
        setTimeout(() => { modal.classList.add('show'); }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('overtimeModal');
        modal.classList.remove('show');
        // Tunggu transisi selesai sebelum display none
        setTimeout(() => { modal.style.display = "none"; }, 300);
    }

    // Klik di luar modal (area gelap) untuk menutup
    window.onclick = function(event) {
        const modal = document.getElementById('overtimeModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

@endsection
