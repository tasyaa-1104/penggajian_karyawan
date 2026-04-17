@extends('finance.template')

@section('title', 'Data Gaji')

@section('topbar')
<div class="website-header">
    <div class="header-content">
        <div class="welcome-text">
            <span>Selamat Datang, Admin 👋</span>
        </div>

        <div class="user-profile">
            <span>SmartGaji</span>
            <div class="avatar-small">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root{
--smart-maroon:#800000;
--smart-maroon-hover:#600000;
--bg-page:#F3F4F6;
--bg-white:#FFFFFF;
--text-dark:#2c3e50;
--text-grey:#7f8c8d;

--btn-create:#00897B;
--btn-create-hover:#00695C;
--btn-view:#0ea5e9;
--btn-view-hover:#0284c7;
--btn-del:#EF5350;
}

body{
font-family:'Poppins',sans-serif;
background:var(--bg-page);
}

.container-custom{
width:100%;
max-width:100%;
margin:auto;
padding:30px;
padding-top:90px;
}

/* HEADER */

.website-header{
position:fixed;
top:0;
left:0;
width:100%;
height:70px;
background:white;
border-bottom:1px solid #e0e0e0;
z-index:100;
}

.header-content{
max-width:1200px;
margin:auto;
height:100%;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 20px;
}

.avatar-small{
width:35px;
height:35px;
background:var(--smart-maroon);
color:white;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
}

/* CARD */

.glass-card{
background:white;
border-radius:10px;
padding:30px;
box-shadow:0 4px 6px rgba(0,0,0,0.05);
}

/* WELCOME */

.welcome-card{
background:linear-gradient(90deg,#fff5f5,#ffffff);
border-left:5px solid var(--smart-maroon);
padding:20px;
border-radius:8px;
display:flex;
gap:15px;
margin-bottom:30px;
}

.welcome-icon{
width:50px;
height:50px;
background:var(--smart-maroon);
color:white;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:20px;
}

.welcome-text-content h3{
margin:0;
color:var(--smart-maroon);
}

/* HEADER PAGE */

.page-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.page-title{
border-left:5px solid var(--smart-maroon);
padding-left:10px;
font-weight:700;
}

/* BUTTON */

.btn-modern{
padding:10px 20px;
border-radius:6px;
border:none;
background:var(--smart-maroon);
color:white;
cursor:pointer;
text-decoration:none;
display:flex;
align-items:center;
gap:6px;
}

.btn-modern:hover{
background:var(--smart-maroon-hover);
}

/* TABLE */

.modern-table{
width:100%;
border-collapse:collapse;
}

.modern-table thead{
background:var(--smart-maroon);
}

.modern-table th{
color:white;
padding:15px;
text-transform:uppercase;
font-size:13px;
}

.modern-table td{
padding:15px;
border-bottom:1px solid #eee;
}

.modern-table tr:hover{
background:#fafafa;
}

.currency-text{
font-weight:600;
cursor:pointer;
}

.currency-bold{
font-weight:800;
color:var(--smart-maroon);
}

/* BUTTON ACTION */

.btn-action-sm{
padding:6px 10px;
border:none;
border-radius:6px;
cursor:pointer;
color:white;
font-size:13px;
}

.btn-slip-view{background:var(--btn-view);}
.btn-slip-create{background:var(--btn-create);}
.btn-delete{background:var(--btn-del);}

/* MODAL */

.modal-detail{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.4);
justify-content:center;
align-items:center;
z-index:9999;
}

.modal-content-detail{
background:white;
padding:25px;
border-radius:10px;
width:400px;
}

.modal-header{
display:flex;
justify-content:space-between;
margin-bottom:10px;
}

.close-modal{
font-size:22px;
cursor:pointer;
}

/* MODAL BACKDROP */
.modal-detail{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.5);
backdrop-filter: blur(3px);
justify-content:center;
align-items:center;
z-index:9999;
}

/* MODAL BOX */
.modal-content-detail{
background: white;
padding: 25px;
border-radius: 16px;
width: 420px;
box-shadow: 0 20px 60px rgba(0,0,0,0.25);
animation: zoomIn 0.25s ease;
}

/* ANIMASI */
@keyframes zoomIn{
from{transform:scale(0.9); opacity:0;}
to{transform:scale(1); opacity:1;}
}

/* HEADER */
.modal-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:15px;
}

.modal-header h3{
margin:0;
font-size:18px;
color:#800000;
font-weight:700;
}

.close-modal{
font-size:22px;
cursor:pointer;
transition:0.2s;
}

.close-modal:hover{
color:#EF5350;
transform:rotate(90deg);
}

/* INFO BOX */
.modal-info{
background:#fff5f5;
padding:10px 12px;
border-radius:8px;
margin-bottom:10px;
font-size:14px;
}

/* LIST */
.modal-content-detail ul{
list-style:none;
padding:0;
margin-top:10px;
}

.modal-content-detail ul li{
background:#f9fafb;
padding:10px 12px;
border-radius:8px;
margin-bottom:8px;
display:flex;
justify-content:space-between;
font-size:13px;
border-left:4px solid #800000;
transition:0.2s;
}

.modal-content-detail ul li:hover{
background:#fff5f5;
transform:translateX(3px);
}

/* TOTAL */
.modal-total{
margin-top:10px;
padding:10px;
background:#800000;
color:white;
border-radius:8px;
font-weight:600;
text-align:right;
}

.currency-text{
font-weight:600;
cursor:pointer;
display:inline-flex;
align-items:center;
gap:6px;
transition:0.2s;
}

.currency-text i{
font-size:12px;
opacity:0.6;
transition:0.2s;
}

.currency-text:hover{
color:#800000;
text-decoration:underline;
}

.currency-text:hover i{
opacity:1;
transform:scale(1.1);
}

</style>


<div class="container-custom">

<div class="glass-card">

<!-- WELCOME -->
<div class="welcome-card">

<div class="welcome-icon">
<i class="fas fa-hand-holding-usd"></i>
</div>

<div class="welcome-text-content">
<h3>Selamat Datang👋</h3>
<p>Berikut adalah data gaji dan rekapitulasi penggajian karyawan.</p>
</div>

</div>


<!-- HEADER -->
<div class="page-header">

<h4 class="page-title">Daftar Gaji</h4>

<div style="display:flex;gap:10px">

<a href="{{ route('gaji.pdf') }}" class="btn-modern">
<i class="fas fa-file-pdf"></i> Unduh PDF
</a>

<a href="{{ route('gaji.create') }}" class="btn-modern">
<i class="fas fa-calculator"></i> Hitung Gaji
</a>

</div>

</div>


<!-- TABLE -->
<div style="overflow-x:auto">

<table class="modern-table">

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
<th style="text-align:center">Aksi</th>
</tr>

</thead>


<tbody>

@foreach($gaji as $g)

<tr>

<td>{{ $loop->iteration }}</td>

<td><strong>{{ $g->karyawan->nama_karyawan }}</strong></td>

<td>{{ $g->karyawan->jabatan->nama_jabatan }}</td>

<td>{{ $g->bulan }}</td>


<td>
<span class="currency-text"
title="Klik untuk lihat detail tunjangan"
onclick="showTunjangan(
'{{ $g->karyawan->nama_karyawan }}',
`@if($g->karyawan->tunjangan && $g->karyawan->tunjangan->count())
    @foreach($g->karyawan->tunjangan as $t)
        <li>{{ $t->nama_tunjangan }} <span>Rp {{ number_format($t->nominal,0,',','.') }}</span></li>
    @endforeach
@else
    <li>Tidak ada tunjangan</li>
@endif`
)">
<i class="fas fa-eye"></i>
Rp {{ number_format($g->total_tunjangan,0,',','.') }}
</span>
</td>


