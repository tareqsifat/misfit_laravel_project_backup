<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogTags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogTags::truncate();
        BlogTags::create([
               'title'=>'Master Python',
               
            ]);

            BlogTags::create([
                'title'=>'Become a Programmer',
                
             ]);

             DB::table('blog_blog_tag')->truncate();
             DB::table('blog_blog_tag')->insert([
                 'blog_id' => 1,
                 'blog_tag_id' => 1,
             ]);
    }
}
