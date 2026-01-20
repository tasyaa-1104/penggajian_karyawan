@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">
        <i class="fa fa-edit"></i> edit slip gaji
    </h4>

    <form action="{{ route('slipgaji.update', $slip_gaji->id_slip) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>gaji karyawan</label>
            <select name="id_gaji" class="form-control">
                @foreach($gaji as $item)
                    <option value="{{ $item->id_gaji }}"
                        {{ $slip_gaji->id_gaji == $item->id_gaji ? 'selected' : '' }}>
                        {{ $item->karyawan->nama_karyawan }} - {{ $item->bulan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>tanggal cetak</label>
            <input type="date" name="tanggal_cetak"
                   value="{{ $slip_gaji->tanggal_cetak }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>file slip</label>
            <input type="text" name="file_slip"
                   value="{{ $slip_gaji->file_slip }}"
                   class="form-control">
        </div>

        <button class="btn btn-primary">
            <i class="fa fa-save"></i> update
        </button>

        <a href="{{ route('slipgaji.index') }}" class="btn btn-secondary">
            kembali
        </a>
    </form>
</div>
@endsection
