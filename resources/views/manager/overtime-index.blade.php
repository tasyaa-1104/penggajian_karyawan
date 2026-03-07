@extends('manager.template')

@section('title','Persetujuan Lembur')

@section('content')

<div class="container mt-4">

<h3 class="mb-4">Persetujuan Lembur</h3>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Karyawan</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Total Jam</th>
    <th>Upah</th>
    <th>Status</th>
    <th width="160">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($overtimes as $overtime)

<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ $overtime->karyawan->nama_karyawan ?? '-' }}
</td>

<td>
{{ \Carbon\Carbon::parse($overtime->tanggal)->format('d-m-Y') }}
</td>

<td>
{{ $overtime->jam_mulai }} - {{ $overtime->jam_selesai }}
</td>

<td>
{{ $overtime->total_jam }} Jam
</td>

<td>
Rp {{ number_format($overtime->total_upah,0,',','.') }}
</td>

<td>

@if($overtime->status == 'pending')
<span class="badge bg-warning text-dark">Pending</span>

@elseif($overtime->status == 'approved')
<span class="badge bg-success">Approved</span>

@elseif($overtime->status == 'rejected')
<span class="badge bg-danger">Rejected</span>

@endif

</td>

<td>

@if($overtime->status == 'pending')

<div class="d-flex gap-1">

{{-- APPROVE --}}
<form action="{{ route('overtime.approve',$overtime->id) }}" method="POST">

@csrf
@method('PUT')

<button type="submit" class="btn btn-success btn-sm"
onclick="return confirm('Setujui lembur ini?')">

Approve

</button>

</form>

{{-- REJECT --}}
<form action="{{ route('overtime.reject',$overtime->id) }}" method="POST">

@csrf
@method('PUT')

<button type="submit" class="btn btn-danger btn-sm"
onclick="return confirm('Tolak lembur ini?')">

Reject

</button>

</form>

</div>

@else

<span class="text-muted">Selesai</span>

@endif

</td>

</tr>

@empty

<tr>
<td colspan="8" class="text-center">
Tidak ada data lembur
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

@endsection
