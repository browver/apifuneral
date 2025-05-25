<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlotPurchasesModel;
use Illuminate\Support\Carbon;

class PlotPurchasesSeeder extends Seeder
{
    public function run(): void
    {
        PlotPurchasesModel::create([
            'user_id' => 1,
            'plot_id' => 1,
            'purchase_date' => Carbon::now(),
            'payment_status' => 'PENDING',
        ]);

        PlotPurchasesModel::create([
            'user_id' => 2,
            'plot_id' => 2,
            'purchase_date' => Carbon::now(),
            'payment_status' => 'PENDING',
        ]);

        PlotPurchasesModel::create([
            'user_id' => 3,
            'plot_id' => 3,
            'purchase_date' => Carbon::now(),
            'payment_status' => 'PENDING',
        ]);
    }
}
