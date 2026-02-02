@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Slip Gaji</h4>

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $slip->gaji->karyawan->nama_karyawan }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $slip->gaji->karyawan->jabatan->nama_jabatan }}</td>
        </tr>
        <tr>
            <th>Bulan</th>
            <td>{{ $slip->gaji->bulan }}</td>
        </tr>
        <tr>
            <th>Total Tunjangan</th>
            <td>Rp {{ number_format($slip->gaji->total_tunjangan,0,',','.') }}</td>
        </tr>
        <tr>
            <th>Total Potongan</th>
            <td>Rp {{ number_format($slip->gaji->total_potongan,0,',','.') }}</td>
        </tr>
        <tr>
            <th>Gaji Bersih</th>
            <td><strong>
                Rp {{ number_format($slip->gaji->gaji_bersih,0,',','.') }}
            </strong></td>
        </tr>
    </table>

    <a href="{{ route('slip-gaji.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>
@endsection
