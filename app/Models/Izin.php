<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = 'izin';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'alasan',
        'status'
    ];

   public function karyawan()
{
    return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
}
}