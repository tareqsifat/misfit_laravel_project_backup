<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::truncate();
        $banner = new Banner();
        $banner->image = "test/banner_img.webp";
        $banner->title = "We Are Committed To The";
        $banner->title_highlight = "Best Teaching";
        $banner->paragraph = "Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Fugiat Vero E 
        Xercitationem Doloribus Amet Odit Quis Minima Soluta Similique Eiu S A, At Pariatur Temporibus
        Alias Quis Minima Soluta Similique Eiu S A, At Pariatur Temporibus Alias.";
        $banner->link = "#course_area";
        $banner->save();    
    }
}
