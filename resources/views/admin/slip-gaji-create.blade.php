@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">
        <i class="fa fa-plus"></i> tambah slip gaji
    </h4>

    <form action="{{ route('slipgaji.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label>gaji karyawan</label>
            <select name="id_gaji" class="form-control" required>
                <option value="">-- pilih --</option>
                @foreach($gaji as $item)
                    <option value="{{ $item->id_gaji }}">
                        {{ $item->karyawan->nama_karyawan }} - {{ $item->bulan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>tanggal cetak</label>
            <input type="date" name="tanggal_cetak" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>file slip (opsional)</label>
            <input type="text" name="file_slip" class="form-control">
        </div>

        <button class="btn btn-success">
            <i class="fa fa-save"></i> simpan
        </button>

        <a href="{{ route('slipgaji.index') }}" class="btn btn-secondary">
            kembali
        </a>
    </form>
</div>
@endsection
