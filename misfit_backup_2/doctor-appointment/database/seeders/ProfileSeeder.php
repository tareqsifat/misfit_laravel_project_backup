<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        Profile::create([
            'user_id' => '1',
            'image' => 'user.jpg',
            'birthday' => '1985-09-20',
            'height' => '165',
            'weight' => '60',
            'gender' => 'Female',
            'blood_group' => 'O+',
            'address' => '456 Elm St, Town',
        ]);
    }
}
