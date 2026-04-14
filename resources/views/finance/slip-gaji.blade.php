<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Slip Gaji</title>

<style>

body{
font-family:sans-serif;
}

.container{
width:100%;
}

h2{
text-align:center;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

td{
padding:8px;
}

.line{
border-top:2px solid #000;
margin:20px 0;
}

.detail{
font-size:13px;
padding-left:20px;
color:#444;
}

</style>

</head>
<body>

<h2>SLIP GAJI KARYAWAN</h2>

<p><strong>Nama:</strong> {{ $slip->gaji->karyawan->nama_karyawan ?? '-' }}</p>

<p><strong>NIK:</strong> {{ $slip->gaji->karyawan->nik ?? '-' }}</p>

<p><strong>Jabatan:</strong> {{ $slip->gaji->karyawan->jabatan->nama_jabatan ?? '-' }}</p>

<p><strong>Bulan:</strong> {{ $slip->gaji->bulan }}</p>

<div class="line"></div>

<table>

<tr>
<td>Gaji Pokok</td>
<td>
Rp {{ number_format($slip->gaji->karyawan->jabatan->gaji_pokok ?? 0,0,',','.') }}
</td>
</tr>


<tr>
    <td style="vertical-align: top;">Tunjangan</td>
    <td>
        Rp {{ number_format($slip->gaji->total_tunjangan,0,',','.') }}

        <div class="detail" style="margin-top:5px;">
            <strong>Rincian:</strong><br>

            @forelse($tunjangan as $t)
                - {{ $t->nama_tunjangan }}
                (Rp {{ number_format($t->nominal,0,',','.') }}) <br>
            @empty
                Tidak ada tunjangan
            @endforelse
        </div>
    </td>
</tr>

{{-- <tr>
<td colspan="2" class="detail">

@foreach($tunjangan as $t)

• {{ $t->nama_tunjangan }} :
Rp {{ number_format($t->nominal,0,',','.') }}

<br>

@endforeach

</td>
</tr> --}}


<tr>
<td>Lembur</td>
<td>
Rp {{ number_format($slip->gaji->total_overtime ?? 0,0,',','.') }}
</td>
</tr>


<tr>
<td>Potongan</td>
<td>
Rp {{ number_format($slip->gaji->total_potongan,0,',','.') }}
</td>
</tr>

<tr>
<td colspan="2" class="detail">

@php
$rekap = \App\Models\rekap_absensi::where('id_karyawan',$slip->gaji->id_karyawan)
->where('bulan',$slip->gaji->bulan)
->first();
@endphp

• Alpha : {{ $rekap->jumlah_alpha ?? 0 }}

<br>

• Izin : {{ $rekap->jumlah_izin ?? 0 }}

<br>

• Sakit : {{ $rekap->jumlah_sakit ?? 0 }}

</td>
</tr>

</table>

<div class="line"></div>

<h3>
Total Gaji Bersih:
Rp {{ number_format($slip->gaji->gaji_bersih,0,',','.') }}
</h3>

</body>
</html>
