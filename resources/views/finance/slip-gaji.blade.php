{{-- @extends('template')

@section('content')
<div class="container mt-4">
    <h4>Slip Gaji Karyawan</h4>

   @if($slip->isEmpty())
    <div class="alert alert-info">
        Slip gaji belum tersedia. Silakan hubungi admin.
    </div>
@else
    <table class="table">
        <tr>
            <th>Bulan</th>
            <th>Gaji Bersih</th>
            <th>Aksi</th>
        </tr>
        @foreach($slip as $s)
        <tr>
            <td>{{ $s->gaji->bulan }}</td>
            <td>
                Rp {{ number_format($s->gaji->gaji_bersih,0,',','.') }}
            </td>
            <td>
                <a href="{{ route('karyawan.slip-gaji.show', $s->id_slip) }}"
                   class="btn btn-info btn-sm">
                    Detail
                </a>
            </td>
        </tr>
        @endforeach
    </table>
@endif

</div>
@endsection --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>
        body { font-family: sans-serif; }
        .container { width: 100%; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 8px; }
        .line { border-top: 2px solid #000; margin: 20px 0; }
    </style>
</head>
<body>

<h2>SLIP GAJI KARYAWAN</h2>

<p><strong>Nama:</strong> {{ $slip->karyawan?->nama_karyawan ?? '-' }}</p>
<p><strong>NIK:</strong> {{ $slip->karyawan?->nik ?? '-' }}</p>
<p><strong>Jabatan:</strong> {{ $slip->karyawan?->jabatan?->nama_jabatan ?? '-' }}</p>
<p><strong>Bulan:</strong> {{ $slip->bulan }}</p>

<div class="line"></div>

<table>
    <tr>
        <td>Gaji Pokok</td>
        <td>Rp {{ number_format($slip->gaji_pokok,0,',','.') }}</td>
    </tr>
    <tr>
        <td>Tunjangan</td>
        <td>Rp {{ number_format($slip->total_tunjangan,0,',','.') }}</td>
    </tr>
    <tr>
        <td>Lembur</td>
        <td>Rp {{ number_format($slip->total_overtime ?? 0,0,',','.') }}</td>
    </tr>
    <tr>
        <td>Potongan</td>
        <td>Rp {{ number_format($slip->total_potongan,0,',','.') }}</td>
    </tr>
</table>

<div class="line"></div>

<h3>Total Gaji Bersih:
Rp {{ number_format($slip->gaji_bersih,0,',','.') }}</h3>

</body>
</html>
