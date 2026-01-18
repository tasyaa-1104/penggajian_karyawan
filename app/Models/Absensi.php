<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    //
      use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_karyawan',
        'tanggal',
        'status_kehadiran',
        'keterangan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
