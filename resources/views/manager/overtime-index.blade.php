@extends('manager.template')

@section('title', 'Persetujuan Lembur')

@section('content')

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Page Title Section */
    .page-title-section {
        background: #FFF5F5;
        border-left: 5px solid #9B1C20;
        padding: 20px 25px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .page-title {
        color: #9B1C20;
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    /* Card Styling */
    .main-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }

    .main-card .card-body {
        padding: 25px;
    }

    /* Table Styling */
    .custom-table {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .custom-table thead th {
        background: #9B1C20 !important;
        color: white !important;
        font-weight: 500;
        font-size: 14px;
        padding: 15px 12px;
        border: none;
        vertical-align: middle;
    }

    .custom-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #fee2e2;
        font-size: 14px;
    }

    .custom-table tbody tr:hover {
        background: #FFF5F5;
    }

    /* Status Badges */
    .badge-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-pending {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .badge-approved {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .badge-rejected {
        background: #FEE2E2 !important;
        color: #9B1C20 !important;
    }

    /* Buttons */
    .btn-approve {
        background: #D1FAE5 !important;
        color: #065F46 !important;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .btn-approve:hover {
        background: #065F46 !important;
        color: white !important;
    }

    .btn-reject {
        background: #FEE2E2 !important;
        color: #9B1C20 !important;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .btn-reject:hover {
        background: #9B1C20 !important;
        color: white !important;
    }

    /* Alert Styling */
    .alert-success {
        background: #D1FAE5;
        color: #065F46;
        border: none;
        border-radius: 10px;
        padding: 15px 20px;
    }

    .alert-danger {
        background: #FEE2E2;
        color: #9B1C20;
        border: none;
        border-radius: 10px;
        padding: 15px 20px;
    }

    /* Empty State */
    .text-muted {
        color: #9ca3af !important;
        font-style: italic;
    }
</style>

<div class="container-fluid mt-4">

    <!-- Page Title Section -->
    <div class="page-title-section">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="page-title">
                    <i class="fas fa-clock me-2"></i> Persetujuan Lembur
                </h3>
                <p class="page-subtitle">Kelola persetujuan lembur karyawan</p>
            </div>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Main Card -->
    <div class="card main-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table custom-table">
                  <thead>
    <tr>
        <th>No</th>
        <th>Karyawan</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Total Jam</th>
        <th>Upah</th>
        <th>Foto</th> {{-- 🔥 TAMBAHAN --}}
        <th>Status</th>
        <th style="width: 160px;">Aksi</th>
    </tr>
</thead>

<tbody>
@forelse($overtimes as $overtime)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        <strong>{{ $overtime->karyawan->nama_karyawan ?? '-' }}</strong>
    </td>

    <td>
        {{ \Carbon\Carbon::parse($overtime->tanggal)->format('d-m-Y') }}
    </td>

    <td>
        @if($overtime->jam_mulai)
            {{ $overtime->jam_mulai }} - {{ $overtime->jam_selesai }}
        @else
            <span style="color:red;">Menunggu Generate</span>
        @endif
    </td>

    <td>{{ $overtime->total_jam ?? 0 }} Jam</td>

    <td>
        Rp {{ number_format($overtime->total_upah ?? 0,0,',','.') }}
    </td>

    {{-- 🔥 FOTO --}}
    <td style="text-align:center;">
        @if($overtime->foto)
            <a href="{{ asset('storage/' . $overtime->foto) }}" target="_blank">
                <img src="{{ asset('storage/' . $overtime->foto) }}"
                     style="width:50px; height:50px; object-fit:cover; border-radius:8px;">
            </a>
        @else
            <span style="color:#999;">-</span>
        @endif
    </td>

    {{-- STATUS --}}
    <td>
        @if($overtime->status == 'pending')
            <span class="badge-status badge-pending">Pending</span>
        @elseif($overtime->status == 'approved')
            <span class="badge-status badge-approved">Approved</span>
        @elseif($overtime->status == 'rejected')
            <span class="badge-status badge-rejected">Rejected</span>
        @endif
    </td>

    {{-- AKSI --}}
    <td>
        @if($overtime->status == 'pending')
            <div class="d-flex gap-2">
                <form action="{{ route('overtime.approve', $overtime->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-approve" onclick="return confirm('Setujui lembur ini?')">
                        ✔ Approve
                    </button>
                </form>

                <form action="{{ route('overtime.reject', $overtime->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-reject" onclick="return confirm('Tolak lembur ini?')">
                        ✖ Reject
                    </button>
                </form>
            </div>
        @else
            <span class="text-muted">Selesai</span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="9" class="text-center py-5">
        <i class="fas fa-clock text-muted" style="font-size: 50px;"></i>
        <p class="text-muted mt-3">Tidak ada data lembur</p>
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
