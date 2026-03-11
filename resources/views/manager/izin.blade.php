@extends('manager.template')

@section('content')

<h3 class="mb-4">Data Izin Karyawan</h3>

<table class="table table-bordered">
<thead>
<tr>
    <th>No</th>
    <th>Nama Karyawan</th>
    <th>Tanggal</th>
    <th>Alasan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($data as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->karyawan->nama }}</td>
    <td>{{ $d->tanggal }}</td>
    <td>{{ $d->alasan }}</td>
    <td>{{ $d->status }}</td>

    <td>

        @if($d->status == 'pending')

        <form action="{{ route('manager.izin.approve',$d->id) }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-success btn-sm">Approve</button>
        </form>

        <form action="{{ route('manager.izin.reject',$d->id) }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-danger btn-sm">Reject</button>
        </form>

        @endif

    </td>

</tr>
@endforeach
</tbody>

</table>

@endsection
