<?php

namespace Database\Seeders;

use App\Models\NewsEvent;
use Illuminate\Database\Seeder;

class NewsEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsEvent::truncate();
        NewsEvent::factory()->count(10)->create();
    }
}
