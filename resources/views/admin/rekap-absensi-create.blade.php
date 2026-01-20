@extends('admin.template')

@section('konten')
<div class="container col-md-4">
    <h4 class="mb-3">Generate Rekap Absensi</h4>

    <form action="{{ route('rekap-absensi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Bulan</label>
            <input type="month" name="bulan" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">
            Generate Rekap
        </button>

        <a href="{{ route('rekap-absensi.index') }}"
           class="btn btn-secondary w-100 mt-2">
            Kembali
        </a>
    </form>
</div>
@endsection
