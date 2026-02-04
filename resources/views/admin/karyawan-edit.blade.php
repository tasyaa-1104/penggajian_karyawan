@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Edit Karyawan</h4>

    {{-- TAMPILKAN ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('karyawan-update', $karyawan->id_karyawan) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- 🔥 PENTING: id_user WAJIB DIKIRIM --}}
        <input type="hidden" name="id_user" value="{{ $karyawan->id_user }}">

        <div class="mb-2">
            <label>NIK</label>
            <input name="nik" value="{{ $karyawan->nik }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>Nama Karyawan</label>
            <input name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Divisi</label>
            <select name="id_divisi" class="form-control">
                @foreach($divisi as $d)
                    <option value="{{ $d->id_divisi }}"
                        {{ $karyawan->id_divisi == $d->id_divisi ? 'selected' : '' }}>
                        {{ $d->nama_divisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Jabatan</label>
            <select name="id_jabatan" class="form-control">
                @foreach($jabatan as $j)
                    <option value="{{ $j->id_jabatan }}"
                        {{ $karyawan->id_jabatan == $j->id_jabatan ? 'selected' : '' }}>
                        {{ $j->nama_jabatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Gaji Pokok</label>
            <input name="gaji_pokok" value="{{ $karyawan->gaji_pokok }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status_karyawan" class="form-control">
                <option value="aktif" {{ $karyawan->status_karyawan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $karyawan->status_karyawan == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('karyawan') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
