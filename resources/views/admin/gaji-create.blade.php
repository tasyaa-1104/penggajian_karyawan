@extends('admin.template')

@section('title', 'Hitung Gaji Massal')

@section('content')

<!-- CSS Internal Khusus untuk Halaman ini agar tampilan lebih bagus -->
<style>
    .container-custom {
        width: 100%;
        padding: 20px;
        max-width: 1200px; /* Agar tidak terlalu lebar di layar besar */
        margin: 0 auto;
    }

    /* Ganti style glass-card menjadi Card Putih Bersih seperti screenshot */
    .glass-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 25px;
        border-top: 4px solid #4e73df; /* Aksen garis biru di atas */
    }

    .glass-card h3 {
        margin-bottom: 20px;
        font-size: 1.5rem;
        color: #333;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Layout Header: Judul Kiri, Input Tanggal Kanan */
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .month-wrapper {
        display: flex;
        flex-direction: column;
    }

    .month-wrapper label {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 600;
    }

    /* Style Input agar rapi */
    .search-input {
        padding: 10px 15px;
        border: 1px solid #d1d3e2;
        border-radius: 6px;
        font-size: 0.95rem;
        color: #333;
        outline: none;
        transition: border-color 0.2s;
        width: 200px;
    }

    .search-input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
    }

    /* Style Tabel Modern */
    .modern-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .modern-table thead {
        background-color: #f8f9fc;
    }

    .modern-table th {
        text-align: left;
        padding: 12px 15px;
        font-weight: 700;
        color: #4e73df; /* Warna teks header biru */
        text-transform: uppercase;
        font-size: 0.8rem;
        border-bottom: 2px solid #e3e6f0;
    }

    .modern-table td {
        padding: 12px 15px;
        color: #5a5c69;
        border-bottom: 1px solid #e3e6f0;
        vertical-align: middle;
    }

    /* Hover Effect pada baris tabel */
    .modern-table tbody tr:hover {
        background-color: #f1f7ff;
    }

    /* Style Checkbox */
    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #4e73df; /* Warna checkbox modern */
    }

    /* Badge Jabatan */
    .badge-jabatan {
        background-color: #e0e7ff;
        color: #4338ca;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Style Tombol */
    .btn-modern {
        padding: 12px 24px;
        background-color: #4e73df; /* Biru Primer */
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 5px rgba(78, 115, 223, 0.3);
    }

    .btn-modern:hover {
        background-color: #2e59d9;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(78, 115, 223, 0.4);
    }

    /* Responsif untuk HP */
    @media (max-width: 600px) {
        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .search-input {
            width: 100%;
        }
        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container-custom">
    <div class="glass-card">

        <form action="{{ route('gaji.store') }}" method="POST">
            @csrf

            <!-- Header Card -->
            <div class="form-header">
                <h3>🧮 Hitung Gaji Massal</h3>

                <div class="month-wrapper">
                    <label for="bulan">Pilih Periode</label>
                    <input type="month" name="bulan" required class="search-input" id="bulan">
                </div>
            </div>

            <!-- Tabel Data -->
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
                                       class="employee-checkbox"> <!-- Class tambahan untuk JS nanti jika perlu -->
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #333;">{{ $k->nama_karyawan }}</span>
                            </td>
                            <td>
                                <span class="badge-jabatan">{{ $k->jabatan->nama_jabatan ?? '-' }}</span>
                            </td>
                            <td style="text-align: right; font-family: 'Courier New', monospace; font-weight: 600;">
                                Rp {{ number_format($k->gaji_pokok, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: #999;">
                                Tidak ada data karyawan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Tombol Aksi -->
            <div style="text-align: right; margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit" class="btn-modern">
                    💾 Hitung & Simpan Gaji
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    // Logika Checkbox "Pilih Semua"
    document.getElementById('checkAll').addEventListener('click', function(){
        const checkboxes = document.querySelectorAll('input[name="id_karyawan[]"]');
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
    });

    // Set default input bulan ke bulan saat ini (UX Improvement)
    const dateInput = document.getElementById('bulan');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    if(dateInput) dateInput.value = `${yyyy}-${mm}`;
</script>

@endsection
