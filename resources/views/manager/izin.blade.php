@extends('manager.template')

@section('title', 'Persetujuan Izin')

@section('content')
@php
\Carbon\Carbon::setLocale('id');
@endphp

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
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        height: 100%;
    }

    .main-card .card-body {
        padding: 25px;
    }

    .custom-table thead th {
        background: #9B1C20 !important;
        color: white !important;
        padding: 15px 12px;
        font-size: 14px;
        border: none;
    }

    .custom-table tbody td {
        padding: 14px 12px;
        border-color: #fee2e2;
        vertical-align: middle;
    }

    .custom-table tbody tr:hover {
        background: #FFF5F5;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-pending {
        background: #FEF3C7;
        color: #92400E;
    }

    .badge-approved {
        background: #D1FAE5;
        color: #065F46;
    }

    .badge-rejected {
        background: #FEE2E2;
        color: #9B1C20;
    }

    .btn-approve {
        background: #D1FAE5;
        color: #065F46;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
    }

    .btn-reject {
        background: #FEE2E2;
        color: #9B1C20;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
    }
</style>

<div class="container-fluid mt-4">

    <div class="page-title-section">
        <h3 class="page-title">
            <i class="fas fa-file-alt me-2"></i> Data Izin & Sakit Karyawan
        </h3>
        <p class="page-subtitle">Kelola persetujuan izin dan sakit karyawan</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $sakitPending = $data->where('jenis_pengajuan','Sakit')->where('status','pending')->count();
    @endphp

    {{-- @if($sakitPending > 0)
        <div class="alert alert-warning">
            Ada {{ $sakitPending }} pengajuan sakit menunggu persetujuan
        </div>
    @endif --}}

    <div class="row">

        {{-- KIRI = IZIN --}}
        <div class="col-md-6">
            <div class="card main-card">
                <div class="card-body">
                    <h4 class="mb-3">Data Izin</h4>
                    <div class="mb-3">
                        <input type="text" id="searchIzin" class="form-control" placeholder="Cari nama, tanggal, atau bulan izin...">
                    </div>

                    <div class="table-responsive">
                        <table class="table custom-table" id="tableIzin">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Bulan</th>
                                    <th>Status</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                    @forelse($data->where('jenis_pengajuan','Izin')->sortBy(function($item){
                                    return $item->status != 'pending';
                                }) as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->karyawan->nama_karyawan ?? '-' }}</td>
                                    <td>{{ $d->tanggal }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('F') }}</td>

                                    <td>
                                        @if($d->status == 'pending')
                                            <span class="badge-status badge-pending">Pending</span>
                                        @elseif($d->status == 'disetujui')
                                            <span class="badge-status badge-approved">Approved</span>
                                        @else
                                            <span class="badge-status badge-rejected">Rejected</span>
                                        @endif
                                    </td>
<td>
    {{ $d->alasan ?? $d->keterangan ?? '-' }}
</td>
                                    <td>
                                        @if($d->status == 'pending')
                                            <form action="{{ route('manager.izin.approve', $d->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn-approve">Approve</button>
                                            </form>

                                            <form action="{{ route('manager.izin.reject', $d->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn-reject">Reject</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data izin</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- KANAN = SAKIT --}}
        <div class="col-md-6">
            <div class="card main-card">
                <div class="card-body">
                    <h4 class="mb-3">Data Sakit</h4>
                    <div class="mb-3">
    <input type="text" id="searchSakit" class="form-control" placeholder="Cari nama, tanggal, atau bulan sakit...">
</div>

                    <div class="table-responsive">
                       <table class="table custom-table" id="tableSakit">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Bulan</th>
                                    <th>Status</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                              @forelse($data->where('jenis_pengajuan','Sakit')->sortBy(function($item){
                                    return $item->status != 'pending';
                                }) as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->karyawan->nama_karyawan ?? '-' }}</td>
                                    <td>{{ $d->tanggal }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('F') }}</td>

                                    <td>
                                        @if($d->status == 'pending')
                                            <span class="badge-status badge-pending">Pending</span>
                                        @elseif($d->status == 'disetujui')
                                            <span class="badge-status badge-approved">Approved</span>
                                        @else
                                            <span class="badge-status badge-rejected">Rejected</span>
                                        @endif
                                    </td>
                                       <td>
    {{ $d->alasan ?? $d->keterangan ?? '-' }}
</td>
                                    <td>
                                        @if($d->status == 'pending')
                                            <form action="{{ route('manager.sakit.approve', $d->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn-approve">Approve</button>
                                            </form>

                                            <form action="{{ route('manager.sakit.reject', $d->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn-reject">Reject</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data sakit</td>
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
<script>
document.getElementById('searchIzin').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tableIzin tbody tr');

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});

document.getElementById('searchSakit').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tableSakit tbody tr');

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
@endsection
