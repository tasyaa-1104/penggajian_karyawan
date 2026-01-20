<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';

    protected $fillable = [
        'nama_divisi',
    ];

    // relasi ke karyawan
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_divisi', 'id_divisi');
    }
}
