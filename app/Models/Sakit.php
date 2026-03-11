<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sakit extends Model
{
    protected $table = 'sakit';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'keterangan',
        'status'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class,'karyawan_id','id_karyawan');
    }
}