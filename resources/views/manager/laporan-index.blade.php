{{-- {{-- @extends('manager.template')

@section('content')

<div class="container-fluid">

<h3 class="mb-4">Laporan Data Karyawan</h3>

<ul class="nav nav-tabs mb-3">

<li class="nav-item">
<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#absensi">
Absensi
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#cuti">
Cuti
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#lembur">
Lembur
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#izin">
Izin
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#sakit">
Sakit
</button>
</li>

</ul>

<div class="tab-content">



<div class="tab-pane fade show active" id="absensi">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($laporan as $a)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $a->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $a->tanggal }}</td>
<td>{{ $a->status_kehadiran }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>



<div class="tab-pane fade" id="cuti">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal Mulai</th>
<th>Tanggal Selesai</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($cuti as $c)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $c->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $c->tanggal_mulai }}</td>
<td>{{ $c->tanggal_selesai }}</td>
<td>{{ $c->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>


<div class="tab-pane fade" id="lembur">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Jam Lembur</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($lembur as $l)
<tr>
<td>{{ $loop->iteration }}</td>

<td>{{ $l->karyawan->nama_karyawan ?? '-' }}</td>

<td>{{ date('d-m-Y', strtotime($l->tanggal)) }}</td>

<td>{{ $l->total_jam }} Jam</td>
<td>{{ $l->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>



<div class="tab-pane fade" id="izin">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Alasan</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($izin as $i)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $i->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $i->tanggal }}</td>
<td>{{ $i->alasan }}</td>
<td>{{ $i->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>



<div class="tab-pane fade" id="sakit">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($sakit as $s)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $s->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $s->tanggal }}</td>
<td>{{ $s->keterangan }}</td>
<td>{{ $s->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection --}}
{{-- @extends('manager.template')

@section('title', 'Laporan Data Karyawan')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

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


    .main-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }

    .main-card .card-body {
        padding: 25px;
    }


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

    .badge-hadir {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .badge-tidak-hadir {
        background: #FEE2E2 !important;
        color: #9B1C20 !important;
    }

    .badge-terlambat {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    /* Tabs Styling */
    .nav-tabs {
        border: none;
        background: #FFF5F5;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6b7280;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 8px;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        background: #FEE2E2;
        color: #9B1C20;
    }

    .nav-tabs .nav-link.active {
        background: #9B1C20;
        color: white;
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
                    <i class="fas fa-chart-bar me-2"></i> Laporan Data Karyawan
                </h3>
                <p class="page-subtitle">Laporan lengkap data karyawan</p>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card main-card">
        <div class="card-body">

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#absensi">
                        <i class="fas fa-calendar-check me-1"></i> Absensi
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cuti">
                        <i class="fas fa-calendar-minus me-1"></i> Cuti
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lembur">
                        <i class="fas fa-clock me-1"></i> Lembur
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#izin">
                        <i class="fas fa-file-alt me-1"></i> Izin
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sakit">
                        <i class="fas fa-hospital me-1"></i> Sakit
                    </button>
                </li>
            </ul>


            <div class="tab-content">


                <div class="tab-pane fade show active" id="absensi">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporan as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $a->karyawan->nama_karyawan ?? '-' }}</strong></td>
                                    <td>{{ $a->tanggal }}</td>
                                    <td>
                                        @if($a->status_kehadiran == 'hadir')
                                            <span class="badge-status badge-hadir">Hadir</span>
                                        @elseif($a->status_kehadiran == 'tidak hadir')
                                            <span class="badge-status badge-tidak-hadir">Tidak Hadir</span>
                                        @elseif($a->status_kehadiran == 'terlambat')
                                            <span class="badge-status badge-terlambat">Terlambat</span>
                                        @else
                                            {{ $a->status_kehadiran }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="fas fa-calendar-check text-muted" style="font-size: 50px;"></i>
                                        <p class="text-muted mt-3">Tidak ada data absensi</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="tab-pane fade" id="cuti">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cuti as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $c->karyawan->nama_karyawan ?? '-' }}</strong></td>
                                    <td>{{ $c->tanggal_mulai }}</td>
                                    <td>{{ $c->tanggal_selesai }}</td>
                                    <td>
                                        @if($c->status == 'pending')
                                            <span class="badge-status badge-pending">Pending</span>
                                        @elseif($c->status == 'approved')
                                            <span class="badge-status badge-approved">Approved</span>
                                        @elseif($c->status == 'rejected')
                                            <span class="badge-status badge-rejected">Rejected</span>
                                        @else
                                            {{ $c->status }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-calendar-minus text-muted" style="font-size: 50px;"></i>
                                        <p class="text-muted mt-3">Tidak ada data cuti</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="tab-pane fade" id="lembur">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Jam Lembur</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lembur as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $l->karyawan->nama_karyawan ?? '-' }}</strong></td>
                                    <td>{{ date('d-m-Y', strtotime($l->tanggal)) }}</td>
                                    <td>{{ $l->total_jam }} Jam</td>
                                    <td>
                                        @if($l->status == 'pending')
                                            <span class="badge-status badge-pending">Pending</span>
                                        @elseif($l->status == 'approved')
                                            <span class="badge-status badge-approved">Approved</span>
                                        @elseif($l->status == 'rejected')
                                            <span class="badge-status badge-rejected">Rejected</span>
                                        @else
                                            {{ $l->status }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-clock text-muted" style="font-size: 50px;"></i>
                                        <p class="text-muted mt-3">Tidak ada data lembur</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="tab-pane fade" id="izin">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($izin as $i)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $i->karyawan->nama_karyawan ?? '-' }}</strong></td>
                                    <td>{{ $i->tanggal }}</td>
                                    <td>{{ $i->alasan }}</td>
                                    <td>
                                        @if($i->status == 'pending')
                                            <span class="badge-status badge-pending">Pending</span>
                                        @elseif($i->status == 'approved')
                                            <span class="badge-status badge-approved">Approved</span>
                                        @elseif($i->status == 'rejected')
                                            <span class="badge-status badge-rejected">Rejected</span>
                                        @else
                                            {{ $i->status }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-file-alt text-muted" style="font-size: 50px;"></i>
                                        <p class="text-muted mt-3">Tidak ada data izin</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="tab-pane fade" id="sakit">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sakit as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $s->karyawan->nama_karyawan ?? '-' }}</strong></td>
                                    <td>{{ $s->tanggal }}</td>
                                    <td>{{ $s->keterangan }}</td>
                                    <td>
                                        @if($s->status == 'pending')
                                            <span class="badge-status badge-pending">Pending</span>
                                        @elseif($s->status == 'approved')
                                            <span class="badge-status badge-approved">Approved</span>
                                        @elseif($s->status == 'rejected')
                                            <span class="badge-status badge-rejected">Rejected</span>
                                        @else
                                            {{ $s->status }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-hospital text-muted" style="font-size: 50px;"></i>
                                        <p class="text-muted mt-3">Tidak ada data sakit</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection --}}
