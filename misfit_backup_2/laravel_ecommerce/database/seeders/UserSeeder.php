<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate(); 

        $user = new User();
        $user -> role_id = 1;
        $user-> first_name = 'Mr super';
        $user-> last_name = 'admin';
        $user-> username = 'super_user';
        $user-> photo = 'avatar.jpg';
        $user-> phone = '987654321';
        $user-> email = 'super_admin@gwebsite.com';
        $user-> password = Hash::make('12345678');
        $user-> slug = 'super_user';
        $user-> created_at = Carbon::now() -> toDateString();
        $user-> save();

        $user = new User();
        $user -> role_id = 2;
        $user-> first_name = 'Mr vua';
        $user-> last_name = 'admin';
        $user-> username = 'admin';
        $user-> photo = 'avatar.jpg';
        $user-> phone = '987654321';
        $user-> email = 'admin@gwebsite.com';
        $user-> password = Hash::make('12345678');
        $user-> slug = 'admin';
        $user-> created_at = Carbon::now() -> toDateString();
        $user-> save();

        $user = new User();
        $user -> role_id = 3;
        $user-> first_name = 'Mr vua';
        $user-> last_name = 'moderator';
        $user-> username = 'moderator';
        $user-> photo = 'avatar.jpg';
        $user-> phone = '987654321';
        $user-> email = 'moderator@gwebsite.com';
        $user-> password = Hash::make('12345678');
        $user-> slug = 'moderator';
        $user-> created_at = Carbon::now() -> toDateString();
        $user-> save();

        $user = new User();
        $user -> role_id = 4;
        $user-> first_name = 'Mr vua';
        $user-> last_name = 'user';
        $user-> username = 'user';
        $user-> photo = 'avatar.jpg';
        $user-> phone = '987654321';
        $user-> email = 'user@gwebsite.com';
        $user-> password = Hash::make('12345678');
        $user-> slug = 'user';
        $user-> created_at = Carbon::now() -> toDateString();
        $user-> save();

        $user = new User();
        $user -> role_id = 5;
        $user-> first_name = 'Mr vua';
        $user-> last_name = 'subscriber';
        $user-> username = 'subscriber';
        $user-> photo = 'avatar.jpg';
        $user-> phone = '987654321';
        $user-> email = 'subscriber@gwebsite.com';
        $user-> password = Hash::make('12345678');
        $user-> slug = 'subscriber';
        $user-> created_at = Carbon::now() -> toDateString();
        $user-> save();

        

        
        
    }
}
