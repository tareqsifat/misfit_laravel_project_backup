<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogCommentReplies;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCommentRepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCommentReplies::truncate();
        BlogCommentReplies::create([
               'comment'=>'thank you for comment',
        ]);

        DB::table('blog_comment_blog_comment_repliy')->truncate();
        DB::table('blog_comment_blog_comment_repliy')->insert([
            'blog_comment_id' => 1,
            'blog_comment_repliy_id' => 1,
        ]);
    }
}
