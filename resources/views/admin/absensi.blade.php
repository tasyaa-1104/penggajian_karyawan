@extends('admin.template')

@section('title', 'Data Absensi')

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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

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

    /* Action Buttons - Diperjelas Kontrasnya */
    .btn-action {
        padding: 6px 12px; font-size: 0.85rem; font-weight: 700; border-radius: 6px; /* Font weight diperkuat */
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
        gap: 8px; /* Jarak dikurangi sedikit agar rapat */
        justify-content: center;
        align-items: center;
    }

    /* --- SEARCH --- */
    .search-box {
        display: flex; align-items: center; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 30px; padding: 5px 20px; margin-bottom: 20px; max-width: 400px; transition: all 0.3s;
    }
    .search-box:focus-within { border-color: var(--smart-maroon); box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1); }
    .search-box input { border: none; background: transparent; outline: none; width: 100%; padding: 5px; font-family: 'Poppins'; color: #333; }
    .search-icon { color: #adb5bd; }

    /* --- TABLE (MAROON HEADER) --- */
    table.modern-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table.modern-table thead { background-color: var(--smart-maroon); }
    table.modern-table thead th {
        padding: 15px; text-align: left; color: white; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;
    }
    table.modern-table tbody tr { border-bottom: 1px solid #f0f0f0; transition: 0.2s; }
    table.modern-table tbody tr:last-child { border-bottom: none; }
    table.modern-table tbody tr:hover { background-color: #fafafa; }

    /* Default Teks Tabel */
    table.modern-table td {
        padding: 15px;
        color: #64748b; /* Abu sedikit lebih gelap agar terbaca */
        font-size: 0.95rem;
        vertical-align: middle;
    }

    /* --- PERBAIKAN VISIBILITAS NO, NAMA, AKSI --- */

    /* Kolom No: Maroon Gelap & Tebal */
    table.modern-table td:nth-child(1) {
        color: var(--smart-maroon);
        font-weight: 800;
        text-align: center;
        font-size: 1rem;
    }

    /* Kolom Nama: Hitam/Abu Gelap & Tebal (AGAR KELIHATAN) */
    table.modern-table td:nth-child(2) {
        color: #1e293b; /* Warna sangat gelap, hampir hitam */
        font-weight: 700;
    }

    /* Kolom Aksi: Pastikan tombol menonjol */
    table.modern-table td:last-child {
        text-align: center;
        vertical-align: middle;
    }

    /* Badge Status */
    .badge-sharp { padding: 5px 12px; border-radius: 14px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; }
    .badge-hadir { background: #d1fae5; color: #059669; border: 1px solid #6ee7b7; }
    .badge-izin { background: #ffedd5; color: #92400e; border: 1px solid #fde68a; }
    .badge-sakit { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .badge-alpha { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }

    /* --- ALERT --- */
    .alert { background-color: #E8F5E9; color: #2E7D32; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #43A047; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; font-weight: 600; }
    .alert-error { background-color: #FEE2E2; color: #991B1B; border-left: 5px solid #EF4444; }

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

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

</style>

<div class="website-layout">

    <div class="card-box">

        <!-- 👋 BANNER SELAMAT DATANG -->
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-clock-rotate-left"></i>
            </div>
            <div class="welcome-text-content">
                <h3>Data Absensi</h3>
                <p>Pantau kehadiran dan aktivitas karyawan.</p>
            </div>
        </div>

        <div class="page-header">
            <h4 class="page-title">Daftar Absensi</h4>

            <button class="btn btn-add" onclick="openModal('create')">
                <i class="fas fa-plus"></i> Tambah Absensi
            </button>
        </div>

        <form action="{{ route('absensi') }}" method="GET" class="search-box">
            <input type="text"
                   name="search"
                   placeholder="Cari nama karyawan..."
                   value="{{ request('search') }}">
            <button type="submit" style="background:none; border:none; cursor:pointer; color:var(--smart-maroon);">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('absensi') }}" style="text-decoration:none; color:#adb5bd; margin-left:10px; font-size:1.1rem;">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </span>
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th width="15%" style="text-align: center;">Aksi</th>
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
                            <td style="font-family: monospace;">{{ $a->jam_masuk ?? '-' }}</td>
                            <td style="font-family: monospace;">{{ $a->jam_pulang ?? '-' }}</td>
                            <td>
                                @if($a->status_kehadiran == 'Hadir')
                                    <span class="badge-sharp badge-hadir">Hadir</span>
                                @elseif($a->status_kehadiran == 'Izin')
                                    <span class="badge-sharp badge-izin">Izin</span>
                                @elseif($a->status_kehadiran == 'Sakit')
                                    <span class="badge-sharp badge-sakit">Sakit</span>
                                @else
                                    <span class="badge-sharp badge-alpha">Alpha</span>
                                @endif
                            </td>
                            <td><small>{{ $a->keterangan ?? '-' }}</small></td>
                            <td>
                                <!-- TOMBOL AKSI (LOGIKA JS DIPERTAHANKAN) -->
                                <div class="action-buttons">

                                    <!-- Edit Button (Data Attributes untuk Logika JS Anda) -->
                                    <button class="btn-action btn-edit"
                                        data-id="{{ $a->id_absensi }}"
                                        data-karyawan="{{ $a->id_karyawan }}"
                                        data-tanggal="{{ $a->tanggal }}"
                                        data-status="{{ $a->status_kehadiran }}"
                                        data-ket="{{ json_encode($a->keterangan) }}"
                                        onclick="openModal('edit', this)">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('absensi.destroy',$a->id_absensi) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus data absensi ini?')">
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

<!-- MODAL ABSENSI (Create / Edit) -->
<div class="modal" id="absensiModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Absensi</h3>
            <span style="cursor:pointer; color:white;" onclick="closeModal()"><i class="fas fa-times"></i></span>
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
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan..."></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" form="absensiForm" class="btn btn-submit">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOGIC (TIDAK DIUBAH) -->
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
            form.method = "POST";
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
            // Mengambil Data dari Button (Logika Asli Dipertahankan)
            const id = element.getAttribute('data-id');
            const karyawan = element.getAttribute('data-karyawan');
            const tanggal = element.getAttribute('data-tanggal');
            const status = element.getAttribute('data-status');
            const ket = element.getAttribute('data-ket');

            // Update Form Action ke Route Edit
            form.action = "{{ route('absensi.update', ':id') }}".replace(':id', id);
            form.method = "POST";
            document.getElementById('methodInput').value = "PUT";
            title.innerText = "Edit Data Absensi";

            // Isi Data ke Form
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
