<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $admin = [
            'name' => 'EuroStaffs Admin',
            'email' => getenv('ADMIN_EMAIL'),
            'password' => bcrypt(getenv('ADMIN_PASSWORD')),
            'created_at' => $now,
            'updated_at' => $now,
        ];
        Admin::create($admin);
    }
}
