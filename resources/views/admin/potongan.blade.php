@extends('admin.template')

@section('content')
<div class="container mt-4">
<h4>data potongan</h4>

<a href="{{ route('potongan.create') }}" class="btn btn-primary mb-3">tambah</a>

<table class="table table-bordered">
<tr>
    <th>no</th>
    <th>nama</th>
    <th>nominal</th>
    <th>aksi</th>
</tr>
@foreach($potongan as $p)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $p->nama_potongan }}</td>
<td>{{ number_format($p->nominal) }}</td>
<td>
<a href="{{ route('potongan.edit',$p->id_potongan) }}" class="btn btn-warning btn-sm">edit</a>
<form action="{{ route('potongan.destroy',$p->id_potongan) }}" method="post" class="d-inline">
@csrf @method('delete')
<button class="btn btn-danger btn-sm">hapus</button>
</form>
</td>
</tr>
@endforeach
</table>
</div>
@endsection
