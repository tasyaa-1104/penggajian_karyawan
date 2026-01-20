@extends('admin.template')

@section('konten')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Divisi</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('divisi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Divisi</label>
                    <input type="text" name="nama_divisi"
                           class="form-control"
                           value="{{ old('nama_divisi') }}"
                           placeholder="Masukkan nama divisi"
                           required>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('divisi.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
