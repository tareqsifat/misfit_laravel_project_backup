<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $content = [
            'website_name' => 'Dr. John Doe',
            'website_intro' => 'Experienced Doctor',
            'website_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing...',
            'website_email' => 'johndoe@example.com',
            'website_phone' => '123-456-7890',
            'website_address' => '123 Main Street, City, Country',
            'about_content' => '<h4 class="title mb-4" style="font-family: Inter, sans-serif; letter-spacing: 0.5px; color: rgb(33, 37, 41); font-weight: 600 !important; line-height: 1.5 !important; font-size: 24px !important;">About Our Treatments</h4><p class="text-muted para-desc" style="line-height: 1.6; --bs-text-opacity: 1; max-width: 600px; font-family: Inter, sans-serif; font-size: 15px; color: rgb(132, 146, 166) !important;">Great doctor if you need your family member to get effective immediate assistance, examination, emergency treatment or a simple consultation. Thank you.</p><p class="text-muted para-desc mb-0" style="line-height: 1.6; --bs-text-opacity: 1; max-width: 600px; font-family: Inter, sans-serif; font-size: 15px; color: rgb(132, 146, 166) !important;">The most well-known dummy text is the , which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to Latin. It contains a series of real Latin words.</p>',
            'about_image' => '1684838861.png',
            'about_yt' => 'https:://youtube.com',
            'website_logo' => 'logo.png',
            'website_favicon' => 'favicon.ico',

            'whatsapp' => '#whatsapp',
            'facebook' => '#facebook',
            'linkdin' => '#linkdin',
            'youtube' => '#youtube',
            'created_at' => '2023-05-22 10:48:18',
            'updated_at' => '2023-05-23 10:47:41',
        ];

        Content::create($content);
    }
}
