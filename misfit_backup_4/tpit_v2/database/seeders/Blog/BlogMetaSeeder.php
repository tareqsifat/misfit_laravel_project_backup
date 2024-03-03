<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogMeta;
use Illuminate\Database\Seeder;

class BlogMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogMeta::truncate();
        BlogMeta::create([
               'blog_id'=>'1',
               'title'=>'Learn and Master Python in a Month',
               'description'=>'Remember, one month has plenty of time. If you can spend 6–7hours every day. You will finish much more than you think.',
               'keywords'=>'Master,Learn,Python',
               'image' => 'uplodes/blog/babr.png',
               'image_alter_text'=>'Learn and Master Python in a Month',
               'image_title'=>'tarek.jpg',

          ]);
    }
}
