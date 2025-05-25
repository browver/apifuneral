<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CemeteryPlotSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cemetery_models')->insert([
            ['plot_number' => 'A101', 'class_id' => 1, 'area_sqm' => 4, 'is_available' => true, 'location' => 'Blok A'],
            ['plot_number' => 'B202', 'class_id' => 2, 'area_sqm' => 3, 'is_available' => true, 'location' => 'Blok B'],
            ['plot_number' => 'C303', 'class_id' => 3, 'area_sqm' => 2, 'is_available' => true, 'location' => 'Blok C'],
        ]);
    }
}
