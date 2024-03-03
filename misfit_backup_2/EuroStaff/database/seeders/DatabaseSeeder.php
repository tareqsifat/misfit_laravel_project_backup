<?php

namespace Database\Seeders;

use App\Models\UserManagement\UserAccount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTypeSeeder::class);
        $this->call(UserAccountSeeder::class);
    }
}
