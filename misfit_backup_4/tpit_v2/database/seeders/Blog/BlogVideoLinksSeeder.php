<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogVideoLinks;
use Illuminate\Database\Seeder;

class BlogVideoLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogVideoLinks::truncate();
        BlogVideoLinks::create([
               'blog_id'=>'1',
               'video_link'=>'https://www.youtube.com/watch?v=nwDoyfxg9cM',
              
        ]);
    }
}
