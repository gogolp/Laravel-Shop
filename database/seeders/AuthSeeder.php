<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@bytebar.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password')
            ]
        );
    }
}
