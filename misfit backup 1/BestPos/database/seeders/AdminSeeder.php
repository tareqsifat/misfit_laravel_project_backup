<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::where('email', 'admin@bestpos.com')->first();
        if(isset($admin)){
            return;
        }

        Admin::create([
            'role_id' => 1,
            'full_name' => 'Best Pos Admin',
            'user_name' => 'best_pos_admin',
            'email' => 'admin@bestpos.com',
            'password' => Hash::make('@Password12345'),
            'is_active' => 1
        ]);
    }
}
