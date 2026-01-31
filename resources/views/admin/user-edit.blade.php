@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h4>Edit User</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Username</label>
            <input type="text"
                   name="username"
                   class="form-control"
                   value="{{ old('username', $user->username) }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama', $user->nama) }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Password (opsional)</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Kosongkan jika tidak diubah">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="karyawan" {{ $user->role == 'karyawan' ? 'selected' : '' }}>
                    Karyawan
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status Akun</label>
            <select name="status_akun" class="form-control" required>
                <option value="aktif" {{ $user->status_akun == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="nonaktif" {{ $user->status_akun == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('user.list') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
