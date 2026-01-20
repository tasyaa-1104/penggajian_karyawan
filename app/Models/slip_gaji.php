<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slip_gaji extends Model
{
    protected $table = 'slip_gaji';
    protected $primaryKey = 'id_slip';

    protected $fillable = [
        'id_gaji',
        'tanggal_cetak',
        'file_slip'
    ];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'id_gaji');
    }
}
