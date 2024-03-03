<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::truncate();
        UserType::create([
            'name' => 'Manager',
        ]);
        UserType::create([
            'name' => 'Teammate',
        ]);
    }
}
