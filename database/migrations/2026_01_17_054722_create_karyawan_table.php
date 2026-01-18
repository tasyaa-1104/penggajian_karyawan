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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('nik')->unique();
            $table->string('nama_karyawan');
            $table->unsignedBigInteger('id_divisi');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->enum('status_karyawan', ['aktif', 'nonaktif']);
            $table->timestamps();

            $table->foreign('id_divisi')
                ->references('id_divisi')
                ->on('divisi')
                ->onDelete('cascade');

            $table->foreign('id_jabatan')
                ->references('id_jabatan')
                ->on('jabatan')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
