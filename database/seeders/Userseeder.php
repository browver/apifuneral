<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'creator',
                'email' => 'creator@example.com',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'editor',
                'email' => 'editor@example.com',
                'password' => Hash::make('12345')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
