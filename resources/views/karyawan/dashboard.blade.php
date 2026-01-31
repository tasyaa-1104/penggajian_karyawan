@extends('karyawan.template')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Dashboard Karyawan</h4>

    {{-- INFO KARYAWAN --}}
    <div class="card mb-4">
        <div class="card-body">
            <strong>Nama :</strong> {{ auth()->user()->karyawan->nama_karyawan }} <br>
            <strong>Divisi :</strong> {{ auth()->user()->karyawan->divisi->nama_divisi ?? '-' }} <br>
            <strong>Jabatan :</strong> {{ auth()->user()->karyawan->jabatan->nama_jabatan ?? '-' }}
        </div>
    </div>

    {{-- RINGKASAN ABSENSI --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h6>Hadir</h6>
                    <h3 class="text-success">{{ $rekap->jumlah_hadir ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <h6>Izin</h6>
                    <h3 class="text-warning">{{ $rekap->jumlah_izin ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h6>Alpha</h6>
                    <h3 class="text-danger">{{ $rekap->jumlah_alpha ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- REKAP BULAN INI --}}
    <div class="card">
        <div class="card-header">
            Rekap Absensi Bulan {{ now()->format('Y-m') }}
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <tr>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Alpha</th>
                </tr>
                <tr>
                    <td>{{ $rekap->jumlah_hadir ?? 0 }}</td>
                    <td>{{ $rekap->jumlah_izin ?? 0 }}</td>
                    <td>{{ $rekap->jumlah_alpha ?? 0 }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection
