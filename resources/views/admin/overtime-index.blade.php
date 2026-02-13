@extends('admin.template')

@section('title', 'Data Overtime')

@section('topbar')
    <!-- Header Style Website (Fixed Topbar) -->
    <div class="website-header">
        <div class="header-content">
            <div class="welcome-text">
                <span>Selamat Datang, Admin 👋</span>
            </div>
            <div class="user-profile">
                <span>SmartGaji</span>
                <div class="avatar-small">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        /* WARNA TEMA (MAROON) */
        --smart-maroon: #800000;
        --smart-maroon-light: #A52A2A;
        --smart-maroon-hover: #600000;
        --bg-page: #F3F4F6;
        --bg-white: #FFFFFF;
        --text-dark: #2c3e50;
        --text-grey: #7f8c8d;

        /* Warna Aksi */
        --btn-create: #00897B; /* Teal */
        --btn-create-hover: #00695C;
        --btn-del: #EF5350;    /* Merah Soft */
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-page);
        margin: 0;
        color: var(--text-dark);
        min-height: 100vh;
    }

    .website-layout {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
        position: relative;
        z-index: 10;
        padding-top: 90px;
    }

    /* --- HEADER STYLE --- */
    .website-header {
        position: fixed; top: 0; left: 0; width: 100%; height: 70px;
        background: var(--bg-white);
        z-index: 100; border-bottom: 1px solid #e0e0e0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .header-content {
        max-width: 1200px; margin: 0 auto; padding: 0 20px; height: 100%;
        display: flex; justify-content: space-between; align-items: center;
    }
    .welcome-text span {
        font-size: 1.1rem; font-weight: 600; color: var(--text-dark);
    }
    .user-profile { display: flex; align-items: center; gap: 15px; font-weight: 500; color: var(--text-grey); }
    .avatar-small {
        width: 35px; height: 35px; background: var(--smart-maroon); color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
    }

    /* --- CARD UTAMA --- */
    .glass-card {
        background: var(--bg-white);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.04);
        border: 1px solid #e0e0e0;
        padding: 30px;
        animation: slideUp 0.5s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- WELCOME BANNER --- */
    .welcome-card {
        background: linear-gradient(90deg, #fff5f5, #ffffff);
        border: 1px solid #fecaca;
        border-left: 5px solid var(--smart-maroon);
        border-radius: 8px;
        padding: 20px 25px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .welcome-icon {
        width: 50px; height: 50px;
        background: var(--smart-maroon);
        color: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .welcome-text-content h3 {
        margin: 0 0 5px 0;
        color: var(--smart-maroon);
        font-size: 1.4rem;
        font-weight: 700;
    }
    .welcome-text-content p {
        margin: 0;
        color: var(--text-grey);
        font-size: 0.95rem;
    }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .page-title { font-size: 1.3rem; margin: 0; color: var(--text-dark); font-weight: 700; border-left: 5px solid var(--smart-maroon); padding-left: 15px; }

    /* --- BUTTONS --- */
    .btn-modern {
        padding: 10px 20px; border: none; border-radius: 6px; font-family: 'Poppins', sans-serif;
        font-size: 0.9rem; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.3s ease; text-decoration: none; color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .btn-add { background-color: var(--smart-maroon); color: white; }
    .btn-add:hover { background-color: var(--smart-maroon-hover); transform: translateY(-2px); box-shadow: 0 4px 10px rgba(128, 0, 0, 0.3); }

    .btn-action-sm {
        padding: 6px 12px; font-size: 0.8rem; font-weight: 600; border-radius: 6px;
        border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;
        transition: all 0.2s; text-decoration: none; color: white;
    }
    .btn-approve { background-color: var(--btn-create); }
    .btn-approve:hover { background-color: var(--btn-create-hover); transform: translateY(-1px); }

    .btn-delete { background-color: var(--btn-del); color: white; }
    .btn-delete:hover { background-color: #d32f2f; transform: translateY(-1px); }

    /* --- TABLE (MAROON HEADER) --- */
    .modern-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .modern-table thead { background-color: var(--smart-maroon); }
    .modern-table thead th {
        padding: 15px; text-align: left; color: white; font-weight: 600; font-size: 0.85rem;
        text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap;
    }
    .modern-table tbody tr { border-bottom: 1px solid #f0f0f0; transition: 0.2s; }
    .modern-table tbody tr:last-child { border-bottom: none; }
    .modern-table tbody tr:hover { background-color: #fafafa; }
    .modern-table td { padding: 15px; color: var(--text-grey); font-size: 0.95rem; vertical-align: middle; }
    .modern-table td:first-child { font-weight: 600; color: var(--smart-maroon); text-align: center; width: 50px; }

    /* Badge Status */
    .badge-status { padding: 5px 12px; border-radius: 14px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; }
    .badge-pending { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; }
    .badge-approved { background: #d1fae5; color: #059669; border: 1px solid #6ee7b7; }
    .badge-rejected { background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }

    /* Currency */
    .text-currency { font-weight: 600; color: #333; font-family: 'Roboto Mono', monospace; }

    /* --- ALERT --- */
    .alert-modern {
        background: #ecfdf5; color: #047857; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px;
        border-left: 5px solid #10b981; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; font-weight: 600;
    }

    /* --- MODAL --- */
    .modal {
        display: none; position: fixed; z-index: 200; left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
        align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;
    }
    .modal.show { display: flex; opacity: 1; }
    .modal-box {
        background-color: #fff; width: 90%; max-width: 450px; border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden;
        transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #e2e8f0;
    }
    .modal.show .modal-box { transform: scale(1); }
    .modal-header {
        background: var(--smart-maroon); padding: 20px 25px; display: flex; justify-content: space-between; align-items: center;
    }
    .modal-header h3 { margin: 0; color: white; font-size: 1.2rem; font-weight: 600; }
    .modal-body { padding: 30px 25px; text-align: center; }

    .modal-btn {
        width: 100%; padding: 12px; border: none; border-radius: 12px; font-family: 'Poppins';
        font-weight: 600; font-size: 1rem; cursor: pointer; transition: 0.3s;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        background: linear-gradient(135deg, #2563eb, #06b6d4); color: white;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }
    .modal-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4); }

    .btn-close-modal {
        background: #f1f5f9; color: var(--text-grey); border: none; margin-top: 15px;
        padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 500;
    }
    .btn-close-modal:hover { background: #e2e8f0; }

</style>

<div class="website-layout">

    <!-- GLASS CARD CONTAINER -->
    <div class="glass-card">

        <!-- 👋 BANNER SELAMAT DATANG -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="welcome-text-content">
                <h3>Manajemen Lembur</h3>
                <p>Kelola data lembur karyawan dan persetujuan overtime.</p>
            </div>
        </div>

        <!-- HEADER & TOMBOL ADD -->
        <div class="page-header">
            <h4 class="page-title">Daftar Overtime</h4>
            <button class="btn-modern btn-add" onclick="openModal()">
                <i class="fas fa-plus-circle"></i> Tambah / Generate
            </button>
        </div>

        <!-- ALERT SUKSES -->
        @if(session('success'))
            <div class="alert-modern">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- TABEL MODERN (Struktur HTML diperbaiki) -->
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
                <tbody>
                    @forelse($overtimes as $overtime)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><strong>{{ $overtime->karyawan->nama_karyawan }}</strong></td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse($overtime->tanggal)->format('d-m-Y') }}</td>
                            <td style="text-align: center;">{{ $overtime->jam_mulai }} - {{ $overtime->jam_selesai }}</td>
                            <td style="text-align: center;">{{ $overtime->total_jam }} Jam</td>
                            <td>
                                <span class="text-currency">
                                    Rp {{ number_format($overtime->total_upah,0,',','.') }}
                                </span>
                            </td>

                            {{-- SUMBER --}}
                            <td style="text-align: center;">
                                <span style="
                                    padding:4px 10px;
                                    border-radius:12px;
                                    font-size:0.7rem;
                                    font-weight:700;
                                    background: {{ $overtime->sumber == 'absensi' ? '#dcfce7' : '#e0e7ff' }};
                                    color: {{ $overtime->sumber == 'absensi' ? '#166534' : '#3730a3' }};
                                ">
                                    {{ strtoupper($overtime->sumber) }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td style="text-align: center;">
                                <span class="badge-status
                                    {{ $overtime->status == 'approved' ? 'badge-approved' :
                                       ($overtime->status == 'rejected' ? 'badge-rejected' : 'badge-pending') }}">
                                    {{ ucfirst($overtime->status) }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td style="text-align: center;">
                                <div style="display:flex; gap:6px; justify-content:center;">
                                    {{-- APPROVE --}}
                                    @if($overtime->status == 'pending')
                                        <form action="{{ route('overtime.approve', $overtime->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn-action-sm btn-approve" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- HAPUS --}}
                                    <form action="{{ route('overtime.destroy', $overtime->id) }}" method="POST" style="display:inline;"
                                          onsubmit="return confirm('Yakin hapus overtime ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action-sm btn-delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 40px; color: #999;">
                                Data lembur kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- MODAL TAMBAH/GENERATE OVERTIME -->
<div class="modal" id="overtimeModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Generate Overtime</h3>
            <span style="cursor:pointer; color:white;" onclick="closeModal()"><i class="fas fa-times"></i></span>
        </div>
        <div class="modal-body">
            <p style="color:#666; margin-bottom:20px;">
                Sistem akan otomatis mendeteksi data absensi yang melebihi jam kerja normal dan membuat data overtime baru.
            </p>

            <form action="{{ route('overtime.generate') }}" method="POST">
                @csrf
                <button type="submit" class="modal-btn">
                    <i class="fas fa-sync-alt"></i> Generate dari Absensi
                </button>
            </form>

            <button class="btn-close-modal" onclick="closeModal()">Batal</button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        const modal = document.getElementById('overtimeModal');
        modal.style.display = "flex";
        setTimeout(() => { modal.classList.add('show'); }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('overtimeModal');
        modal.classList.remove('show');
        setTimeout(() => { modal.style.display = "none"; }, 300);
    }

    window.onclick = function(event) {
        const modal = document.getElementById('overtimeModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

@endsection
