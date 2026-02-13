<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $table = 'overtimes';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_jam',
        'tarif_per_jam',
        'total_upah',
        'sumber',
        'status'
    ];

    protected $casts = [
        'tanggal'       => 'date',
        'total_jam'     => 'decimal:2',
        'tarif_per_jam' => 'decimal:2',
        'total_upah'    => 'decimal:2',
    ];

    /**
     * 🔥 Relasi ke karyawan
     */
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
    }
    public function absensi()
{
    return $this->belongsTo(Absensi::class, 'id_absensi');
}

}
