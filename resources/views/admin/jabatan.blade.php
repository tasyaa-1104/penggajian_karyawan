@extends('admin.template')

@section('konten')
<h3>Data Jabatan</h3>

<a href="{{ route('jabatan.create') }}" class="btn btn-primary mb-3">
    + Tambah Jabatan
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Jabatan</th>
        <th>Gaji Pokok</th>
        <th>Divisi</th>
        <th>Aksi</th>
    </tr>
    @foreach($jabatan as $j)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $j->nama_jabatan }}</td>
        <td>{{ number_format($j->gaji_pokok,0,',','.') }}</td>
        <td>{{ $j->divisi->nama_divisi }}</td>
        <td>
            <a href="{{ route('jabatan.edit', $j->id_jabatan) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('jabatan.destroy', $j->id_jabatan) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus jabatan?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
