@extends('manager.template')

@section('title', 'Data Karyawan')

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
        background: #9B1C20;
        color: white;
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

    .badge-aktif {
        background: #D1FAE5;
        color: #065F46;
    }

    .badge-nonaktif {
        background: #FEE2E2;
        color: #9B1C20;
    }

    /* Buttons */
    .btn-maroon {
        background: #9B1C20;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-maroon:hover {
        background: #7f181b;
        color: white;
    }

    .btn-outline-maroon {
        background: transparent;
        color: #9B1C20;
        border: 2px solid #9B1C20;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-maroon:hover {
        background: #9B1C20;
        color: white;
    }

    /* Action Buttons */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-view {
        background: #DBEAFE;
        color: #1D4ED8;
    }

    .btn-view:hover {
        background: #1D4ED8;
        color: white;
    }

    .btn-edit {
        background: #FEF3C7;
        color: #D97706;
    }

    .btn-edit:hover {
        background: #D97706;
        color: white;
    }

    .btn-delete {
        background: #FEE2E2;
        color: #DC2626;
    }

    .btn-delete:hover {
        background: #DC2626;
        color: white;
    }

    /* Search Box */
    .search-box {
        max-width: 400px;
    }

    .search-box .form-control {
        border: 2px solid #fee2e2;
        border-radius: 8px 0 0 8px;
        padding: 12px 15px;
    }

    .search-box .form-control:focus {
        border-color: #9B1C20;
        box-shadow: none;
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
        background: #9B1C20;
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 20px 25px;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-body {
        padding: 25px;
        background: white;
    }

    .modal-footer {
        background: #FFF5F5;
        border-radius: 0 0 15px 15px;
        border-top: 1px solid #fee2e2;
        padding: 15px 25px;
    }

    /* Detail Item */
    .detail-item {
        padding: 12px 0;
        border-bottom: 1px solid #fee2e2;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 15px;
        color: #1f2937;
        font-weight: 500;
    }

    /* Delete Modal */
    .delete-icon {
        width: 80px;
        height: 80px;
        background: #FEE2E2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .delete-icon i {
        font-size: 40px;
        color: #9B1C20;
    }

    /* Form Styling */
    .form-label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #9B1C20;
        box-shadow: 0 0 0 3px rgba(155, 28, 32, 0.1);
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
                    <i class="fas fa-users me-2"></i> Data Karyawan
                </h3>
                <p class="page-subtitle">Kelola data karyawan perusahaan</p>
            </div>

        </div>
    </div>

    <!-- Search -->
    <form action="{{ route('manager.karyawan') }}" method="GET" class="mb-4">
        <div class="search-box d-flex">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari NIK / Nama / Divisi..."
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-maroon" style="border-radius: 0 8px 8px 0;">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('manager.karyawan') }}" class="btn btn-outline-maroon ms-2">
                    <i class="fas fa-times me-1"></i> Reset
                </a>
            @endif
        </div>
    </form>


 <div class="card main-card">
        <div class="card-body">
            <div class="table-responsive">
            {{-- <table class="table table-bordered table-striped"> --}}

                 <table class="table custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>

                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @if($karyawan->count() == 0)
                        <tr>
                            <td colspan="8" class="text-center">
                                Data karyawan tidak ditemukan
                            </td>
                        </tr>
                    @endif

                    @foreach($karyawan as $k)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $k->nik }}</td>

                        <td>
                            <strong>{{ $k->nama_karyawan }}</strong>
                        </td>

                        <td>
                            {{ $k->divisi->nama_divisi ?? '-' }}
                        </td>

                        <td>
                            {{ $k->jabatan->nama_jabatan ?? '-' }}
                        </td>


                        {{-- <td>
                            Rp {{ number_format($k->gaji_pokok,0,',','.') }}
                        </td> --}}


                        <td>
                            {{ $k->tanggal_masuk ? date('d-m-Y', strtotime($k->tanggal_masuk)) : '-' }}
                        </td>

                        <td>

                            @if($k->status_karyawan == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>
</div>


</div>

@endsection
