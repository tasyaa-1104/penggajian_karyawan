<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    protected $table = 'liburs';
    protected $fillable = [
        'tanggal',
        'keterangan'
    ];
    
    protected $casts = [
        'tanggal' => 'date'
    ];
}
