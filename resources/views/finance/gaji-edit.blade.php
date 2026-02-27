@extends('finance.template')

@section('content')
<div class="container mt-4">
    <h4>edit gaji</h4>

    <form action="{{ route('gaji.update', $gaji->id_gaji) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>karyawan</label>
            <select name="id_karyawan" class="form-control" required>
                @foreach ($karyawan as $item)
                    <option value="{{ $item->id_karyawan }}"
                        {{ $gaji->id_karyawan == $item->id_karyawan ? 'selected' : '' }}>
                        {{ $item->nama_karyawan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>bulan</label>
            <input type="month"
                   name="bulan"
                   class="form-control"
                   value="{{ $gaji->bulan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>total tunjangan</label>
            <input type="number"
                   name="total_tunjangan"
                   class="form-control"
                   value="{{ $gaji->total_tunjangan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>total potongan</label>
            <input type="number"
                   name="total_potongan"
                   class="form-control"
                   value="{{ $gaji->total_potongan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>gaji bersih</label>
            <input type="number"
                   name="gaji_bersih"
                   class="form-control"
                   value="{{ $gaji->gaji_bersih }}"
                   required>
        </div>

        <button class="btn btn-primary">update</button>
        <a href="{{ route('gaji.index') }}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection
