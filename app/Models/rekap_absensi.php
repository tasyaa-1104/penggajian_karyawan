<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rekap_absensi extends Model
{
    //
        use HasFactory;

     protected $table = 'rekap_absensi';
    protected $primaryKey = 'id_rekap';

    protected $fillable = [
        'id_karyawan',
        'bulan',
        'jumlah_hadir',
        'jumlah_izin',
        'jumlah_sakit',
        'jumlah_alpha'
    ];

    public function karyawan()
    {
         return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

}
