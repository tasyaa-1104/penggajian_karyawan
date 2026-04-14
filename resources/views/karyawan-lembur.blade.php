@extends('template')

@section('title', 'Pengajuan Lembur')

@section('content')

<h3>Pengajuan Lembur</h3>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form action="{{ route('karyawan.lembur.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    {{-- <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"
            placeholder="Contoh: lembur proyek deadline"></textarea>
    </div> --}}

    <div class="mb-3">
        <label>Upload Foto Bukti</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-danger">Kirim Lembur</button>
</form>

@endsection
