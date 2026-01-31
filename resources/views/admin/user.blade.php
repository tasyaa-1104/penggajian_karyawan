@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Data User</h4>

    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
        + Tambah User
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($users as $u)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->nama }}</td>
            <td>{{ ucfirst($u->role) }}</td>
            <td>
                <span class="badge {{ $u->status_akun == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($u->status_akun) }}
                </span>
            </td>
            <td>
                <a href="{{ route('user.edit',$u->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('user.destroy',$u->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus user?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
