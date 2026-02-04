@extends('admin.template')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Absensi</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('absensi.create') }}" class="btn btn-primary mb-3">
        + Tambah Absensi
    </a>

    {{-- SEARCH --}}
    <form action="{{ route('absensi') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari nama karyawan / tanggal / status..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary">Cari</button>

                @if(request('search'))
                    <a href="{{ route('absensi') }}" class="btn btn-outline-danger">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- TABEL ABSENSI -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($absensi->count() == 0)
                <tr>
                    <td colspan="8" class="text-center">
                        Data absensi tidak ditemukan
                    </td>
                </tr>
            @endif

            @foreach($absensi as $a)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $a->karyawan->nama_karyawan ?? '-' }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->jam_masuk ?? '-' }}</td>
                <td>{{ $a->jam_pulang ?? '-' }}</td>
                <td>{{ ucfirst($a->status_kehadiran) }}</td>
                <td>{{ $a->keterangan ?? '-' }}</td>
                <td>
                    <a href="{{ route('absensi.edit', $a->id_absensi) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('absensi.destroy', $a->id_absensi) }}"
                          method="POST"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data?')">
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
