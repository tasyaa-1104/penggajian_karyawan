@extends('finance.template')

@section('title', 'Atur Tunjangan')

@section('content')

<div class="container mt-4">

    <h3>Atur Tunjangan - {{ $karyawan->nama_karyawan }}</h3>

    <form action="" method="POST">
        @csrf

        @foreach($tunjangan as $t)
            <div class="form-check mb-2">
                <input class="form-check-input"
                       type="checkbox"
                       name="tunjangan[]"
                       value="{{ $t->id_tunjangan }}">

                <label class="form-check-label">
                    {{ $t->nama_tunjangan }}
                    - Rp {{ number_format($t->nominal,0,',','.') }}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">
            Simpan Tunjangan
        </button>

    </form>

</div>

@endsection