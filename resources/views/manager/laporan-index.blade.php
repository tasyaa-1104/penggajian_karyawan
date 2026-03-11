@extends('manager.template')

@section('content')

<div class="container-fluid">

<h3 class="mb-4">Laporan Data Karyawan</h3>

<ul class="nav nav-tabs mb-3">

<li class="nav-item">
<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#absensi">
Absensi
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#cuti">
Cuti
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#lembur">
Lembur
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#izin">
Izin
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#sakit">
Sakit
</button>
</li>

</ul>

<div class="tab-content">

{{-- ================= ABSENSI ================= --}}

<div class="tab-pane fade show active" id="absensi">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($laporan as $a)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $a->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $a->tanggal }}</td>
<td>{{ $a->status_kehadiran }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

{{-- ================= CUTI ================= --}}

<div class="tab-pane fade" id="cuti">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal Mulai</th>
<th>Tanggal Selesai</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($cuti as $c)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $c->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $c->tanggal_mulai }}</td>
<td>{{ $c->tanggal_selesai }}</td>
<td>{{ $c->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

{{-- ================= LEMBUR ================= --}}

<div class="tab-pane fade" id="lembur">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Jam Lembur</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($lembur as $l)
<tr>
<td>{{ $loop->iteration }}</td>

<td>{{ $l->karyawan->nama_karyawan ?? '-' }}</td>

<td>{{ date('d-m-Y', strtotime($l->tanggal)) }}</td>

<td>{{ $l->total_jam }} Jam</td>
<td>{{ $l->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

{{-- ================= IZIN ================= --}}

<div class="tab-pane fade" id="izin">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Alasan</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($izin as $i)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $i->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $i->tanggal }}</td>
<td>{{ $i->alasan }}</td>
<td>{{ $i->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

{{-- ================= SAKIT ================= --}}

<div class="tab-pane fade" id="sakit">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($sakit as $s)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $s->karyawan->nama_karyawan ?? '-' }}</td>
<td>{{ $s->tanggal }}</td>
<td>{{ $s->keterangan }}</td>
<td>{{ $s->status }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection
