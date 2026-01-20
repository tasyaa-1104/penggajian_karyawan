@extends('admin.template')

@section('content')
<div class="container">
    <h3 class="mb-3">Tambah Absensi</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf

                <div class="mb-2">
                    <label>Karyawan</label>
                    <select name="id_karyawan" class="form-control" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($karyawan as $k)
                            <option value="{{ $k->id_karyawan }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Status Kehadiran</label>
                    <select name="status_kehadiran" class="form-control" required>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alpa">Alpa</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>

                <button class="btn btn-success">Simpan</button>
                <a href="{{ route('absensi') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
