@extends('admin.template')

@section('content')
<h3>Data Divisi</h3>

<a href="{{ route('divisi.create') }}" class="btn btn-primary mb-3">
    + Tambah Divisi
</a>

{{-- SEARCH --}}
<form action="{{ route('divisi.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari nama divisi..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-secondary" type="submit">Cari</button>

            @if(request('search'))
                <a href="{{ route('divisi.index') }}" class="btn btn-outline-danger">
                    Reset
                </a>
            @endif
        </div>
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Divisi</th>
        <th>Aksi</th>
    </tr>

    @if($divisi->count() == 0)
        <tr>
            <td colspan="3" class="text-center">
                Data divisi tidak ditemukan
            </td>
        </tr>
    @endif

    @foreach($divisi as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nama_divisi }}</td>
        <td>
            <a href="{{ route('divisi.edit', $d->id_divisi) }}"
               class="btn btn-warning btn-sm">
                Edit
            </a>

            <form action="{{ route('divisi.destroy', $d->id_divisi) }}"
                  method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus divisi?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
