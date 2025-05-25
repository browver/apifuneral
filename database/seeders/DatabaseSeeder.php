<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'fullname' => 'Test Fullname',
            'password' => bcrypt('Password'),
            'email' => 'test@example.com',
            'phone' => '12345',
        ]);
        
        $this->call([
            UserSeeder::class,
            PlotModelSeeder::class,
            ServiceModelSeeder::class,
            CemeteryPlotSeeder::class,
            PlotPurchasesSeeder::class,
            FuneralOrderSeeder::class,
            MaintenanceModelSeeder::class,
            MaintenanceOrderSeeder::class,
        ]);
    }
}
