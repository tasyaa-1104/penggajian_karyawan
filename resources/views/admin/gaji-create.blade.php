@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Hitung Gaji Karyawan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gaji.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Karyawan</label>
            <select name="id_karyawan" class="form-control" required>
                <option value="">-- pilih karyawan --</option>
                @foreach($karyawan as $k)
                    <option value="{{ $k->id_karyawan }}">
                        {{ $k->nama_karyawan }} - {{ $k->jabatan->nama_jabatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bulan</label>
            <input type="month" name="bulan" class="form-control" required>
        </div>

        <button class="btn btn-success">
            <i class="fa fa-calculator"></i> Hitung Gaji
        </button>

        <a href="{{ route('gaji.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
