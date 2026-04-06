@extends('finance.template')

@section('title', 'Hitung Gaji Massal')

@section('content')

<!-- Tambahkan Link FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        /* --- PALET WARNA MAROON SENADA FOTO (Deep Maroon) --- */
        --maroon-main: #800000;       /* Maroon Utama (Warna Sidebar di Foto) */
        --maroon-light: #a52a2a;     /* Merah Bata (Hover) */
        --maroon-dark: #450b0b;      /* Maroon Gelap (Shadow/Gradient) */
        --bg-page: #F3F4F6;
        --bg-white: #FFFFFF;
        --text-dark: #2c3e50;
        --text-grey: #7f8c8d;
        --border-color: #e0e0e0;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-page);
        color: var(--text-dark);
    }

    .container-custom {
        width: 100%;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* --- CARD STYLE --- */
    .glass-card {
        background: var(--bg-white);
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-top: 5px solid var(--maroon-main); /* Garis Maroon Pekat di atas */
        border: 1px solid var(--border-color);
    }

    /* --- PAGE HEADER --- */
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
        border-bottom: 2px solid #f5f5f5;
        padding-bottom: 20px;
    }

    .section-title {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-dark);
        border-left: 5px solid var(--maroon-main);
        padding-left: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .month-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .month-wrapper label {
        font-size: 0.8rem;
        color: var(--text-grey);
        margin-bottom: 5px;
        font-weight: 600;
        text-transform: uppercase;
    }

    /* --- INPUT STYLE --- */
    .search-input {
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.95rem;
        color: var(--text-dark);
        outline: none;
        transition: all 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .search-input:focus {
        border-color: var(--maroon-main); /* Focus warna Maroon */
        box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1);
    }

    /* --- TABLE STYLE --- */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .modern-table thead {
        background-color: var(--maroon-main); /* Header Tabel Maroon Gelap (Seperti Foto) */
        color: white;
    }

    .modern-table th {
        text-align: left;
        padding: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
    }

    /* Sudut membulat pada header tabel */
    .modern-table thead tr th:first-child { border-top-left-radius: 10px; }
    .modern-table thead tr th:last-child { border-top-right-radius: 10px; }

    .modern-table td {
        padding: 15px;
        color: var(--text-grey);
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    /* Hover Effect baris tabel */
    .modern-table tbody tr {
        transition: background 0.2s;
    }
    .modern-table tbody tr:hover {
        background-color: #FFF5F5; /* Merah sangat muda saat hover */
    }

    /* Checkbox Style */
    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--maroon-main); /* Checkbox Maroon */
    }

    /* Badge Jabatan */
    .badge-jabatan {
        background-color: #FADBD8; /* Merah sangat muda */
        color: #922B21; /* Teks Maroon Gelap */
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    /* --- BUTTON STYLE --- */
    .btn-modern {
        padding: 12px 30px;
        /* Gradasi Maroon Gelap ke Terang */
        background: linear-gradient(135deg, var(--maroon-main), var(--maroon-light));
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(128, 0, 0, 0.3);
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(128, 0, 0, 0.4);
        background: linear-gradient(135deg, var(--maroon-light), var(--maroon-dark));
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .month-wrapper {
            align-items: flex-start;
            width: 100%;
        }
        .search-input {
            width: 100%;
        }
        .btn-modern {
            width: 100%;
            justify-content: center;
        }
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<div class="container-custom">
    <div class="glass-card">

        <form action="{{ route('gaji.store') }}" method="POST">
            @csrf

            <!-- Header Card -->
            <div class="form-header">
                <h3 class="section-title">
                    <i class="fas fa-calculator" style="color: var(--maroon-main);"></i> Hitung Gaji Massal
                </h3>

                <div style="display:flex; gap:15px;">

                <div class="month-wrapper">
                    <label for="bulan">Pilih Bulan</label>
                    <input type="month" name="bulan" required class="search-input" id="bulan">
                </div>

                <div class="month-wrapper">
                    <label>Jenis Periode</label>
                    <select name="jenis_periode" class="search-input" required>
                        <option value="akhir">Akhir Bulan</option>
                        <option value="25">Periode Tanggal 25</option>
                    </select>
                </div>

            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th style="width: 35%;">Nama Karyawan</th>
                            <th style="width: 30%;">Jabatan</th>
                            <th style="width: 35%; text-align: right;">Gaji Pokok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawan as $k)
                            <tr>
                                <td style="text-align: center;">
                                    <input type="checkbox"
                                           name="id_karyawan[]"
                                           value="{{ $k->id_karyawan }}"
                                           class="employee-checkbox">
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: var(--text-dark);">{{ $k->nama_karyawan }}</span>
                                </td>
                                <td>
                                    <span class="badge-jabatan">{{ $k->jabatan->nama_jabatan ?? '-' }}</span>
                                </td>
                                <td style="text-align: right; font-family: 'Roboto Mono', monospace; font-weight: 600; color: var(--text-dark);">
                                    Rp {{ number_format($k->gaji_pokok, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 40px; color: #999;">
                                    <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display:block;"></i>
                                    Tidak ada data karyawan ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tombol Aksi -->
            <div style="text-align: right; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit" class="btn-modern">
                    <i class="fas fa-save"></i> Hitung & Simpan Gaji
                </button>
            </div>

        </form>
    </div>
</div>

<!-- LOGIKA JAVASCRIPT (TIDAK DIUBAH) -->
<script>
    // Logika Checkbox "Pilih Semua"
    document.getElementById('checkAll').addEventListener('click', function(){
        const checkboxes = document.querySelectorAll('input[name="id_karyawan[]"]');
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
    });

    // Set default input bulan ke bulan saat ini
    const dateInput = document.getElementById('bulan');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    if(dateInput) dateInput.value = `${yyyy}-${mm}`;
</script>

@endsection
