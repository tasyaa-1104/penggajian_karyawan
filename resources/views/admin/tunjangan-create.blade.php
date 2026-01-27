@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>tambah tunjangan</h4>

       @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tunjangan.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label>nama tunjangan</label>
            <input type="text" name="nama_tunjangan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <button class="btn btn-success">simpan</button>
        <a href="{{ route('tunjangan.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection
