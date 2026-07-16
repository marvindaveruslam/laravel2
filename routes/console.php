<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('report:send', function () {
    $this->info('Sedang mengirim laporan harian...');
    // Logika pengiriman email Anda di sini
    $this->comment('Laporan berhasil dikirim!');
})->purpose('Mengirim laporan harian ke admin');
