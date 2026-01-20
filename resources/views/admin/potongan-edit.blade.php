@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>edit potongan</h4>

    <form action="{{ route('potongan.update', $potongan->id_potongan) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>nama potongan</label>
            <input type="text"
                   name="nama_potongan"
                   class="form-control"
                   value="{{ $potongan->nama_potongan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>nominal</label>
            <input type="number"
                   name="nominal"
                   class="form-control"
                   value="{{ $potongan->nominal }}"
                   required>
        </div>

        <button class="btn btn-primary">update</button>
        <a href="{{ route('potongan.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection
