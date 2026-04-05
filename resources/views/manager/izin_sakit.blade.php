@extends('manager.template')

@section('title', 'Persetujuan Izin & Sakit')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.page-title-section{
    background:#FFF5F5;
    border-left:5px solid #9B1C20;
    padding:20px 25px;
    border-radius:10px;
    margin-bottom:25px;
}

.page-title{
    color:#9B1C20;
    font-weight:700;
    font-size:24px;
}

.main-card{
    background:white;
    border-radius:15px;
    box-shadow:0 2px 15px rgba(0,0,0,0.08);
}

.custom-table thead th{
    background:#9B1C20 !important;
    color:white !important;
    padding:15px 12px;
}
</style>

<div class="container-fluid mt-4">

<div class="page-title-section">
    <h3 class="page-title">
        <i class="fas fa-file-signature me-2"></i> Data Izin & Sakit Karyawan
    </h3>
</div>

<div class="card main-card">
<div class="card-body">
<div class="table-responsive">

<table class="table custom-table">
<thead>
<tr>
    <th>No</th>
    <th>Nama Karyawan</th>
    <th>Tanggal</th>
    <th>Jenis Pengajuan</th>
    <th>Keterangan</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

@foreach($data as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->karyawan->nama_karyawan }}</td>
    <td>{{ $d->tanggal }}</td>
    <td>{{ $d->jenis }}</td>
    <td>{{ $d->isi }}</td>
    <td>{{ $d->status }}</td>
</tr>
@endforeach

</tbody>
</table>

</div>
</div>
</div>

</div>

@endsection