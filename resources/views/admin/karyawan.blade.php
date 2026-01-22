@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4><i class="fa fa-users"></i> data karyawan</h4>

    <a href="{{ route('karyawan-create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> tambah
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>nik</th>
                <th>nama</th>
                <th>divisi</th>
                <th>jabatan</th>
                <th>status</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($karyawans as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nik }}</td>
                <td>{{ $k->nama_karyawan }}</td>
                <td>{{ $k->divisi->nama_divisi }}</td>
                <td>{{ $k->jabatan->nama_jabatan }}</td>
                <td>{{ $k->status_karyawan }}</td>
                <td>
                    <a href="{{ route('karyawan-edit',$k->id_karyawan) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('karyawan-destroy',$k->id_karyawan) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">
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
