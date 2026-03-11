@extends('manager.template')

@section('content')

<h3 class="mb-4">Data Sakit Karyawan</h3>

<table class="table table-bordered">
<thead>
<tr>
    <th>No</th>
    <th>Nama Karyawan</th>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($data as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>
    <strong>{{ $d->karyawan->nama_karyawan ?? '-' }}</strong>
    </td>
    <td>{{ $d->tanggal }}</td>
    <td>{{ $d->keterangan }}</td>
    <td>{{ $d->status }}</td>

    <td>

        @if($d->status == 'pending')

        <form action="{{ route('manager.sakit.approve',$d->id) }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-success btn-sm">Approve</button>
        </form>

        <form action="{{ route('manager.sakit.reject',$d->id) }}" method="POST" style="display:inline">
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
