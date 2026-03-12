@extends('finance.template')

@section('title', 'Data Karyawan')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

.page-title-section{
    background:#FFF5F5;
    border-left:5px solid #9B1C20;
    padding:20px 25px;
    border-radius:10px;
    margin-bottom:25px;
}

.page-title{
    color:#9B1C20;
    font-weight:700;
    font-size:24px;
}

.page-subtitle{
    color:#6b7280;
    font-size:14px;
}

.main-card{
    background:white;
    border-radius:15px;
    border:none;
    box-shadow:0 2px 15px rgba(0,0,0,0.08);
}

.custom-table thead th{
    background:#9B1C20;
    color:white;
    font-size:14px;
    padding:15px 12px;
}

.custom-table tbody td{
    padding:14px 12px;
    border-color:#fee2e2;
}

.custom-table tbody tr:hover{
    background:#FFF5F5;
}

.search-box{
    max-width:400px;
}

.search-box .form-control{
    border:2px solid #fee2e2;
    border-radius:8px 0 0 8px;
}

.search-box .form-control:focus{
    border-color:#9B1C20;
    box-shadow:none;
}

.btn-maroon{
    background:#9B1C20;
    color:white;
    border:none;
}

.btn-outline-maroon{
    color:#9B1C20;
    border:2px solid #9B1C20;
}

</style>

<div class="container-fluid mt-4">


<div class="page-title-section">
    <h3 class="page-title">
        <i class="fas fa-users me-2"></i>
        Data Karyawan
    </h3>
    <p class="page-subtitle">
        Data karyawan perusahaan (view finance)
    </p>
</div>

<!-- SEARCH -->
<form action="{{ route('finance.karyawan') }}" method="GET" class="mb-4">
    <div class="search-box d-flex">

        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari NIK / Nama / Divisi..."
               value="{{ request('search') }}">

        <button type="submit"
                class="btn btn-maroon"
                style="border-radius:0 8px 8px 0;">
            <i class="fas fa-search"></i>
        </button>

        @if(request('search'))
        <a href="{{ route('finance.karyawan') }}"
           class="btn btn-outline-maroon ms-2">
           Reset
        </a>
        @endif

    </div>
</form>

<div class="card main-card">
    <div class="card-body">

        <div class="table-responsive">

            <table class="table custom-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @if($karyawans->count()==0)

                    <tr>
                        <td colspan="7" class="text-center">
                            Data karyawan tidak ditemukan
                        </td>
                    </tr>

                    @endif

                    @foreach($karyawans as $k)

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

                        <td>
                            {{ $k->tanggal_masuk
                            ? date('d-m-Y', strtotime($k->tanggal_masuk))
                            : '-' }}
                        </td>

                        <td>

                            @if($k->status_karyawan=='aktif')
                            <span class="badge bg-success">
                                Aktif
                            </span>
                            @else
                            <span class="badge bg-secondary">
                                Nonaktif
                            </span>
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

