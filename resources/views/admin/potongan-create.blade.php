@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Tambah Potongan</h4>

    <form action="{{ route('potongan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Potongan</label>
            <input type="text" name="nama_potongan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('potongan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
