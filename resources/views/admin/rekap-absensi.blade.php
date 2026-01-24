@extends('admin.template')

@section('content')
<div class="container">
    <h3 class="mb-3">Rekap Absensi Karyawan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- BUTTON TAMBAH / GENERATE -->
    <a href="{{ route('rekap-absensi.create') }}" class="btn btn-primary mb-3">
        + Generate Rekap
    </a>

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
            @forelse($rekap as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->karyawan->nama_karyawan ?? '-' }}</td>
                <td>{{ $r->bulan }}</td>
                <td>{{ $r->jumlah_hadir }}</td>
                <td>{{ $r->jumlah_izin }}</td>
                <td>{{ $r->jumlah_alpha }}</td>
                <td>
                    {{-- <a href="{{ route('rekap-absensi.edit', $r->id_rekap) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a> --}}

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
            @empty
            <tr>
                <td colspan="7" class="text-center">
                    Data rekap absensi belum ada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
