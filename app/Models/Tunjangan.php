<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    protected $table = 'tunjangan';
    protected $primaryKey = 'id_tunjangan';

    protected $fillable = [
        'nama_tunjangan',
        'nominal'
    ];
    public function karyawan()
{
    return $this->belongsToMany(
        Karyawan::class,
        'karyawan_tunjangan',
        'id_tunjangan',
        'id_karyawan'
    );
}
}

