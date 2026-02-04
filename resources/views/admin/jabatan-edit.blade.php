{{-- @extends('admin.template')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Edit Jabatan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('jabatan.update', $jabatan->id_jabatan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" required>
                </div>

                <div class="mb-3">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok', $jabatan->gaji_pokok) }}" required>
                </div>

                <div class="mb-3">
                    <label>Divisi</label>
                    <select name="id_divisi" class="form-control" required>
                        @foreach($divisi as $d)
                            <option value="{{ $d->id_divisi }}" {{ $jabatan->id_divisi == $d->id_divisi ? 'selected' : '' }}>
                                {{ $d->nama_divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection --}}
