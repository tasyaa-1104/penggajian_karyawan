<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel (opsional, tapi aman)
     */
    protected $table = 'users';

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'username',
        'nama',
        'password',
        'role',
        'status_akun',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_user');
    }

}
