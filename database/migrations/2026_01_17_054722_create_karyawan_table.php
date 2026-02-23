<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('nik')->unique();
            $table->string('nama_karyawan');

            $table->unsignedBigInteger('id_divisi');
            $table->unsignedBigInteger('id_jabatan');
            $table->decimal('gaji_pokok', 15, 2);

            // TETAP pakai id_user (tidak dikurangi)
            $table->unsignedBigInteger('id_user')->nullable();

            // Kolom tanggal masuk karyawan
            $table->date('tanggal_masuk')->default(DB::raw('CURRENT_DATE'));

            $table->enum('status_karyawan', ['aktif', 'nonaktif']);
            $table->timestamps();

            // FK ke divisi
            $table->foreign('id_divisi')
                ->references('id_divisi')
                ->on('divisi')
                ->onDelete('cascade');

            // FK ke jabatan
            $table->foreign('id_jabatan')
                ->references('id_jabatan')
                ->on('jabatan')
                ->onDelete('cascade');

            // 🔥 PERBAIKAN DI SINI
            // users TIDAK punya id_user → pakai id
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
