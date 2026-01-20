@extends('admin.template')

@section('content')
<div class="container mt-4">
<h4>edit karyawan</h4>

<form action="{{ route('karyawan-update',$karyawan->id_karyawan) }}" method="post">
@csrf
@method('put')

<input name="nik" value="{{ $karyawan->nik }}" class="form-control mb-2">
<input name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" class="form-control mb-2">

<button class="btn btn-primary">update</button>
</form>
</div>
@endsection
