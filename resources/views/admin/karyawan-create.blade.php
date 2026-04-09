@extends('admin.template')

@section('title', 'Tambah Karyawan')

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
        /* WARNA TEMA (Maroon Corporate) */
        --smart-maroon: #800000;
        --smart-maroon-light: #A52A2A;
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
        min-height: 100vh;
    }

    .website-layout {
        width: 100%;
        max-width: 800px; /* Lebar sedang agar form pas di tengah */
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
    .card-box {
        background: var(--bg-white);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.04);
        border: 1px solid #e0e0e0;
        padding: 40px;
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

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #f5f5f5; padding-bottom: 15px; }
    .page-title { font-size: 1.3rem; margin: 0; color: var(--text-dark); font-weight: 700; border-left: 5px solid var(--smart-maroon); padding-left: 15px; }

    /* --- FORM STYLING --- */
    .form-group { margin-bottom: 25px; }
    .form-group label {
        display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.9rem;
        color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.5px;
    }

    /* Override Bootstrap Form Control */
    .form-control {
        width: 100%; padding: 14px 20px; border: 2px solid #e2e8f0; border-radius: 8px;
        font-family: 'Poppins'; font-size: 1rem; transition: 0.3s; background: #f8fafc;
        color: var(--text-dark); outline: none; box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .form-control:focus {
        border-color: var(--smart-maroon); background: white;
        box-shadow: 0 0 0 4px rgba(128, 0, 0, 0.1);
        transform: translateY(-2px); transition: all 0.3s;
    }

    .text-info {
        display: block; margin-bottom: 25px; padding: 12px 15px;
        background: #eff6ff; border-left: 4px solid #0ea5e9;
        color: #0369a1; border-radius: 6px; font-size: 0.85rem; font-style: italic;
    }

    /* --- BUTTON --- */
    .btn {
        width: 100%; padding: 14px 20px; border: none; border-radius: 8px;
        font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        transition: all 0.3s ease; text-decoration: none; color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-submit {
        background-color: var(--smart-maroon);
    }
    .btn-submit:hover {
        background-color: var(--smart-maroon-hover); transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(128, 0, 0, 0.3);
    }

    /* --- ALERT --- */
    .alert {
        background: #fee2e2; color: #991b1b; padding: 15px 20px; border-radius: 8px;
        margin-bottom: 25px; border-left: 5px solid #ef4444; font-size: 0.9rem;
        display: flex; align-items: center; gap: 10px; font-weight: 600;
    }
    .alert ul { margin: 0; padding-left: 20px; list-style: none; }

    @media (max-width: 600px) {
        .website-layout { padding: 20px; }
        .card-box { padding: 25px; }
    }
</style>

<div class="website-layout">

    <div class="card-box">

        <!-- 👋 BANNER SELAMAT DATANG -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="welcome-text-content">
                <h3>Tambah Karyawan</h3>
                <p>Isi data profil karyawan baru.</p>
            </div>
        </div>

        <div class="page-header">
            <h4 class="page-title">Form Input Data</h4>
        </div>

        <!-- ALERT VALIDASI (LOGIKA TETAP) -->
        @if ($errors->any())
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM INPUT DATA (LOGIKA TETAP SESUAI INPUT ANDA) -->
        <form action="{{ route('karyawan-store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK..." required>
            </div>

            <div class="form-group">
                <label for="id_user">Pilih User Akun</label>
                <select name="id_user" id="id_user" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_divisi">Pilih Divisi</label>
                <select name="id_divisi" id="id_divisi" class="form-control" required>
                    <option value="">-- Pilih Divisi --</option>
                    @foreach($divisi as $d)
                        <option value="{{ $d->id_divisi }}">
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_jabatan">Pilih Jabatan</label>
                <select name="id_jabatan" id="id_jabatan" class="form-control" required>
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($jabatan as $j)
                        <option value="{{ $j->id_jabatan }}">
                            {{ $j->nama_jabatan }}
                            (Rp {{ number_format($j->gaji_pokok,0,',','.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tunjangan">Pilih Tunjangan</label>
                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                    @foreach($tunjangan as $t)
                        <label style="display: flex; align-items: center; gap: 6px; font-weight: 400;">
                            <input type="checkbox" name="tunjangan[]" value="{{ $t->id_tunjangan }}">
                            {{ $t->nama_tunjangan }} (Rp {{ number_format($t->nominal,0,',','.') }})
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="text-info">
                <i class="fas fa-info-circle"></i>
                Gaji pokok awal otomatis mengikuti jabatan.
                Dapat diubah kemudian melalui edit karyawan.
            </div>

            <div class="form-group">
                <label for="status_karyawan">Status Karyawan</label>
                <select name="status_karyawan" id="status_karyawan" class="form-control" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="fas fa-save"></i> Simpan Data
            </button>
        </form>

    </div>

</div>

@endsection
