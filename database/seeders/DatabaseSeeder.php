<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan FK sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /* =====================
         * SEEDER USERS
         * ===================== */
        DB::table('users')->insert([
            [
                'username'     => 'hrd',
                'nama'         => 'HRD',
                'password'     => Hash::make('hrd123'),
                'role'         => 'hrd',
                'status_akun'  => 'aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'username'     => 'karyawan',
                'nama'         => 'User Karyawan',
                'password'     => Hash::make('karyawan123'),
                'role'         => 'karyawan',
                'status_akun'  => 'aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
             [
                'username'     => 'finance',
                'nama'         => 'Administrator Finance',
                'password'     => Hash::make('finance123'),
                'role'         => 'finance',
                'status_akun'  => 'aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'username'     => 'manager',
                'nama'         => 'Manager',
                'password'     => Hash::make('manager123'),
                'role'         => 'manager',
                'status_akun'  => 'aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        /* =====================
         * SEEDER DIVISI
         * ===================== */
        DB::table('divisi')->insert([
            // ['id_divisi' => 1, 'nama_divisi' => 'HRD'],
            ['id_divisi' => 2, 'nama_divisi' => 'Keuangan'],
            ['id_divisi' => 3, 'nama_divisi' => 'IT'],
        ]);

        /* =====================
         * SEEDER JABATAN
         * ===================== */
        DB::table('jabatan')->insert([
            // [
            //     'id_jabatan' => 1,
            //     'nama_jabatan' => 'Staff HRD',
            //     'gaji_pokok' => 4000000,
            //     'id_divisi' => 1,
            // ],
            [
                'id_jabatan' => 2,
                'nama_jabatan' => 'Staff Keuangan',
                'gaji_pokok' => 4500000,
                'id_divisi' => 2,
            ],
            [
                'id_jabatan' => 3,
                'nama_jabatan' => 'Programmer',
                'gaji_pokok' => 6000000,
                'id_divisi' => 3,
            ],
        ]);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
