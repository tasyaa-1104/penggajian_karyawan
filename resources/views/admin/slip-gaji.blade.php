@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">
        <i class="fa fa-file-invoice"></i> data slip gaji
    </h4>

    <a href="{{ route('slipgaji.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> tambah slip gaji
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>no</th>
                <th>nama karyawan</th>
                <th>bulan</th>
                <th>tanggal cetak</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slip_gaji as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->gaji->karyawan->nama_karyawan }}</td>
                <td>{{ $item->gaji->bulan }}</td>
                <td>{{ $item->tanggal_cetak }}</td>
                <td>
                    <a href="{{ route('slipgaji.edit', $item->id_slip) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('slipgaji.destroy', $item->id_slip) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('hapus data?')" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
