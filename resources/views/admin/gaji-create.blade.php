@extends('admin.template')

@section('title', 'Hitung Gaji Massal')

@section('content')

<div class="container-custom">
    <div class="glass-card">

        <h3>🧮 Hitung Gaji Massal</h3>

        <form action="{{ route('gaji.store') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label>Bulan</label>
                <input type="month" name="bulan" required class="search-input">
            </div>

            <table class="modern-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Gaji Pokok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawan as $k)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="id_karyawan[]"
                                       value="{{ $k->id_karyawan }}">
                            </td>
                            <td>{{ $k->nama_karyawan }}</td>
                            <td>{{ $k->jabatan->nama_jabatan ?? '-' }}</td>
                            <td>Rp {{ number_format($k->gaji_pokok,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn-modern btn-add" style="margin-top:20px;">
                💾 Hitung & Simpan Gaji
            </button>

        </form>

    </div>
</div>

<script>
document.getElementById('checkAll').addEventListener('click', function(){
    document.querySelectorAll('input[name="id_karyawan[]"]').forEach(cb => {
        cb.checked = this.checked;
    });
});
</script>

@endsection
