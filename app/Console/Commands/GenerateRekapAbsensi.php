<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\rekap_absensiController;

class GenerateRekapAbsensi extends Command
{
    protected $signature = 'rekap:generate';
    protected $description = 'Generate rekap absensi otomatis';

    public function handle()
    {
        app(rekap_absensiController::class)
            ->generateRekap(now()->format('Y-m'));

        $this->info('Rekap absensi berhasil digenerate');
    }
}
