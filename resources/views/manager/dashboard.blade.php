@extends('manager.template')

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

</div>

@endsection
