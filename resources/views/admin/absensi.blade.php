@extends('admin.template')

@section('konten')
<div class="container">
    <h3 class="mb-3">Data Absensi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('absensi.create') }}" class="btn btn-primary mb-3">
        + Tambah Absensi
    </a>

    <!-- TABEL ABSENSI -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $a)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $a->karyawan->nama }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ ucfirst($a->status_kehadiran) }}</td>
                <td>{{ $a->keterangan }}</td>
                <td>
                    <form action="{{ route('absensi.delete', $a->id_absensi) }}" method="POST" style="display:inline">
                        @csrf
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
