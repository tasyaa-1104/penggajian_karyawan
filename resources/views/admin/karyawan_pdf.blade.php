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
    <div style="text-align: right; margin-bottom: 10px; font-size: 11px;">
        Dicetak pada: {{ date('d-m-Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
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
                <td>
                    @if($k->tunjangan && $k->tunjangan->count())
                        @foreach($k->tunjangan as $t)
                            {{ $t->nama_tunjangan }} (Rp {{ number_format($t->nominal,0,',','.') }})@if(!$loop->last), @endif
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($k->potongan && $k->potongan->count())
                        @foreach($k->potongan as $p)
                            {{ $p->nama_potongan }} (Rp {{ number_format($p->nominal,0,',','.') }})@if(!$loop->last), @endif
                        @endforeach
                    @else
                        -
                    @endif
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
