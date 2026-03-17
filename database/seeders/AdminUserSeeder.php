<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'last_name' => 'Dashboard',
                'phone' => '0000000000',
                'account_type' => 'Agency',
                'password' => Hash::make('123456789'),
            ]
        );
    }
}