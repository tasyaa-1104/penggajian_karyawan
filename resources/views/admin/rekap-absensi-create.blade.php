@extends('admin.template')

@section('content')
<div class="container">
    <h3>Generate Rekap Absensi Bulanan</h3>

  <form action="{{ route('rekap-absensi.generate') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>Bulan</label>
        <input type="month" name="bulan" class="form-control" required>
    </div>

    <button class="btn btn-primary">
        Generate Rekap
    </button>
</form>
</div>
@endsection
