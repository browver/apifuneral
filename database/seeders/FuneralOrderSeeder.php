<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FuneralOrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('funeral_orders')->insert([
            [
                'user_id' => 1,
                'plot_id' => 1,
                'service_id' => 1,
                'order_date' => Carbon::now(),
                'status' => 'REQUESTED',
            ],
            [
                'user_id' => 2,
                'plot_id' => 2,
                'service_id' => 2,
                'order_date' => Carbon::now()->subDays(1),
                'status' => 'APPROVED',
            ],
            [
                'user_id' => 3,
                'plot_id' => 1,
                'service_id' => 2,
                'order_date' => Carbon::now()->subDays(2),
                'status' => 'COMPLETED',
            ],
        ]);
    }
}
