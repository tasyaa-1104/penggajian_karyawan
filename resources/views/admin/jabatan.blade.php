@extends('admin.template')

@section('content')
<h3>Data Jabatan</h3>

<a href="{{ route('jabatan.create') }}" class="btn btn-primary mb-3">
    + Tambah Jabatan
</a>

{{-- SEARCH --}}
<form action="{{ route('jabatan.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari jabatan / divisi..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-secondary" type="submit">Cari</button>

            @if(request('search'))
                <a href="{{ route('jabatan.index') }}" class="btn btn-outline-danger">
                    Reset
                </a>
            @endif
        </div>
    </div>
</form>

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

    @if($jabatan->count() == 0)
        <tr>
            <td colspan="5" class="text-center">
                Data jabatan tidak ditemukan
            </td>
        </tr>
    @endif

    @foreach($jabatan as $j)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $j->nama_jabatan }}</td>
        <td>{{ number_format($j->gaji_pokok,0,',','.') }}</td>
        <td>{{ $j->divisi->nama_divisi }}</td>
        <td>
            <a href="{{ route('jabatan.edit', $j->id_jabatan) }}"
               class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('jabatan.destroy', $j->id_jabatan) }}"
                  method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus jabatan?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
