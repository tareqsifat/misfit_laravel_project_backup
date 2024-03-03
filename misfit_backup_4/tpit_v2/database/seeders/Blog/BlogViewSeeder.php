<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogViews;
use Illuminate\Database\Seeder;

class BlogViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogViews::truncate();
        BlogViews::create([
               'blog_id'=>'1',
               'device_ip'=>'123097',
              
        ]);
    }
}
