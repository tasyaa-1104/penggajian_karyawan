<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>
        /* Font Standar (Arial) */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #fff;
            color: #000;
            margin: 0;
            padding: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid #000; /* Garis luar dokumen */
            padding: 30px;
            position: relative;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        /* Informasi Karyawan */
        .info-section {
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            width: 120px;
            font-weight: bold;
        }

        .info-value {
            flex: 1;
            border-bottom: 1px dotted #999; /* Garis putus-putus */
        }

        /* Tabel Gaji */
        table.salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table.salary-table th,
        table.salary-table td {
            border: 1px solid #000;
            padding: 10px 12px;
        }

        table.salary-table th {
            background-color: #eee;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
        }

        .amount-col {
            text-align: right !important;
            font-family: 'Courier New', Courier, monospace; /* Angka tetap monospace agar rapi */
        }

        .deduction-row {
            font-weight: bold;
        }

        .total-row td {
            background-color: #f9f9f9;
            font-weight: bold;
            border-top: 2px solid #000;
        }

        /* Footer */
        .footer-note {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* Metadata Tanggal */
        .doc-meta {
            position: absolute;
            top: 30px;
            right: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Metadata Dokumen -->
    <div class="doc-meta">
        <p>Tgl Cetak: <br>
        @php use Carbon\Carbon; @endphp
        <strong>{{ Carbon::parse($slip->tanggal_cetak)->format('d-m-Y') }}</strong></p>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Slip Gaji Karyawan</h1>
        <p>Periode: {{ $slip->gaji->bulan }} {{ $slip->gaji->tahun }}</p>
    </div>

    <!-- Info Karyawan -->
    <div class="info-section">
        <div class="info-row">
        <table style="margin-bottom: 10px;">
            <tr>
                <td style="width:120px;"><strong>Nama</strong></td>
                <td style="width:20px;">:</td>
                <td>{{ $slip->gaji->karyawan->nama_karyawan }}</td>
            </tr>
            <tr>
                <td><strong>NIK</strong></td>
                <td>:</td>
                <td>{{ $slip->gaji->karyawan->nik }}</td>
            </tr>
            <tr>
                <td><strong>Jabatan</strong></td>
                <td>:</td>
                <td>{{ $slip->gaji->karyawan->jabatan->nama_jabatan }}</td>
            </tr>
        </table>
    </div>

    <!-- Tabel Rincian Gaji -->
    <h3 style="margin-bottom: 10px; border-bottom: 1px solid #000; padding-bottom: 5px;">Rincian Penghasilan</h3>
    <table class="salary-table">
        <thead>
            <tr>
                <th width="70%">Keterangan</th>
                <th width="30%" class="amount-col">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td class="amount-col">{{ number_format($slip->gaji->karyawan->gaji_pokok) }}</td>
            </tr>
            <tr>
                <td>Overtime (Lembur)</td>
                <td class="amount-col">{{ number_format($slip->gaji->total_overtime) }}</td>
            </tr>
            <tr>
                <td>
                    Tunjangan
                    <div style="font-size:12px; margin-top:5px; color:#555;">
                        @forelse($tunjangan as $t)
                            - {{ $t->nama_tunjangan }} ({{ number_format($t->nominal) }})<br>
                        @empty
                            Tidak ada tunjangan
                        @endforelse
                    </div>
                </td>
                <td class="amount-col">
                    {{ number_format($slip->gaji->total_tunjangan) }}
                </td>
            </tr>
            <tr class="deduction-row">
                <td>(-) Potongan</td>
                <td class="amount-col">({{ number_format($slip->gaji->total_potongan) }})</td>
            </tr>
            <tr class="total-row">
                <td style="text-align: right;">TOTAL GAJI BERSIH</td>
                <td class="amount-col">{{ number_format($slip->gaji->gaji_bersih) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Catatan Kaki -->
    <div class="footer-note">
        <p>Dokumen ini diterbitkan secara elektronik oleh sistem dan sah tanpa tanda tangan basah.</p>
    </div>

</div>

</body>
</html>
