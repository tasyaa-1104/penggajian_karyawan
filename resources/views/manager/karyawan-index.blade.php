@extends('manager.template')

@section('title', 'Data Karyawan')

@section('content')

<!-- FontAwesome -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-4">
<h3 class="mb-4">Data Karyawan</h3>

<!-- SEARCH -->
<form action="{{ route('manager.karyawan') }}" method="GET" class="mb-3">
    <div style="display:flex; gap:10px; max-width:400px;">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari NIK / Nama / Divisi..."
               value="{{ request('search') }}">

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>

        @if(request('search'))
            <a href="{{ route('manager.karyawan') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
            </a>
        @endif
    </div>
</form>


<div class="card shadow">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Gaji Pokok</th>
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

                        <td>
                            Rp {{ number_format($k->gaji_pokok,0,',','.') }}
                        </td>

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
