<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
            'name' => 'Business Automation Manager',
            'user_type_id' => 1,
            'email' => 'manager@business.com',
            'email_verified_at' => now(),
            'employee_id' => 'BA-1001',
            'password' => Hash::make('@Pass12345'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Jon Doe',
            'user_type_id' => 2,
            'email' => 'jhon@email.com',
            'email_verified_at' => now(),
            'employee_id' => 'BA-2002',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

    }
}
