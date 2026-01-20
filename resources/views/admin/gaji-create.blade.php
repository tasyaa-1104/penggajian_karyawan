@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>tambah gaji</h4>

    <form action="{{ route('gaji.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label>karyawan</label>
            <select name="id_karyawan" class="form-control" required>
                <option value="">-- pilih karyawan --</option>
                @foreach ($karyawan as $item)
                    <option value="{{ $item->id_karyawan }}">
                        {{ $item->nama_karyawan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>bulan</label>
            <input type="month" name="bulan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>total tunjangan</label>
            <input type="number" name="total_tunjangan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>total potongan</label>
            <input type="number" name="total_potongan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>gaji bersih</label>
            <input type="number" name="gaji_bersih" class="form-control" required>
        </div>

        <button class="btn btn-success">simpan</button>
        <a href="{{ route('gaji.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection
