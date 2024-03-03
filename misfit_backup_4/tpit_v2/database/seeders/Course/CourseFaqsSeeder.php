<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseFaqs;
use Illuminate\Database\Seeder;

class CourseFaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseFaqs::truncate();
        CourseFaqs::create([
            'course_id' => 1,
            'title' => 'আপনাদের এখানে ইন্টার্নের সুজোগ আছে?',
            'description' =>'আমরা সকল ক্লাসের রেকর্ডেড ভিডিও সরবরাহ করি, আপনি আপনার স্টুডেন্ট পোর্টাল থেকে আপনার কোর্সের সকল ক্লাসের রেকর্ডেড ভিডিও পাবেন।'
        ]);

        CourseFaqs::create([
            'course_id' => 2,
            'title' => 'অনলাইন/অফলাইন ক্লাসের রেকর্ডেড ভিডিও পাওয়া যায়?',
            'description' =>'আমরা সকল ক্লাসের রেকর্ডেড ভিডিও সরবরাহ করি, আপনি আপনার স্টুডেন্ট পোর্টাল থেকে আপনার কোর্সের সকল ক্লাসের রেকর্ডেড ভিডিও পাবেন।'
        ]);

        CourseFaqs::create([
            'course_id' => 2,
            'title' => 'একাধিক স্কিমে পেমেন্ট করার সুজোগ আছে কি?',
            'description' =>'আমরা সকল ক্লাসের রেকর্ডেড ভিডিও সরবরাহ করি, আপনি আপনার স্টুডেন্ট পোর্টাল থেকে আপনার কোর্সের সকল ক্লাসের রেকর্ডেড ভিডিও পাবেন।'
        ]);
    }
}
