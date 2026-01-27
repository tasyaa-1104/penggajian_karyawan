@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Slip Gaji Karyawan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Bulan</th>
                <th>Gaji Bersih</th>
                <th>Tanggal Cetak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($slip as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->gaji->karyawan->nama_karyawan }}</td>
                <td>{{ $s->gaji->karyawan->jabatan->nama_jabatan }}</td>
                <td>{{ $s->gaji->bulan }}</td>
                <td>
                    Rp {{ number_format($s->gaji->gaji_bersih,0,',','.') }}
                </td>
                <td>{{ $s->tanggal_cetak }}</td>
                <td>
                    <a href="{{ route('slip-gaji.show',$s->id_slip) }}"
                       class="btn btn-info btn-sm">
                        Detail
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
