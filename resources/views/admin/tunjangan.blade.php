@extends('admin.template')

@section('content')
<div class="container mt-4">
<h4>data tunjangan</h4>

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<a href="{{ route('tunjangan.create') }}" class="btn btn-primary mb-3">tambah</a>

<table class="table table-bordered">
<tr>
    <th>no</th>
    <th>nama</th>
    <th>nominal</th>
    <th>aksi</th>
</tr>
@foreach($tunjangan as $t)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $t->nama_tunjangan }}</td>
<td>{{ number_format($t->nominal) }}</td>
<td>
<a href="{{ route('tunjangan.edit',$t->id_tunjangan) }}" class="btn btn-warning btn-sm">edit</a>
<form action="{{ route('tunjangan.destroy',$t->id_tunjangan) }}" method="post" class="d-inline">
@csrf @method('delete')
<button class="btn btn-danger btn-sm">hapus</button>
</form>
</td>
</tr>
@endforeach
</table>
</div>
@endsection
