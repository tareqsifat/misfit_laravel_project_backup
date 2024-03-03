<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [
            [
                'title' => 'শিশুদের জন্মগত পায়ের ত্রুটি এবং শিশুদের জন্মগত পা...',
                'subtitle' => 'শিশুদের জন্মগত পায়ের ত্রুটি এবং শিশুদের জন্মগত পা...',
                'description' => '<p><span style="color: rgb(85, 90, 100); font-fami...</p>',
                'status' => '1',
                'image' => '1684841081.jpg',
                'created_at' => '2023-05-23 11:24:41',
                'updated_at' => '2023-05-23 11:24:41',
            ],
            [
                'title' => 'হাত-পায়ের তালু ঘামাঃ কারণ ও প্রতিকার। ডা.মোঃ মুরাদ...',
                'subtitle' => 'অনেকেই আছেন যাদের হাতের তালু অতিরিক্ত পরিমাণ ঘামে।',
                'description' => '<p xss="removed" style="color: rgb(85, 90, 100); f...</p>',
                'status' => '1',
                'image' => '1684841162.jpg',
                'created_at' => '2023-05-23 11:26:02',
                'updated_at' => '2023-05-23 11:26:02',
            ],

        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
