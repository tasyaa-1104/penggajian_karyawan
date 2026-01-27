@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>edit tunjangan</h4>
    
       @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tunjangan.update', $tunjangan->id_tunjangan) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>nama tunjangan</label>
            <input type="text"
                   name="nama_tunjangan"
                   class="form-control"
                   value="{{ $tunjangan->nama_tunjangan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>nominal</label>
            <input type="number"
                   name="nominal"
                   class="form-control"
                   value="{{ $tunjangan->nominal }}"
                   required>
        </div>

        <button class="btn btn-primary">update</button>
        <a href="{{ route('tunjangan.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection
