<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'id_karyawan',
        'bulan',
        'tahun',
        'gaji_pokok',
        'total_overtime',
        'total_tunjangan',
        'total_potongan',
        'gaji_bersih',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function slipGaji()
    {
        return $this->hasOne(slip_gaji::class, 'id_gaji', 'id_gaji');
    }
   public function rekap()
    {
        return $this->hasOne(\App\Models\rekap_absensi::class, 'id_karyawan', 'id_karyawan')
            ->where('bulan', $this->bulan);
    }
}
