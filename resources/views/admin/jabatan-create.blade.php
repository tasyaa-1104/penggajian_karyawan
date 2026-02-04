{{-- @extends('admin.template')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Jabatan</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jabatan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control" value="{{ old('nama_jabatan') }}" required>
                </div>

                <div class="mb-3">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') }}" required>
                </div>

                <div class="mb-3">
                    <label>Divisi</label>
                    <select name="id_divisi" class="form-control" required>
                        <option value="">-- Pilih Divisi --</option>
                        @foreach($divisi as $d)
                            <option value="{{ $d->id_divisi }}" {{ old('id_divisi') == $d->id_divisi ? 'selected' : '' }}>
                                {{ $d->nama_divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection --}}
