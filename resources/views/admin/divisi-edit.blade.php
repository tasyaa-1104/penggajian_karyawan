@extends('admin.template')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Divisi</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('divisi.update', $divisi->id_divisi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Divisi</label>
                    <input type="text" name="nama_divisi"
                           class="form-control"
                           value="{{ old('nama_divisi', $divisi->nama_divisi) }}"
                           required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
