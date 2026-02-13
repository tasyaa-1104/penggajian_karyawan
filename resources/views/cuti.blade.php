@extends('template')

@section('title', 'Pengajuan Cuti')

@section('content')

<div class="container">
    <h4 class="mb-4">🌴 Pengajuan Cuti</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cuti.store') }}" method="POST" class="card p-4 mb-4">
        @csrf

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alasan</label>
            <textarea name="alasan" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary">Ajukan Cuti</button>
    </form>

    <div class="card">
        <div class="card-header">Riwayat Cuti</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Alasan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cuti as $c)
                        <tr>
                            <td>{{ $c->tanggal_mulai }} - {{ $c->tanggal_selesai }}</td>
                            <td>{{ $c->alasan }}</td>
                            <td>
                                <span class="badge
                                    @if($c->status == 'pending') bg-warning
                                    @elseif($c->status == 'disetujui') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ strtoupper($c->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada pengajuan cuti</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
