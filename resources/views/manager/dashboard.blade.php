@extends('manager.template')

@section('content')

<h3 class="mb-4">Dashboard Manager</h3>

<div class="row g-4">

    {{-- TOTAL KARYAWAN --}}
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h6>Total Karyawan</h6>
                <h3>{{ $jumlah_karyawan }}</h3>
            </div>
        </div>
    </div>

    {{-- CUTI PENDING --}}
    <div class="col-md-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h6>Cuti Pending</h6>
                <h3>{{ $cuti_pending }}</h3>
            </div>
        </div>
    </div>

    {{-- CUTI DISETUJUI --}}
    <div class="col-md-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h6>Cuti Disetujui</h6>
                <h3>{{ $cuti_disetujui ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- CUTI DITOLAK --}}
    <div class="col-md-3">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h6>Cuti Ditolak</h6>
                <h3>{{ $cuti_ditolak ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- LEMBUR PENDING --}}
    <div class="col-md-3">
        <div class="card bg-secondary text-white shadow">
            <div class="card-body">
                <h6>Lembur Pending</h6>
                <h3>{{ $overtime_pending ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- LEMBUR DISETUJUI --}}
    <div class="col-md-3">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <h6>Lembur Disetujui</h6>
                <h3>{{ $overtime_approved ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- LEMBUR DITOLAK --}}
    <div class="col-md-3">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h6>Lembur Ditolak</h6>
                <h3>{{ $overtime_rejected ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- ABSENSI HARI INI --}}
    <div class="col-md-3">
        <div class="card bg-dark text-white shadow">
            <div class="card-body">
                <h6>Absensi Hari Ini</h6>
                <h3>{{ $absensi_hari_ini ?? 0 }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection