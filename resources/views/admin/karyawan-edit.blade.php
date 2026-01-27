@extends('admin.template')

@section('content')
<div class="container mt-4">
<h4>Edit Karyawan</h4>

<form action="{{ route('karyawan-update',$karyawan->id_karyawan) }}" method="POST">
@csrf
@method('PUT')

<input name="nik" value="{{ $karyawan->nik }}" class="form-control mb-2">
<input name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" class="form-control mb-2">

<select name="id_divisi" class="form-control mb-2">
@foreach($divisi as $d)
<option value="{{ $d->id_divisi }}"
    {{ $karyawan->id_divisi == $d->id_divisi ? 'selected' : '' }}>
    {{ $d->nama_divisi }}
</option>
@endforeach
</select>

<select name="id_jabatan" class="form-control mb-2">
@foreach($jabatan as $j)
<option value="{{ $j->id_jabatan }}"
    {{ $karyawan->id_jabatan == $j->id_jabatan ? 'selected' : '' }}>
    {{ $j->nama_jabatan }}
</option>
@endforeach
</select>

<input name="gaji_pokok" value="{{ $karyawan->gaji_pokok }}" class="form-control mb-2">

<select name="status_karyawan" class="form-control mb-2">
<option value="aktif" {{ $karyawan->status_karyawan=='aktif'?'selected':'' }}>aktif</option>
<option value="nonaktif" {{ $karyawan->status_karyawan=='nonaktif'?'selected':'' }}>nonaktif</option>
</select>

<button class="btn btn-primary">Update</button>
</form>
</div>
@endsection
