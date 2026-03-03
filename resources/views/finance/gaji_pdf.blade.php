<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Data Gaji</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
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
            background-color: #800000;
            color: white;
            padding: 6px;
            font-size: 10px;
        }

        td {
            padding: 5px;
            font-size: 10px;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .total-row {
            font-weight: bold;
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>REKAP DATA GAJI KARYAWAN</h2>
    <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Bulan</th>
                <th>Tunjangan</th>
                <th>Lembur</th>
                <th>Potongan</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_gaji = 0;
            @endphp

            @foreach($gaji as $g)
                @php
                    $total_gaji += $g->gaji_bersih;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $g->karyawan->nama_karyawan }}</td>
                    <td>{{ $g->karyawan->jabatan->nama_jabatan }}</td>
                    <td class="text-center">{{ $g->bulan }}</td>
                    <td class="text-right">
                        Rp {{ number_format($g->total_tunjangan,0,',','.') }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($g->total_overtime ?? 0,0,',','.') }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($g->total_potongan,0,',','.') }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($g->gaji_bersih,0,',','.') }}
                    </td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="7" class="text-right">TOTAL SELURUH GAJI</td>
                <td class="text-right">
                    Rp {{ number_format($total_gaji,0,',','.') }}
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
