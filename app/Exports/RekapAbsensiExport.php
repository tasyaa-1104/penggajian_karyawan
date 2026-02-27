<?php

namespace App\Exports;

use App\Models\rekap_absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapAbsensiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return rekap_absensi::with('karyawan')->get()->map(function ($r) {
            return [
                'Nama Karyawan' => $r->karyawan->nama_karyawan ?? '-',
                'Bulan'         => $r->bulan,
                'Hadir'         => $r->jumlah_hadir,
                'Izin'          => $r->jumlah_izin,
                'Sakit'         => $r->jumlah_sakit,
                'Alpha'         => $r->jumlah_alpha,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Bulan',
            'Hadir',
            'Izin',
            'Sakit',
            'Alpha'
        ];
    }
}
