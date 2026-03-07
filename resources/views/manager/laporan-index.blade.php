@extends('manager.template')

@section('title','Laporan')

@section('content')

<div class="container mt-4">

<h3 class="mb-4">Laporan Data Karyawan</h3>

<div class="card shadow">
<div class="card-body">

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Karyawan</th>
    <th>Tanggal</th>
    <th>Absensi</th>
    <th>Cuti</th>
    <th>Lembur</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

@forelse($laporan as $data)

<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ $data->karyawan->nama_karyawan ?? '-' }}
</td>

<td>
{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}
</td>

<td>
{{ $data->status ?? 'Hadir' }}
</td>

<td>
{{ $data->cuti ?? '-' }}
</td>

<td>
@if($data->overtime)

{{ $data->overtime->total_jam }} Jam

@else

0 Jam

@endif
</td>
<td>

@if($data->status == 'approved')
<span class="badge bg-success">Approved</span>

@elseif($data->status == 'pending')
<span class="badge bg-warning">Pending</span>

@elseif($data->status == 'rejected')
<span class="badge bg-danger">Rejected</span>

@else
<span class="badge bg-secondary">Normal</span>
@endif

</td>

</tr>

@empty

<tr>
<td colspan="7" class="text-center">
Tidak ada data laporan
</td>
</tr>

@endforelse

</tbody>

</table>

</div>
</div>

</div>

@endsection
