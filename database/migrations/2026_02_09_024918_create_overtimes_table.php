<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();

            // Relasi ke karyawan
            $table->unsignedBigInteger('karyawan_id');
            $table->date('tanggal');

            // 🔥 DIISI OTOMATIS DARI ABSENSI (BUKAN INPUT MANUAL)
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();

            // Hasil perhitungan
            $table->decimal('total_jam', 5, 2)->default(0);
            $table->decimal('tarif_per_jam', 12, 2)->default(0);
            $table->decimal('total_upah', 12, 2)->default(0);

            // Sumber & status
            $table->enum('sumber', ['absensi', 'manual'])->default('absensi');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();

            // 🔥 FK FINAL (WAJIB COCOK)
            $table->foreign('karyawan_id')
                ->references('id_karyawan')
                ->on('karyawan')
                ->onDelete('cascade');

            // 🔥 CEGAH DOUBLE LEMBUR HARI YANG SAMA
            $table->unique(['karyawan_id', 'tanggal', 'sumber']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
