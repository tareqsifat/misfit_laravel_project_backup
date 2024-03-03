<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseInstructors;
use Illuminate\Database\Seeder;

class CourseInstructorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     *
     */
    public function run()
    {
        CourseInstructors::truncate();
        CourseInstructors::create([
            'user_id' => 1,
            'course_id' =>1 ,
            'full_name' => 'মুহাম্মদ সিফাতুল্লাহ',
            'designation' => 'ওয়েব ডিজাইন ও ডেভোলাপার',
            'cover_photo' =>'uplodes/course/trainer.png',
            'details' => 'দীর্ঘ ৭ বছরেরও বেশি সময় ধরে ওয়েব ডিজাইন ও ডেভোলাপম্যান্ট ট্রেইনার হিসেবে কর্মরত আছেন। এছাড়াও তিনি গত ৫ বছর ধরে Fiverr, Upwork ও Freelancer.com এ সফলতার সাথে ফ্রিলান্সিং করে আসছেন, ও ৩০০+ প্রজেক্ট সম্পন্ন করিয়েছেন

            তিনি ৫০০+ স্টুডেন্টকে ট্রেনিং করিয়েছেন, যারা বর্তমানে বাংলাদেশের বিভিন্ন স্বনামধন্য প্রতিষ্ঠানে কর্মরত আছেন।',
        ]);

        CourseInstructors::create([
                'user_id' => 2,
                'course_id' => 1,
                'full_name' => 'মুহাম্মদ সাজিদুল ইসলাম',
                'designation' => 'ওয়েব ডিজাইন ও ডেভোলাপার',
                'cover_photo' =>'uplodes/course/trainer.png',
                'details' =>'৩ বছরেরও বেশি সময় ধরে ওয়েব ডিজাইন ও ডেভোলাপম্যান্ট ট্রেইনার হিসেবে কর্মরত আছেন। এছাড়াও তিনি গত ২ বছর ধরে Fiverr, Upwork ও Freelancer.com এ সফলতার সাথে ফ্রিলান্সিং করে আসছেন, ও ১০০+ প্রজেক্ট সম্পন্ন করিয়েছেন
                             তিনি ১০০+ স্টুডেন্টকে ট্রেনিং করিয়েছেন, যারা বর্তমানে বাংলাদেশের বিভিন্ন স্বনামধন্য প্রতিষ্ঠানে কর্মরত আছেন।',
            ]);

    }
}
