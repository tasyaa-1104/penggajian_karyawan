<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Karyawan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background: #800000;
            color: white;
            padding: 8px;
        }

        td {
            padding: 6px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <h2>DATA KARYAWAN</h2>

    <table>
        <thead>
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
            @foreach($karyawans as $k)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $k->nik }}</td>
                <td>{{ $k->nama_karyawan }}</td>
                <td>{{ $k->divisi->nama_divisi ?? '-' }}</td>
                <td>{{ $k->jabatan->nama_jabatan ?? '-' }}</td>
                <td class="text-right">
                    Rp {{ number_format($k->gaji_pokok,0,',','.') }}
                </td>
                <td class="text-center">
                    {{ $k->tanggal_masuk ? date('d-m-Y', strtotime($k->tanggal_masuk)) : '-' }}
                </td>
                <td class="text-center">
                    {{ ucfirst($k->status_karyawan) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
