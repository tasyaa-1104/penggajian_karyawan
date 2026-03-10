@extends('manager.template')

@section('title', 'Laporan')

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

    .badge-normal {
        background: #E5E7EB !important;
        color: #374151 !important;
    }

    /* Empty State */
    .empty-state {
        padding: 50px 20px;
        text-align: center;
    }

    .empty-state i {
        font-size: 60px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 16px;
        margin: 0;
    }
</style>

<div class="container-fluid mt-4">

    <!-- Page Title Section -->
    <div class="page-title-section">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="page-title">
                    <i class="fas fa-file-alt me-2"></i> Laporan Data Karyawan
                </h3>
                <p class="page-subtitle">Laporan absensi, cuti, dan lembur karyawan</p>
            </div>
        </div>
    </div>

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
                            <th>Absensi</th>
                            <th>Cuti</th>
                            <th>Lembur</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $data->karyawan->nama_karyawan ?? '-' }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $data->status ?? 'Hadir' }}</td>
                            <td>{{ $data->cuti ?? '-' }}</td>
                            <td>
                                @if($data->overtime)
                                    {{ $data->overtime->total_jam }} Jam
                                @else
                                    0 Jam
                                @endif
                            </td>
                            <td>
                                @if($data->status == 'approved')
                                    <span class="badge-status badge-approved">Approved</span>
                                @elseif($data->status == 'pending')
                                    <span class="badge-status badge-pending">Pending</span>
                                @elseif($data->status == 'rejected')
                                    <span class="badge-status badge-rejected">Rejected</span>
                                @else
                                    <span class="badge-status badge-normal">Normal</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-file-alt"></i>
                                    <p>Tidak ada data laporan</p>
                                </div>
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
