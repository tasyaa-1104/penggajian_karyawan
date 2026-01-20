@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>tambah potongan</h4>

    <form action="{{ route('potongan.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label>nama potongan</label>
            <input type="text" name="nama_potongan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <button class="btn btn-success">simpan</button>
        <a href="{{ route('potongan.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection
