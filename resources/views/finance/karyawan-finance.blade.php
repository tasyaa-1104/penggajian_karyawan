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
}

.website-layout {
    max-width: 1200px;
    margin: auto;
    padding: 30px;
    padding-top: 90px;
}

.website-header {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 70px;
    background: white;
    border-bottom: 1px solid #ddd;
}

.header-content {
    max-width: 1200px;
    margin: auto;
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
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-box {
    background: white;
    padding: 30px;
    border-radius: 10px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.page-title {
    font-weight: bold;
    border-left: 5px solid var(--smart-maroon);
    padding-left: 10px;
}

.btn {
    padding: 10px 20px;
    background: var(--smart-maroon);
    color: white;
    border-radius: 6px;
    text-decoration: none;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: var(--smart-maroon);
    color: white;
}

th, td {
    padding: 12px;
    text-align: left;
}

tbody tr:hover {
    background: #f9f9f9;
}

.badge-aktif {
    background: #d1fae5;
    color: green;
    padding: 5px 10px;
    border-radius: 10px;
}

.badge-nonaktif {
    background: #eee;
    padding: 5px 10px;
    border-radius: 10px;
}

.empty-state {
    text-align: center;
    padding: 30px;
}
</style>

<div class="website-layout">

    <div class="card-box">

        <!-- HEADER -->
        <div class="page-header">
            <h4 class="page-title">Daftar Karyawan</h4>

            <a href="{{ route('karyawan.pdf') }}" class="btn">
                <i class="fas fa-file-pdf"></i> Unduh PDF
            </a>
        </div>

        <!-- ALERT -->
        @if(session('success'))
            <div style="margin-bottom:15px; color:green;">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @if($karyawans->count() == 0)
                    <tr>
                        <td colspan="8" class="empty-state">
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
                    <td>Rp {{ number_format($k->gaji_pokok,0,',','.') }}</td>
                    <td>{{ $k->tanggal_masuk ? date('d-m-Y', strtotime($k->tanggal_masuk)) : '-' }}</td>
                    <td>
                        <span class="{{ $k->status_karyawan == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ ucfirst($k->status_karyawan) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection
