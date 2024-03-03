<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert super admin role if it doesn't exist
        if (DB::table('roles')->where('role', 'super admin')->doesntExist()) {
            DB::table('roles')->insert([
                'role' => 'super admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert admin role if it doesn't exist
        if (DB::table('roles')->where('role', 'admin')->doesntExist()) {
            DB::table('roles')->insert([
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert moderator role if it doesn't exist
        if (DB::table('roles')->where('role', 'moderator')->doesntExist()) {
            DB::table('roles')->insert([
                'role' => 'moderator',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
