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
       Schema::create('slip_gaji', function (Blueprint $table) {
            $table->id('id_slip');
            $table->unsignedBigInteger('id_gaji');
            $table->date('tanggal_cetak');
            $table->string('file_slip')->nullable();
            $table->timestamps();

            $table->foreign('id_gaji')
                ->references('id_gaji')
                ->on('gaji')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slip_gaji');
    }
};
