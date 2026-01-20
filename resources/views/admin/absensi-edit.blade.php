@extends('admin.template')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Absensi</h4>

    <form action="{{ route('absensi.update', $absensi->id_absensi) }}" method="POST">
        @csrf

        {{-- KARYAWAN --}}
        <div class="mb-3">
            <label class="form-label">Nama Karyawan</label>
            <select name="id_karyawan" class="form-control" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach ($karyawan as $item)
                    <option value="{{ $item->id_karyawan }}"
                        {{ $absensi->id_karyawan == $item->id_karyawan ? 'selected' : '' }}>
                        {{ $item->nama_karyawan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TANGGAL --}}
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date"
                   name="tanggal"
                   class="form-control"
                   value="{{ $absensi->tanggal }}"
                   required>
        </div>

        {{-- STATUS --}}
        <div class="mb-3">
            <label class="form-label">Status Kehadiran</label>
            <select name="status_kehadiran" class="form-control" required>
                <option value="Hadir" {{ $absensi->status_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="Izin"  {{ $absensi->status_kehadiran == 'Izin' ? 'selected' : '' }}>Izin</option>
                <option value="Alpha" {{ $absensi->status_kehadiran == 'Alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>

        {{-- KETERANGAN --}}
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3">{{ $absensi->keterangan }}</textarea>
        </div>

        {{-- BUTTON --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
