@extends('admin.template')

@section('content')
<div class="container mt-4">
<h4>tambah karyawan</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


        <form action="{{ route('karyawan-store') }}" method="post">
        @csrf

        <input name="nik" class="form-control mb-2" placeholder="nik">
        <input name="nama_karyawan" class="form-control mb-2" placeholder="nama">

        <select name="id_divisi" class="form-control mb-2">
            @foreach($divisi as $d)
                <option value="{{ $d->id_divisi }}">{{ $d->nama_divisi }}</option>
            @endforeach
        </select>

        <select name="id_jabatan" class="form-control mb-2">
            @foreach($jabatan as $j)
                <option value="{{ $j->id_jabatan }}">{{ $j->nama_jabatan }}</option>
            @endforeach
        </select>
        <input name="gaji_pokok" class="form-control mb-2" placeholder="gaji pokok">

        <select name="status_karyawan" class="form-control mb-2">
            <option value="aktif">aktif</option>
            <option value="nonaktif">nonaktif</option>
        </select>

            <button class="btn btn-success">simpan</button>
        </form>
    </div>
@endsection
