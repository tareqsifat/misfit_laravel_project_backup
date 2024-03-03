<?php

namespace Database\Seeders;

use App\Models\CompanyProfile\Company;
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
        $this->call(CompanySeeder::class);
        $this->call(JobSeeder::class);
    }
}
