<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlotModelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plot_models')->insert([
            ['name' => 'Kelas A', 'description' => 'Luas besar, dekat pintu masuk', 'price_per_sqm' => 500000],
            ['name' => 'Kelas B', 'description' => 'Luas sedang', 'price_per_sqm' => 300000],
            ['name' => 'Kelas C', 'description' => 'Luas kecil, area belakang', 'price_per_sqm' => 150000],
        ]);
    }
}
