@extends('admin.template')

@section('title', 'Data Cuti Karyawan')

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
        --btn-approve: #00897B; /* Teal */
        --btn-approve-hover: #00695C;
        --btn-reject: #EF5350; /* Merah Soft */
        --btn-reject-hover: #E53935;
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
    .btn-action-sm {
        padding: 6px 12px; font-size: 0.8rem; font-weight: 600; border-radius: 6px;
        border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;
        transition: all 0.2s; text-decoration: none; color: white;
    }
    .btn-approve { background-color: var(--btn-approve); }
    .btn-approve:hover { background-color: var(--btn-approve-hover); transform: translateY(-1px); }

    .btn-reject { background-color: var(--btn-reject); color: white; }
    .btn-reject:hover { background-color: var(--btn-reject-hover); transform: translateY(-1px); }

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
    .modern-table td:first-child { font-weight: 600; color: var(--smart-maroon); }

    /* Badge Status */
    .badge-status { padding: 5px 12px; border-radius: 14px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; }
    .badge-pending { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; }
    .badge-approved { background: #d1fae5; color: #059669; border: 1px solid #6ee7b7; }
    .badge-rejected { background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }

    /* --- ALERT --- */
    .alert-modern {
        background: #ecfdf5; color: #047857; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px;
        border-left: 5px solid #10b981; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; font-weight: 600;
    }

    .empty-state { text-align: center; padding: 40px; color: #999; font-style: italic; }

</style>

<div class="website-layout">

    <!-- GLASS CARD CONTAINER -->
    <div class="glass-card">

        <!-- 👋 BANNER SELAMAT DATANG -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="welcome-text-content">
                <h3>Data Pengajuan Cuti</h3>
                <p>Kelola persetujuan cuti dan izin karyawan.</p>
            </div>
        </div>

        <!-- HEADER HALAMAN -->
        <div class="page-header">
            <h4 class="page-title">Daftar Cuti</h4>
        </div>

        <!-- ALERT SUKSES -->
        @if(session('success'))
            <div class="alert-modern">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- TABEL MODERN -->
        <div style="overflow-x: auto;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Cuti</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
               <tbody>
                @forelse($cuti as $c)
                <tr>
                    <td><strong>{{ $c->karyawan->nama_karyawan }}</strong></td>

                    <td>
                        {{ $c->tanggal_mulai }}
                        <span style="color:#ccc">s/d</span>
                        {{ $c->tanggal_selesai }}
                    </td>

                    <td>{{ $c->alasan }}</td>

                    <td>
                        @if($c->status == 'disetujui')
                            <span class="badge-status badge-approved">
                                Approved
                            </span>
                        @elseif($c->status == 'ditolak')
                            <span class="badge-status badge-rejected">
                                Rejected
                            </span>
                        @else
                            <span class="badge-status badge-pending">
                                Pending
                            </span>
                        @endif
                    </td>
                    <td>
                    <form action="{{ route('cuti.destroy', $c->id_cuti) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data cuti ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-action-sm btn-reject">
                    <i class="fas fa-trash"></i> Hapus
                    </button>

                    </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-state">
                        Belum ada data cuti
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
