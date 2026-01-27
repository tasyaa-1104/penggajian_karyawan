@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Data Potongan</h4>

    <a href="{{ route('potongan.create') }}" class="btn btn-primary mb-3">
        Tambah Potongan
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Potongan</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>

        @foreach($potongan as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ ucfirst($p->nama_potongan) }}</td>
            <td>Rp {{ number_format($p->nominal,0,',','.') }}</td>
            <td>
                <a href="{{ route('potongan.edit', $p->id_potongan) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('potongan.destroy', $p->id_potongan) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
