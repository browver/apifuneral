<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'fullname' => 'Admin Fullname',
                'phone' => '08123456789',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'creator',
                'fullname' => 'Creator Fullname',
                'phone' => '08123456789',
                'email' => 'creator@example.com',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'editor',
                'fullname' => 'Editor Fullname',
                'phone' => '08123456789',
                'email' => 'editor@example.com',
                'password' => Hash::make('12345')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
