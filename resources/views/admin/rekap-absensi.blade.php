@extends('admin.template')

@section('content')
<div class="container">
    <h3 class="mb-3">Rekap Absensi Karyawan</h3>

    <a href="{{ route('rekap-absensi.create') }}" class="btn btn-primary mb-3">
        + Generate Rekap
    </a>

    {{-- SEARCH --}}
    <form action="{{ route('rekap-absensi.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari nama karyawan / bulan (YYYY-MM)..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary">Cari</button>

                @if(request('search'))
                    <a href="{{ route('rekap-absensi.index') }}" class="btn btn-outline-danger">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- TABEL REKAP -->
    <table class="table table-bordered table-striped">
        <thead class="table-white">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Alpha</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($rekap->count() == 0)
                <tr>
                    <td colspan="7" class="text-center">
                        Data rekap absensi tidak ditemukan
                    </td>
                </tr>
            @endif

            @foreach($rekap as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->karyawan->nama_karyawan ?? '-' }}</td>
                <td>{{ $r->bulan }}</td>
                <td>{{ $r->jumlah_hadir }}</td>
                <td>{{ $r->jumlah_izin }}</td>
                <td>{{ $r->jumlah_alpha }}</td>
                <td>
                    <form action="{{ route('rekap-absensi.delete', $r->id_rekap) }}"
                          method="POST"
                          style="display:inline-block">
                        @csrf
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus data?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
