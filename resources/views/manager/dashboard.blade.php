{{-- @extends('manager.template')

@section('content')

<h3 class="mb-4">Dashboard Manager</h3>

<div class="row g-4">

<div class="col-md-3">
<div class="card bg-primary text-white shadow">
<div class="card-body">
<h6>Total Karyawan</h6>
<h3>{{ $jumlah_karyawan }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-warning text-white shadow">
<div class="card-body">
<h6>Cuti Pending</h6>
<h3>{{ $cuti_pending }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white shadow">
<div class="card-body">
<h6>Cuti Disetujui</h6>
<h3>{{ $cuti_disetujui ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Cuti Ditolak</h6>
<h3>{{ $cuti_ditolak ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-secondary text-white shadow">
<div class="card-body">
<h6>Lembur Pending</h6>
<h3>{{ $overtime_pending ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-info text-white shadow">
<div class="card-body">
<h6>Lembur Disetujui</h6>
<h3>{{ $overtime_approved ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Lembur Ditolak</h6>
<h3>{{ $overtime_rejected ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-dark text-white shadow">
<div class="card-body">
<h6>Absensi Hari Ini</h6>
<h3>{{ $absensi_hari_ini ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Izin Pending</h6>
<h3>{{ $izin_pending ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white shadow">
<div class="card-body">
<h6>Izin Disetujui</h6>
<h3>{{ $izin_approved ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Izin Ditolak</h6>
<h3>{{ $izin_rejected ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-warning text-white shadow">
<div class="card-body">
<h6>Sakit Pending</h6>
<h3>{{ $sakit_pending ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white shadow">
<div class="card-body">
<h6>Sakit Disetujui</h6>
<h3>{{ $sakit_approved ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Sakit Ditolak</h6>
<h3>{{ $sakit_rejected ?? 0 }}</h3>
</div>
</div>
</div>

</div>

@endsection --}}
@extends('manager.template')

@section('title', 'Dashboard Manager')

@section('content')

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Page Title Section */
    .page-title-section {
        background: linear-gradient(135deg, #FFF5F5 0%, #FEE2E2 100%);
        border-left: 5px solid #9B1C20;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .page-title {
        color: #9B1C20;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 3px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

    /* Stat Cards */
    .stat-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.12);
    }

    .stat-card .card-body {
        padding: 16px 18px;
    }

    .stat-card .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .stat-card .stat-label {
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 2px;
        opacity: 0.9;
    }

    .stat-card .stat-value {
        font-size: 26fr;
        font-weight: 700;
        margin: 0;
    }

    /* ========== WARNA SENADA ========== */

    /* Total Karyawan - Merah Tua (Brand) */
    .card-total {
        background: linear-gradient(135deg, #9B1C20 0%, #B91C1C 100%);
        color: white;
    }

    /* Absensi - Merah Muda */
    .card-absensi {
        background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
        color: white;
    }

    /* Pending - Orange/Kuning Warm */
    .card-pending {
        background: linear-gradient(135deg, #EA580C 0%, #F97316 100%);
        color: white;
    }

    /* Disetujui - Hijau Tua Elegan */
    .card-approved {
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: white;
    }

    /* Ditolak - Merah Bold */
    .card-rejected {
        background: linear-gradient(135deg, #BE123C 0%, #E11D48 100%);
        color: white;
    }
</style>

<div class="container-fluid mt-3">

    <!-- Page Title Section -->
    <div class="page-title-section">
        <h3 class="page-title">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Manager
        </h3>
        <p class="page-subtitle">Ringkasan data karyawan</p>
    </div>

    {{-- ROW 1: Total Karyawan & Absensi --}}
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card stat-card card-total">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Total Karyawan</p>
                        <h3 class="stat-value">{{ $jumlah_karyawan }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card stat-card card-absensi">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Absensi Hari Ini</p>
                        <h3 class="stat-value">{{ $absensi_hari_ini ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CUTI --}}
    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Cuti Pending</p>
                        <h3 class="stat-value">{{ $cuti_pending }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Cuti Disetujui</p>
                        <h3 class="stat-value">{{ $cuti_disetujui ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Cuti Ditolak</p>
                        <h3 class="stat-value">{{ $cuti_ditolak ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LEMBUR --}}
    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Lembur Pending</p>
                        <h3 class="stat-value">{{ $overtime_pending ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Lembur Disetujui</p>
                        <h3 class="stat-value">{{ $overtime_approved ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Lembur Ditolak</p>
                        <h3 class="stat-value">{{ $overtime_rejected ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- IZIN --}}
    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Izin Pending</p>
                        <h3 class="stat-value">{{ $izin_pending ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Izin Disetujui</p>
                        <h3 class="stat-value">{{ $izin_disetujui ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Izin Ditolak</p>
                        <h3 class="stat-value">{{ $izin_ditolak ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SAKIT --}}
    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Sakit Pending</p>
                        <h3 class="stat-value">{{ $sakit_pending ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Sakit Disetujui</p>
                        <h3 class="stat-value">{{ $sakit_disetujui ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Sakit Ditolak</p>
                        <h3 class="stat-value">{{ $sakit_ditolak ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
