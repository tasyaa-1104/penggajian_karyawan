
@extends('template')

@section('title', 'Pengajuan Cuti')

@section('content')

<style>
    /* --- 1. GENERAL & TYPOGRAPHY --- */
    body { background-color: #f0f2f5; }
    h4.page-title {
        color: #8B0000;
        font-weight: 700;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 15px;
    }

    /* --- 2. CARD STYLE (RED THEME) --- */
    .card-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        background: #ffffff;
        margin-bottom: 30px;
        border-top: 4px solid #8B0000; /* Garis Merah Tua di Atas */
    }

    .card-header-custom {
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 15px 25px;
        font-weight: 700;
        color: #8B0000;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* --- 3. FORM ELEMENTS --- */
    .form-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        display: block;
    }
    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px;
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #8B0000;
        box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
    }

    /* Tombol Merah */
    .btn-submit {
        background: linear-gradient(135deg, #8B0000, #5c0000);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        transition: transform 0.2s;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 0, 0, 0.3);
        color: white;
    }

    /* --- 4. TABLE STYLING --- */
    .table-custom thead th {
        background-color: #fff0f0; /* Merah Muda Pucat */
        color: #8B0000;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        padding: 15px;
        border-bottom: 2px solid #8B0000;
    }
    .table-custom tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        color: #444;
    }
    .table-custom tbody tr:hover td {
        background-color: #fafafa;
    }

    /* Badge Status */
    .badge-pending { background-color: #FFF3E0; color: #F57C00; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
    .badge-disetujui { background-color: #E8F5E9; color: #2E7D32; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
    .badge-ditolak { background-color: #FFEBEE; color: #D32F2F; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
</style>

<div class="container py-4">

    <!-- Judul -->
    <h4 class="page-title">
        <i class="fa-solid fa-file-signature"></i> Form Pengajuan Cuti
    </h4>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="background-color: #E8F5E9; color: #2E7D32;">
            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm" style="background-color:#FFEBEE;color:#C62828;">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- 1. FORM PENGAJUAN (FULL WIDTH) -->
    <div class="card card-custom">
        <div class="card-header-custom">
            <i class="fa-solid fa-pen-to-square"></i> Isi Detail Pengajuan
        </div>
        <div class="card-body p-4">
            <form action="{{ route('cuti.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Alasan Cuti</label>
                        <textarea name="alasan" class="form-control" rows="3" required placeholder="Tuliskan alasan Anda secara lengkap..."></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-submit">
                            <i class="fa-regular fa-paper-plane me-2"></i> Kirim Pengajuan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. RIWAYAT CUTI (FULL WIDTH) -->
    <div class="card card-custom">
        <div class="card-header-custom">
            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Cuti Saya
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="20%">Tanggal</th>
                            <th width="60%">Alasan</th>
                            <th width="20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cuti as $c)
                            <tr>
                                <td>
                                    <span style="font-weight: 700; color: #333; display: block;">
                                        {{ \Carbon\Carbon::parse($c->tanggal_mulai)->isoFormat('DD MMM Y') }}
                                    </span>
                                    <small style="color: #888;">s/d {{ \Carbon\Carbon::parse($c->tanggal_selesai)->isoFormat('DD MMM Y') }}</small>
                                </td>
                                <!-- KOLOM ALASAN DIKEMBALIKAN DISINI -->
                                <td>
                                    <span style="color: #555;">{{ $c->alasan }}</span>
                                </td>
                                <td>
                                    @if($c->status == 'pending')
                                        <span class="badge-pending">PENDING</span>
                                    @elseif($c->status == 'disetujui')
                                        <span class="badge-disetujui">DISETUJUI</span>
                                    @else
                                        <span class="badge-ditolak">DITOLAK</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <i class="fa-regular fa-folder-open fa-3x mb-3" style="color: #ddd;"></i>
                                    <p class="mb-0 text-muted">Belum ada riwayat pengajuan cuti.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
