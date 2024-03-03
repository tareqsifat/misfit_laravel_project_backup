<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;


class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Doctor::create([
            'name' => 'Dr. John Li',
            'user_id' => '3',
            'email' => 'john.li@example.com',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'image' => 'user.jpg',
            'birthday' => '1985-09-20',
            'height' => '165',
            'weight' => '60',
            'gender' => 'male',
            'blood_group' => 'O+',
        ]);
    }
}
