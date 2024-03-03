<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
            DB::table('testimonials')->insert([
                [
                    'title' => 'MD Atique',
                    'subtitle' => 'Marketing Officer',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'image' => 'dummy.jpg',
                ],
                [
                    'title' => 'MD Rifat',
                    'subtitle' => 'developer',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'image' => 'dummy.jpg',
                ],
                [
                    'title' => 'MD Jamal',
                    'subtitle' => 'patient',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'image' => 'dummy.jpg',
                ],
            ]);
        }
}