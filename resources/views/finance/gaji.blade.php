@extends('finance.template')

@section('title', 'Data Gaji')

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
        --btn-create: #00897B;
        --btn-create-hover: #00695C;
        --btn-view: #0ea5e9;
        --btn-view-hover: #0284c7;
        --btn-del: #EF5350;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-page);
        margin: 0;
        color: var(--text-dark);
        min-height: 100vh;
    }

    .container-custom {
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

    /* --- WELCOME BANNER (BARU) --- */
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

    .btn-slip-view { background-color: var(--btn-view); }
    .btn-slip-view:hover { background-color: var(--btn-view-hover); transform: translateY(-1px); }

    .btn-slip-create { background-color: var(--btn-create); }
    .btn-slip-create:hover { background-color: var(--btn-create-hover); transform: translateY(-1px); }

    .btn-delete { background-color: var(--btn-del); color: white; }
    .btn-delete:hover { background-color: #d32f2f; transform: translateY(-1px); }

    /* --- TABLE --- */
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

    .currency-text { font-family: 'Roboto Mono', monospace; font-weight: 600; color: #333; }
    .currency-bold { color: var(--smart-maroon); font-weight: 800; }

    /* --- ALERT --- */
    .alert-modern {
        background: #ecfdf5; color: #047857; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px;
        border-left: 5px solid #10b981; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; font-weight: 600;
    }

    .empty-state { text-align: center; padding: 40px; color: #999; font-style: italic; }

</style>

<div class="container-custom">

    <!-- GLASS CARD CONTAINER -->
    <div class="glass-card">

        <!-- 👋 BANNER SELAMAT DATANG (BARU) -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="welcome-text-content">
                <h3>Selamat Datang, Admin 👋</h3>
                <p>Berikut adalah data gaji dan rekapitulasi penggajian karyawan.</p>
            </div>
        </div>

        <!-- HEADER & TOMBOL HITUNG -->
        <div class="page-header">
            <h4 class="page-title">Daftar Gaji</h4>
            <a href="{{ route('gaji.create') }}" class="btn-modern btn-add">
                <i class="fas fa-calculator"></i> Hitung Gaji
            </a>
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
                        <th width="5%">No</th>
                        <th width="15%">Nama</th>
                        <th width="15%">Jabatan</th>
                        <th width="10%">Bulan</th>
                        <th width="12%">Tunjangan</th>
                        <th width="12%">Lembur</th>
                        <th width="12%">Potongan</th>
                        <th width="14%">Gaji Bersih</th>
                        <th width="5%" style="text-align: center;">Aksi</th>
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
                                <div style="display: flex; gap: 6px; justify-content: center;">

                                    @if ($g->slipGaji)
                                        <a href="{{ route('admin.slip-gaji.show', $g->slipGaji->id_slip) }}"
                                           class="btn-action-sm btn-slip-view"
                                           title="Lihat Slip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @else
                                        <form action="{{ route('admin.slip-gaji.store', $g->id_gaji) }}"
                                              method="POST" style="display: inline;">
                                            @csrf
                                            <button class="btn-action-sm btn-slip-create"
                                                    title="Buat Slip">
                                                <i class="fas fa-file-invoice"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('gaji.destroy',$g->id_gaji) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action-sm btn-delete"
                                                title="Hapus Data"
                                                onclick="return confirm('Yakin ingin menghapus data gaji ini?')">
                                            <i class="fas fa-trash"></i>
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

@endsection
