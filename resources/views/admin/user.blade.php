@extends('admin.template')

@section('title', 'Data User')

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

        /* Warna Aksi */
        --btn-edit: #00897B; /* Teal - Edit */
        --btn-edit-hover: #00695C;
        --btn-del: #EF5350;   /* Soft Red - Hapus */
        --btn-del-hover: #E53935;
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
    .card-box {
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
    .btn {
        padding: 10px 20px; border: none; border-radius: 6px; font-family: 'Poppins', sans-serif;
        font-size: 0.9rem; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-decoration: none; color: white;
    }
    .btn-add {
        background-color: var(--smart-maroon);
        color: white;
    }
    .btn-add:hover { background-color: var(--smart-maroon-hover); transform: translateY(-2px); box-shadow: 0 4px 10px rgba(128, 0, 0, 0.3); }

    /* Action Buttons */
    .btn-action {
        padding: 6px 12px; font-size: 0.85rem; font-weight: 600; border-radius: 6px;
        border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s; text-decoration: none; color: white;
    }
    .btn-edit { background-color: var(--btn-edit); }
    .btn-edit:hover { background-color: var(--btn-edit-hover); transform: translateY(-1px); }

    .btn-delete { background-color: var(--btn-del); }
    .btn-delete:hover { background-color: var(--btn-del-hover); transform: translateY(-1px); }

    /* Container Tombol Aksi */
    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }

    /* --- TABLE (MAROON HEADER) --- */
    table.modern-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table.modern-table thead { background-color: var(--smart-maroon); }
    table.modern-table thead th {
        padding: 15px; text-align: left; color: white; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;
    }

    table.modern-table tbody tr { border-bottom: 1px solid #f0f0f0; transition: 0.2s; }
    table.modern-table tbody tr:last-child { border-bottom: none; }
    table.modern-table tbody tr:hover { background-color: #fafafa; }

    table.modern-table td {
        padding: 15px;
        color: #64748b;
        font-size: 0.95rem;
        vertical-align: middle;
    }

    /* Kolom No & Nama */
    table.modern-table td:nth-child(1) {
        color: var(--smart-maroon);
        font-weight: 800;
        text-align: center;
        width: 50px;
    }
    table.modern-table td:nth-child(2) {
        color: #1e293b;
        font-weight: 700;
    }

    /* --- BADGE STATUS --- */
    .badge-sharp { padding: 5px 12px; border-radius: 14px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; }
    .badge-aktif { background: #d1fae5; color: #059669; border: 1px solid #6ee7b7; }
    .badge-nonaktif { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }

    /* --- ALERT --- */
    .alert { background-color: #E8F5E9; color: #2E7D32; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #43A047; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; font-weight: 600; }
    .empty-state { text-align: center; padding: 40px; color: #999; font-style: italic; }

    /* --- MODAL --- */
    .modal {
        display: none; position: fixed; z-index: 200; left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;
        backdrop-filter: blur(4px);
    }
    .modal.show { display: flex; animation: fadeIn 0.3s; }
    .modal-content {
        background-color: white; width: 90%; max-width: 500px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); overflow: hidden;
        transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modal.show .modal-content { transform: scale(1); }
    .modal-header { background-color: var(--smart-maroon); padding: 20px; display: flex; justify-content: space-between; align-items: center; }
    .modal-header h3 { margin: 0; color: white; font-size: 1.2rem; font-weight: 600; }
    .modal-body { padding: 30px; }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark); font-size: 0.9rem; }
    .form-control {
        width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-family: 'Poppins'; font-size: 0.95rem; transition: 0.3s; background: #f8fafc;
    }
    .form-control:focus { border-color: var(--btn-edit); outline: none; background: white; box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.1); }

    .modal-footer { padding: 20px 30px; background-color: #f9f9f9; text-align: right; display: flex; justify-content: flex-end; gap: 12px; }
    .btn-cancel { background: #e9ecef; color: #495057; }
    .btn-cancel:hover { background: #dee2e6; }
    .btn-submit { background: var(--smart-maroon); color: white; }
    .btn-submit:hover { background: var(--smart-maroon-hover); }

    /* Loading Spinner */
    .spinner {
        display: none;
        width: 16px; height: 16px;
        border: 2px solid #ffffff;
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    /* =========================================
       RESPONSIF DATA USER
       ========================================= */

    /* Tablet */
    @media (max-width: 991px) {
        .website-layout {
            padding: 20px;
            padding-top: 90px;
        }

        .card-box {
            padding: 20px;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .website-layout {
            padding: 15px;
            padding-top: 20px;
        }

        .card-box {
            padding: 15px;
            border-radius: 8px;
        }

        /* Welcome banner vertikal */
        .welcome-card {
            flex-direction: column;
            text-align: center;
            padding: 15px;
            gap: 12px;
        }

        .welcome-icon {
            width: 42px;
            height: 42px;
            font-size: 1.2rem;
        }

        .welcome-text-content h3 {
            font-size: 1.1rem;
        }

        .welcome-text-content p {
            font-size: 0.82rem;
        }

        /* Page header stack */
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .page-title {
            font-size: 1.05rem;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
            padding: 10px 16px;
            font-size: 0.85rem;
        }

        /* Alert wrap */
        .alert {
            flex-wrap: wrap;
            font-size: 0.82rem;
            padding: 10px 15px;
        }

        /* Table compact */
        table.modern-table thead th {
            padding: 10px 8px;
            font-size: 0.68rem;
            letter-spacing: 0.3px;
        }

        table.modern-table td {
            padding: 10px 8px;
            font-size: 0.8rem;
        }

        /* Badge lebih kecil */
        .badge-sharp {
            padding: 4px 8px;
            font-size: 0.65rem;
        }

        /* Action buttons stack vertikal */
        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }

        .btn-action {
            padding: 6px 10px;
            font-size: 0.75rem;
            justify-content: center;
            width: 100%;
        }

        /* Modal */
        .modal-content {
            width: 95%;
            max-width: 95%;
            border-radius: 10px;
        }

        .modal-header {
            padding: 15px;
        }

        .modal-header h3 {
            font-size: 1rem;
        }

        .modal-body {
            padding: 20px 15px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 0.82rem;
            margin-bottom: 6px;
        }

        .form-control {
            padding: 10px;
            font-size: 0.85rem;
        }

        .modal-footer {
            padding: 15px;
            flex-direction: column;
            gap: 8px;
        }

        .modal-footer .btn {
            width: 100%;
            justify-content: center;
            padding: 10px 16px;
            font-size: 0.85rem;
        }
    }

    /* Mobile kecil */
    @media (max-width: 400px) {
        .website-layout {
            padding: 10px;
            padding-top: 15px;
        }

        .card-box {
            padding: 12px;
        }

        .welcome-text-content h3 {
            font-size: 1rem;
        }

        .page-title {
            font-size: 0.95rem;
        }

        table.modern-table thead th {
            padding: 8px 6px;
            font-size: 0.62rem;
        }

        table.modern-table td {
            padding: 8px 6px;
            font-size: 0.75rem;
        }

        .badge-sharp {
            font-size: 0.6rem;
            padding: 3px 6px;
        }
    }
</style>

<div class="website-layout">

    <div class="card-box">

        <!-- 👋 BANNER SELAMAT DATANG -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-user-gear"></i>
            </div>
            <div class="welcome-text-content">
                <h3>Data User</h3>
                <p>Kelola akses login dan hak akses sistem.</p>
            </div>
        </div>

        <div class="page-header">
            <h4 class="page-title">Daftar Pengguna</h4>

            <button class="btn btn-add" onclick="openModal('create')">
                <i class="fas fa-plus"></i> Tambah User
            </button>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table class="modern-table" id="userTable">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th width="15%">Status</th>
                        <th width="15%" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->username }}</td>
                            <td><strong>{{ $u->nama }}</strong></td>
                            <td>{{ ucfirst($u->role) }}</td>
                            <td>
                                <span class="badge-sharp {{ $u->status_akun == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                                    {{ ucfirst($u->status_akun) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <!-- TOMBOL AKSI -->
                                <div class="action-buttons">

                                    <!-- Button Edit (Menggunakan Logika JS Asli) -->
                                    <button class="btn-action btn-edit"
                                        onclick="openModal('edit', {{ $u->id }}, '{{ $u->username }}', '{{ $u->nama }}', '{{ $u->role }}', '{{ $u->status_akun }}')">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>

                                    <!-- Form Delete -->
                                    <form action="{{ route('user.destroy',$u->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus user ini?')">
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

<!-- MODAL USER (Create / Edit) -->
<div class="modal" id="userModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah User</h3>
            <span style="cursor:pointer; color:white;" onclick="closeModal()"><i class="fas fa-times"></i></span>
        </div>
        <div class="modal-body">
            <form id="userForm" action="{{ route('user.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="userId">
                <input type="hidden" name="_method" value="POST" id="methodInput">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username..." required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama user..." required>
                </div>

                <div class="form-group">
                    <label id="passwordLabel">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password..." required>
                    <small id="passwordHint" class="text-muted" style="display:none; color: #64748b;">Kosongkan jika tidak ingin mengubah password</small>
                </div>

                <div class="form-group">
                    <label>Role Pengguna</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="hrd">HRD</option>
                        <option value="karyawan">Karyawan</option>
                        <option value="finance">Finance</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>

                <!-- Status Group (Hidden by default, shown via JS in Edit mode) -->
                <div class="form-group" id="statusGroup" style="display: none;">
                    <label>Status Akun</label>
                    <select name="status_akun" id="status_akun" class="form-control" required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" form="userForm" class="btn btn-submit" id="btnSubmit">
                        <span class="spinner" id="loadingSpinner"></span>
                        <span id="btnText">Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    function openModal(mode, id = null, username = '', nama = '', role = '', status = '') {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        const title = document.getElementById('modalTitle');

        modal.style.display = "flex";
        setTimeout(() => { modal.classList.add('show'); }, 10);

        if (mode === 'create') {
            // --- MODE CREATE ---
            form.action = "{{ route('user.store') }}";
            form.method = "POST";
            document.getElementById('methodInput').value = "POST";
            title.innerText = "Tambah User Baru";
            document.getElementById('userId').value = "";
            document.getElementById('username').value = "";
            document.getElementById('nama').value = "";
            document.getElementById('role').value = "";
            document.getElementById('password').required = true;
            document.getElementById('password').value = "";
            document.getElementById('passwordLabel').innerText = "Password *";
            document.getElementById('passwordHint').style.display = "none";

            document.getElementById('status_akun').value = "aktif";
            document.getElementById('statusGroup').style.display = "none";
        } else {
            // --- MODE EDIT ---
            form.action = "{{ route('user.update', ':id') }}".replace(':id', id);
            form.method = "POST";
            document.getElementById('methodInput').value = "PUT";
            title.innerText = "Edit Data User";
            document.getElementById('userId').value = id;
            document.getElementById('username').value = username;
            document.getElementById('nama').value = nama;
            document.getElementById('role').value = role;
            document.getElementById('status_akun').value = status;

            document.getElementById('password').required = false;
            document.getElementById('password').value = "";
            document.getElementById('passwordLabel').innerText = "Password (Opsional)";
            document.getElementById('passwordHint').style.display = "block";
            document.getElementById('statusGroup').style.display = "block";
        }
    }

    function closeModal() {
        const modal = document.getElementById('userModal');
        modal.classList.remove('show');
        setTimeout(() => { modal.style.display = "none"; }, 300);
    }

    window.onclick = function(event) {
        const modal = document.getElementById('userModal');
        if (event.target == modal) {
            closeModal();
        }
    }

    document.getElementById('userForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('btnSubmit');
        const spinner = document.getElementById('loadingSpinner');
        const btnText = document.getElementById('btnText');

        spinner.style.display = 'inline-block';
        btnText.innerText = 'Menyimpan...';
        btn.disabled = true;
        btn.style.opacity = '0.7';
    });
</script>

@endsection
