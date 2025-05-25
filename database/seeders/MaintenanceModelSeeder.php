<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceModelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('maintenance_models')->insert([
            ['name' => 'Perawatan Rumput', 'description' => 'Pangkas rumput rutin bulanan', 'price' => 150000],
            ['name' => 'Pembersihan Makam', 'description' => 'Pembersihan dan pengecatan nisan', 'price' => 250000],
        ]);
    }
}
