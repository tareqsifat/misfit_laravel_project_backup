<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        $settings = new Setting();
        $settings->title = 'invoice_name';
        $settings->value = 'Central';
        $settings->save();

        $settings = new Setting();
        $settings->title = 'invoice_address';
        $settings->value = 'Bangla motor, Dhaka';
        $settings->save();

        $settings = new Setting();
        $settings->title = 'invoice_email';
        $settings->value = 'central@gmail.com';
        $settings->save();

        $settings = new Setting();
        $settings->title = 'invoice_mobile_number';
        $settings->value = '01234567890';
        $settings->save();

        $settings = new Setting();
        $settings->title = 'site_mobile_number';
        $settings->value = '01234567890';
        $settings->save();

        $settings = new Setting();
        $settings->title = 'site_email';
        $settings->value = 'abc@gmail.com';
        $settings->save();

        $settings = new Setting();
        $settings->title = 'site_logo';
        $settings->value = 'test/Logo_coaching.png'; 
        $settings->status = 0;
        $settings->save();
    }
}
