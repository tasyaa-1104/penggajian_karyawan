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

    $table->unsignedBigInteger('karyawan_id');
    $table->date('tanggal');
    $table->time('jam_mulai');
    $table->time('jam_selesai');
    $table->integer('total_jam');
    $table->decimal('tarif_per_jam', 12, 2);
    $table->decimal('total_upah', 12, 2);
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

    $table->timestamps();

    // 🔥 FK YANG BENAR
    $table->foreign('karyawan_id')
        ->references('id_karyawan')
        ->on('karyawan')
        ->onDelete('cascade');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
