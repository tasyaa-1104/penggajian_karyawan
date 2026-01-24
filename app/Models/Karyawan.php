<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nik',
        'nama_karyawan',
        'id_divisi',
        'id_jabatan',
        'gaji_pokok',
        'id_user',
        'status_karyawan'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
