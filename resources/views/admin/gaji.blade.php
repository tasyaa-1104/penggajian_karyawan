@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Data Gaji Karyawan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('gaji.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Hitung Gaji
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Bulan</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Gaji Bersih</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($gaji as $g)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $g->karyawan->nama_karyawan }}</td>
                <td>{{ $g->karyawan->jabatan->nama_jabatan }}</td>
                <td>{{ $g->bulan }}</td>
                <td>Rp {{ number_format($g->total_tunjangan,0,',','.') }}</td>
                <td>Rp {{ number_format($g->total_potongan,0,',','.') }}</td>
                <td>
                    <strong>
                        Rp {{ number_format($g->gaji_bersih,0,',','.') }}
                    </strong>
                </td>
                <td>
                    <form action="{{ route('gaji.destroy',$g->id_gaji) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('hapus data gaji?')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
