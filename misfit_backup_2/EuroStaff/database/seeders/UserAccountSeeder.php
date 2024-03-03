<?php

namespace Database\Seeders;

use App\Models\UserManagement\UserAccount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (UserAccount::count() <= 0) {
            $now = Carbon::now();

            $user_types = [
                [
                    'user_type_id' => 1,
                    'email' => env('ADMIN_EMAIL'),
                    'password' => bcrypt(env('ADMIN_PASSWORD')),
                    'date_of_birth' => date('1985-06-20'),
                    'gender' => 'Male',
                    'is_active' => 1,
                    'contact_number' => env('ADMIN_CONTACT'),
                    'registration_date' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ];

            UserAccount::insert($user_types);
        }
    }
}
