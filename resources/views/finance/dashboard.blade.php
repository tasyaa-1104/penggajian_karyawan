@extends('finance.template')

@section('content')

<h3 class="mb-4">Dashboard Finance</h3>

<div class="row g-4">

    <!-- Total Karyawan -->
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h6>Total Karyawan</h6>
                <h3>{{ $jumlah_karyawan ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Gaji Bulan Ini -->
    <div class="col-md-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h6>Total Gaji Bulan Ini</h6>
                <h3>Rp {{ number_format($total_gaji ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Cuti Disetujui -->
    <div class="col-md-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h6>Cuti Disetujui</h6>
                <h3>{{ $cuti_disetujui ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Penggajian Pending -->
    <div class="col-md-3">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h6>Penggajian Pending</h6>
                <h3>{{ $penggajian_pending ?? 0 }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection
