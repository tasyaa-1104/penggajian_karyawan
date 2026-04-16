@extends('finance.template')

@section('title', 'Data Karyawan')

@section('topbar')
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --smart-maroon: #800000;
    --smart-maroon-hover: #600000;
    --bg-page: #F3F4F6;
    --bg-white: #FFFFFF;
    --text-dark: #2c3e50;
    --text-grey: #7f8c8d;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-page);
    margin: 0;
    color: var(--text-dark);
}

/* FULL WIDTH (SAMA KAYA TUNJANGAN) */
.website-layout {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    padding: 30px;
    padding-top: 90px;
}

/* HEADER */
.website-header {
    position: fixed; top: 0; left: 0; width: 100%; height: 70px;
    background: var(--bg-white);
    z-index: 100;
    border-bottom: 1px solid #e0e0e0;
}
.header-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.avatar-small {
    width: 35px; height: 35px;
    background: var(--smart-maroon);
    color: white;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}

/* CARD */
.card-box {
    background: white;
    border-radius: 10px;
    padding: 30px;
    border: 1px solid #e0e0e0;
}

/* BANNER */
.welcome-card {
    background: #fff5f5;
    border-left: 5px solid var(--smart-maroon);
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    display: flex;
    gap: 15px;
}
.welcome-icon {
    width: 50px;
    height: 50px;
    background: var(--smart-maroon);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.page-header {
    margin-bottom: 20px;
}
.page-title {
    font-weight: 700;
    border-left: 5px solid var(--smart-maroon);
    padding-left: 10px;
}

/* SEARCH */
.search-box {
    display: flex;
    border: 1px solid #ddd;
    border-radius: 30px;
    padding: 5px 15px;
    max-width: 400px;
    margin-bottom: 20px;
}
.search-box input {
    border: none;
    outline: none;
    width: 100%;
}

/* TABLE */
table.modern-table {
    width: 100%;
    border-collapse: collapse;
}
table.modern-table thead {
    background: var(--smart-maroon);
}
table.modern-table th {
    color: white;
    padding: 12px;
    text-align: left;
    font-size: 0.85rem;
}
table.modern-table td {
    padding: 14px;
    border-bottom: 1px solid #eee;
    font-size: 0.9rem;
    color: var(--text-grey);
}
table.modern-table td:first-child {
    color: var(--smart-maroon);
    font-weight: 600;
}

/* STATUS */
.badge {
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}
.badge-aktif {
    background: #d1fae5;
    color: #059669;
}
.badge-nonaktif {
    background: #eee;
}

/* EMPTY */
.empty-state {
    text-align: center;
    padding: 40px;
    color: #999;
}
</style>

<div class="website-layout">
    <div class="card-box">

        <!-- BANNER -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h3>Data Karyawan</h3>
                <p>Informasi karyawan (read only)</p>
            </div>
        </div>

        <!-- TITLE -->
        <div class="page-header">
            <h4 class="page-title">Daftar Karyawan</h4>
        </div>

        <!-- SEARCH -->
        <form action="{{ route('karyawan') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit" style="border:none;background:none;">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- TABLE -->
        <div style="overflow-x:auto;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Tunjangan</th>
                        <th>Gaji</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($karyawans->count() == 0)
                        <tr>
                            <td colspan="9" class="empty-state">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endif

                    @foreach($karyawans as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nik }}</td>
                        <td><strong>{{ $k->nama_karyawan }}</strong></td>
                        <td>{{ $k->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $k->jabatan->nama_jabatan ?? '-' }}</td>
                        <td>
                            @foreach($k->tunjangan as $t)
                                {{ $t->nama_tunjangan }} <br>
                            @endforeach
                        </td>
                        <td>Rp {{ number_format($k->gaji_pokok,0,',','.') }}</td>
                        <td>{{ $k->tanggal_masuk ? date('d-m-Y', strtotime($k->tanggal_masuk)) : '-' }}</td>
                        <td>
                            <span class="badge {{ $k->status_karyawan == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                                {{ ucfirst($k->status_karyawan) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
