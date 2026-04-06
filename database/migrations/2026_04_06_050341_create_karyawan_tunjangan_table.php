<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
Schema::create('karyawan_tunjangan', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('id_karyawan');
    $table->unsignedBigInteger('id_tunjangan');

    $table->timestamps();

    $table->foreign('id_karyawan')
        ->references('id_karyawan')
        ->on('karyawan')
        ->onDelete('cascade');

    $table->foreign('id_tunjangan')
        ->references('id_tunjangan')
        ->on('tunjangan')
        ->onDelete('cascade');
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_tunjangan');
    }
};
