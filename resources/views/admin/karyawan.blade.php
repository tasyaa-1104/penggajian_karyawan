@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4><i class="fa fa-users"></i> Data Karyawan</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="{{ route('karyawan-create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah
    </a>

    {{-- SEARCH --}}
    <form action="{{ route('karyawan') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari NIK / Nama / Divisi / Jabatan / Status..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary">Cari</button>

                @if(request('search'))
                    <a href="{{ route('karyawan') }}" class="btn btn-outline-danger">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @if($karyawans->count() == 0)
            <tr>
                <td colspan="8" class="text-center">
                    Data karyawan tidak ditemukan
                </td>
            </tr>
        @endif

        @foreach($karyawans as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nik }}</td>
                <td>{{ $k->nama_karyawan }}</td>
                <td>{{ $k->divisi->nama_divisi ?? '-' }}</td>
                <td>{{ $k->jabatan->nama_jabatan ?? '-' }}</td>
                <td>{{ number_format($k->gaji_pokok,0,',','.') }}</td>
                <td>{{ ucfirst($k->status_karyawan) }}</td>
                <td>
                    <a href="{{ route('karyawan-edit',$k->id_karyawan) }}"
                       class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('karyawan-destroy',$k->id_karyawan) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus data?')">
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
