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
            vertical-align: top;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .total-row {
            font-weight: bold;
            background: #f2f2f2;
        }

        small {
            font-size: 9px;
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
                <th>Gaji Pokok</th> <!-- TAMBAHAN -->
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

                    <!-- GAJI POKOK -->
                    <td class="text-right">
                        Rp {{ number_format($g->karyawan->gaji_pokok,0,',','.') }}
                    </td>

                    <td class="text-center">{{ $g->bulan }}</td>

                    <!-- TUNJANGAN DETAIL -->
                    <td class="text-right">
                        Rp {{ number_format($g->total_tunjangan,0,',','.') }}
                        @if($g->karyawan->tunjangan && $g->karyawan->tunjangan->count())
                            <br>
                            <small>
                                @foreach($g->karyawan->tunjangan as $t)
                                    {{ $t->nama_tunjangan }}:
                                    Rp {{ number_format($t->nominal,0,',','.') }}
                                    @if(!$loop->last)<br>@endif
                                @endforeach
                            </small>
                        @endif
                    </td>

                    <!-- LEMBUR -->
                    <td class="text-right">
                        Rp {{ number_format($g->total_overtime ?? 0,0,',','.') }}
                    </td>

                    <!-- POTONGAN DETAIL -->
                    <td class="text-right">
                        Rp {{ number_format($g->total_potongan,0,',','.') }}
                        @if($g->karyawan->potongan && $g->karyawan->potongan->count())
                            <br>
                            <small>
                                @foreach($g->karyawan->potongan as $p)
                                    {{ $p->nama_potongan }}:
                                    Rp {{ number_format($p->nominal,0,',','.') }}
                                    @if(!$loop->last)<br>@endif
                                @endforeach
                            </small>
                        @endif
                    </td>

                    <!-- GAJI BERSIH -->
                    <td class="text-right">
                        Rp {{ number_format($g->gaji_bersih,0,',','.') }}
                    </td>
                </tr>
            @endforeach

            <!-- TOTAL -->
            <tr class="total-row">
                <td colspan="8" class="text-right">TOTAL SELURUH GAJI</td>
                <td class="text-right">
                    Rp {{ number_format($total_gaji,0,',','.') }}
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
