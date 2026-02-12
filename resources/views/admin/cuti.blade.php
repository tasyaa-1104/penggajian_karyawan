@extends('admin.template')

@section('title', 'Data Cuti Karyawan')

@section('content')

<div class="container">
    <h4 class="mb-4">📋 Data Pengajuan Cuti</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cuti as $c)
                        <tr>
                            <td>{{ $c->karyawan->nama_karyawan }}</td>
                            <td>{{ $c->tanggal_mulai }} - {{ $c->tanggal_selesai }}</td>
                            <td>{{ $c->alasan }}</td>
                            <td>{{ strtoupper($c->status) }}</td>
                            <td>
                                @if($c->status == 'pending')
                                    <form action="{{ route('cuti.approve', $c->id_cuti) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">ACC</button>
                                    </form>

                                    <form action="{{ route('cuti.reject', $c->id_cuti) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                @else
                                    <span class="text-muted">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data cuti</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
