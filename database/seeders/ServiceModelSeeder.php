<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceModelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('service_models')->insert([
            ['name' => 'Paket Pemakaman Sederhana', 'description' => 'Termasuk peti dan mobil jenazah', 'price' => 2000000],
            ['name' => 'Paket Lengkap', 'description' => 'Termasuk upacara, peti eksklusif, dan mobil VIP', 'price' => 5000000],
        ]);
    }
}
