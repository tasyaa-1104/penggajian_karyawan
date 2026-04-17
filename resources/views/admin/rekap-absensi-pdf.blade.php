<!DOCTYPE html>
<html>
<head>
    <title>Rekap Absensi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .tanggal-cetak {
            text-align: right;
            margin-bottom: 15px;
            font-size: 11px;
        }

        table {
            width:100%;
            border-collapse: collapse;
        }

        th, td {
            border:1px solid #000;
            padding:8px;
            text-align:center;
        }

        th {
            background:#800000;
            color: white;
        }
    </style>
</head>
<body>

<h2>REKAP ABSENSI</h2>

<div class="tanggal-cetak">
    Dicetak pada: {{ date('d-m-Y') }}
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Karyawan</th>
            <th>Bulan</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Sakit</th>
            <th>Alpha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekap as $r)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $r->karyawan->nama_karyawan ?? '-' }}</td>
            <td>{{ $r->bulan }}</td>
            <td>{{ $r->jumlah_hadir }}</td>
            <td>{{ $r->jumlah_izin }}</td>
            <td>{{ $r->jumlah_sakit }}</td>
            <td>{{ $r->jumlah_alpha }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
