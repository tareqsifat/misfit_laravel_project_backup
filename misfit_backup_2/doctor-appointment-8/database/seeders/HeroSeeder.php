<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $heroes = [
            [

                'image' => '1685016129.jpg',
                'status' => 1,
                'created_at' => '2023-05-24 23:02:10',
                'updated_at' => '2023-05-24 23:02:10',
            ],
            [

                'image' => '1685016160.jpg',
                'status' => 1,
                'created_at' => '2023-05-24 23:02:41',
                'updated_at' => '2023-05-24 23:02:41',
            ],
        ];

        foreach ($heroes as $hero) {
            Hero::create($hero);
        }
    }
}
