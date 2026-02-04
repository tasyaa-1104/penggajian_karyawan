@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Tambah Karyawan</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('karyawan-store') }}" method="post">
        @csrf

        <input name="nik" class="form-control mb-2" placeholder="NIK" required>

        <select name="id_user" class="form-control mb-2" required>
            <option value="">-- Pilih User --</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
            @endforeach
        </select>

        <select name="id_divisi" class="form-control mb-2" required>
            <option value="">-- Pilih Divisi --</option>
            @foreach($divisi as $d)
                <option value="{{ $d->id_divisi }}">
                    {{ $d->nama_divisi }}
                </option>
            @endforeach
        </select>

        <select name="id_jabatan" class="form-control mb-2" required>
            <option value="">-- Pilih Jabatan --</option>
            @foreach($jabatan as $j)
                <option value="{{ $j->id_jabatan }}">
                    {{ $j->nama_jabatan }}
                    (Rp {{ number_format($j->gaji_pokok,0,',','.') }})
                </option>
            @endforeach
        </select>

        <small class="text-muted d-block mb-3">
            Gaji pokok awal otomatis mengikuti jabatan.
            Dapat diubah kemudian melalui edit karyawan.
        </small>

        <select name="status_karyawan" class="form-control mb-3" required>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>

        <button class="btn btn-success">
            <i class="fa fa-save"></i> Simpan
        </button>
    </form>
</div>
@endsection
