<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji'; // 🔥 INI YANG PENTING

    protected $primaryKey = 'id_gaji'; // jika PK bukan id

    protected $fillable = [
        'id_karyawan',
        'bulan',
        'total_tunjangan',
        'total_potongan',
        'gaji_bersih',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
