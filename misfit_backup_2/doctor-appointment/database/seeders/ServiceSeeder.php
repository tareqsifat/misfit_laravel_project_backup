<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'Ear Care',
                'description' => 'take care of your ear',
                'image' => '1684840104.png',
                'ranking' => 1,
                'status' => 1,
                'created_at' => '2023-05-23 11:08:24',
                'updated_at' => '2023-05-23 11:08:24',
            ],
            [
                'title' => 'Health Care',
                'description' => 'take care of your health',
                'image' => '1684840048.png',
                'ranking' => 2,
                'status' => 1,
                'created_at' => '2023-05-23 11:07:29',
                'updated_at' => '2023-05-23 11:07:29',
            ],
            [
                'title' => 'Eye Care',
                'description' => 'take care of your eyes',
                'image' => '1684839871.png',
                'ranking' => 3,
                'status' => 1,
                'created_at' => '2023-05-23 11:04:32',
                'updated_at' => '2023-05-23 11:04:32',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
