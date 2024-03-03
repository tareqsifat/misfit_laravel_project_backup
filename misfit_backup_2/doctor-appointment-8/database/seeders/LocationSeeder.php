<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample locations
        $locations = [
            [
                'name' => 'Location 1',
                'address' => 'Address 1',
                'status' => '1',
            ],
            [
                'name' => 'Location 2',
                'address' => 'Address 2',
                'status' => '1',
            ],
            // Add more locations as needed
        ];

        // Insert locations into the database
        foreach ($locations as $locationData) {
            Location::create($locationData);
        }
    }
}
