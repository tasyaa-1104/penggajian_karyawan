@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>data gaji karyawan</h4>

    <a href="{{ route('gaji.create') }}" class="btn btn-primary mb-3">
        tambah gaji
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>nama karyawan</th>
                <th>bulan</th>
                <th>total tunjangan</th>
                <th>total potongan</th>
                <th>gaji bersih</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gaji as $item)
            <tr>
                <td>{{ $item->karyawan->nama_karyawan }}</td>
                <td>{{ $item->bulan }}</td>
                <td>Rp {{ number_format($item->total_tunjangan) }}</td>
                <td>Rp {{ number_format($item->total_potongan) }}</td>
                <td><strong>Rp {{ number_format($item->gaji_bersih) }}</strong></td>
                <td>
                    <a href="{{ route('gaji.edit', $item->id_gaji) }}" class="btn btn-warning btn-sm">edit</a>

                    <form action="{{ route('gaji.destroy', $item->id_gaji) }}"
                          method="post"
                          class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('hapus data?')">
                            hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
