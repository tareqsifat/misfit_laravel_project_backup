<?php

namespace Database\Seeders;

use App\Models\UserManagement\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (UserType::count() <= 0) {
            $now = Carbon::now();

            $user_types = [
                [
                    'user_type_name' => 'admin',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'user_type_name' => 'employer',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'user_type_name' => 'seeker',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ];
            UserType::insert($user_types);
        }
    }
}