<td>
<span class="currency-text">
Rp {{ number_format($g->total_overtime ?? 0,0,',','.') }}
</span>
</td>


<td>
<span class="currency-text"
title="Klik untuk lihat detail potongan"
onclick="showPotongan(
'{{ $g->karyawan->nama_karyawan }}',
`@if($g->karyawan->potongan && $g->karyawan->potongan->count())
    @foreach($g->karyawan->potongan as $p)
        <li>{{ $p->nama_potongan }} <span>Rp {{ number_format($p->nominal,0,',','.') }}</span></li>
    @endforeach
@endif

@php
$rekap = \App\Models\rekap_absensi::where('id_karyawan',$g->id_karyawan)
->where('bulan',$g->bulan)
->first();
@endphp

<li>Alpha <span>{{ $rekap->jumlah_alpha ?? 0 }}</span></li>
<li>Izin <span>{{ $rekap->jumlah_izin ?? 0 }}</span></li>
<li>Sakit <span>{{ $rekap->jumlah_sakit ?? 0 }}</span></li>
`
)">
<i class="fas fa-eye"></i>
Rp {{ number_format($g->total_potongan,0,',','.') }}
</span>
</td>


<td>

<span class="currency-bold">

Rp {{ number_format($g->gaji_bersih,0,',','.') }}

</span>

</td>


<td style="text-align:center">

<div style="display:flex;gap:6px;justify-content:center">

@if ($g->slipGaji)

<a href="{{ route('admin.slip-gaji.download',$g->slipGaji->id_slip) }}"
class="btn-action-sm btn-slip-view">
<i class="fas fa-file-pdf"></i>
</a>

@else

<form action="{{ route('admin.slip-gaji.store',$g->id_gaji) }}" method="POST">
@csrf
<button class="btn-action-sm btn-slip-create">
<i class="fas fa-file-invoice"></i>
</button>
</form>

@endif


<form action="{{ route('gaji.destroy',$g->id_gaji) }}" method="POST">

@csrf
@method('DELETE')

<button class="btn-action-sm btn-delete"
onclick="return confirm('Yakin ingin menghapus data gaji ini?')">

<i class="fas fa-trash"></i>

</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>


<!-- POPUP TUNJANGAN -->

<div id="modalTunjangan" class="modal-detail">

<div class="modal-content-detail">

<div class="modal-header">
<h3>Detail Tunjangan</h3>
<span class="close-modal" onclick="closeTunjangan()">&times;</span>
</div>

<p><strong>Nama :</strong> <span id="namaTunjangan"></span></p>

<ul id="listTunjangan"></ul>

</div>

</div>


<!-- POPUP POTONGAN -->

<div id="modalPotongan" class="modal-detail">

<div class="modal-content-detail">

<div class="modal-header">
<h3>Detail Potongan</h3>
<span class="close-modal" onclick="closePotongan()">&times;</span>
</div>

<p><strong>Nama :</strong> <span id="namaPotongan"></span></p>

<ul id="listPotongan"></ul>

</div>

</div>


<script>

function showTunjangan(nama,data){

document.getElementById('namaTunjangan').innerText=nama
document.getElementById('listTunjangan').innerHTML=data
document.getElementById('modalTunjangan').style.display='flex'

}

function closeTunjangan(){
document.getElementById('modalTunjangan').style.display='none'
}


function showPotongan(nama,data){

document.getElementById('namaPotongan').innerText=nama
document.getElementById('listPotongan').innerHTML=data
document.getElementById('modalPotongan').style.display='flex'

}

function closePotongan(){
document.getElementById('modalPotongan').style.display='none'
}

window.onclick=function(event){

let t=document.getElementById('modalTunjangan')
let p=document.getElementById('modalPotongan')

if(event.target==t){t.style.display="none"}
if(event.target==p){p.style.display="none"}

}

</script>

@endsection
