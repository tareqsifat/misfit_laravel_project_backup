<?php

namespace Database\Seeders;

use App\Models\Availability;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Availability::create([
            'location' => '1',
            'time' => '9:00 AM - 5:00 PM',
            'status' => '1',
            'date' => '2023-05-20',
        ]);

        Availability::create([
            'location' => '2',
            'time' => '10:00 AM - 6:00 PM',
            'status' => '1',
            'date' => '2023-05-21',
        ]);
    }
}
