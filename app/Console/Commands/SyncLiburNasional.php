<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Libur;

class SyncLiburNasional extends Command
{
    protected $signature = 'sync:libur';
    protected $description = 'Sync libur nasional Indonesia';

    public function handle()
{
    $response = Http::get('https://libur.deno.dev/api');

    if (!$response->successful()) {
        $this->error('❌ Gagal ambil data libur');
        return;
    }

    $data = $response->json();
    $count = 0;

    foreach ($data as $item) {

        // validasi aman
        if (!isset($item['date'], $item['name'])) {
            continue;
        }

        \App\Models\Libur::updateOrCreate(
            ['tanggal' => $item['date']],
            ['keterangan' => $item['name']]
        );

        $count++;
    }

    $this->info("✅ Berhasil sync $count libur nasional");
}

}
