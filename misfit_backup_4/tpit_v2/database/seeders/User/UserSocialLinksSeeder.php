<?php

namespace Database\Seeders\User;

use App\Models\User\UserSocialLinks;
use Illuminate\Database\Seeder;

class UserSocialLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSocialLinks::truncate();
        UserSocialLinks::create([
            'user_id' => 1,
            'media_name' => 'facebook',
            'link' => 'https://www.facebook.com',

        ]);

        UserSocialLinks::create([
            'user_id' => 1,
            'media_name' => 'twitter',
            'link' => 'https://twitter.com',
        ]);
        UserSocialLinks::create([
            'user_id' => 1,
            'media_name' => 'linkedin',
            'link' => 'https://www.linkedin.com',
        ]);
        UserSocialLinks::create([
            'user_id' => 1,
            'media_name' => 'instagram',
            'link' => 'https://www.instagram.com/',
        ]);
    }
}
