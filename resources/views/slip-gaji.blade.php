@extends('template')

@section('content')
<div class="container mt-4">
    <h4>Slip Gaji Karyawan</h4>

   @if($slip->isEmpty())
    <div class="alert alert-info">
        Slip gaji belum tersedia. Silakan hubungi admin.
    </div>
@else
    <table class="table">
        <tr>
            <th>Bulan</th>
            <th>Gaji Bersih</th>
            <th>Aksi</th>
        </tr>
        @foreach($slip as $s)
        <tr>
            <td>{{ $s->gaji->bulan }}</td>
            <td>
                Rp {{ number_format($s->gaji->gaji_bersih,0,',','.') }}
            </td>
            <td>
                <a href="{{ route('karyawan.slip-gaji.show', $s->id_slip) }}"
                   class="btn btn-info btn-sm">
                    Detail
                </a>
            </td>
        </tr>
        @endforeach
    </table>
@endif

</div>
@endsection
