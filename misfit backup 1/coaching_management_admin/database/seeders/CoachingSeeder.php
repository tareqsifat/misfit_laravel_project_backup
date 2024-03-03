<?php

namespace Database\Seeders;

use Database\Seeders\Accounts\AccountSeeder;
use Database\Seeders\CRM\CrmCallSeeder;
use Database\Seeders\CRM\CrmSmsSeeder;
use Database\Seeders\CRM\CrmTemplateSeeder;
use Database\Seeders\CRM\CrmTopicSeeder;
use Database\Seeders\Institute\BatchExamMarkSeeder;
use Database\Seeders\Institute\BatchExamSeeder;
use Database\Seeders\Institute\ClassBatchSeeder;
use Database\Seeders\Institute\ClassBatchTimeScheduleSeeder;
use Database\Seeders\Institute\ClassSeeder;
use Database\Seeders\Institute\InstituteClassSubjectSeeder;
use Database\Seeders\Institute\StudentPaymentSeeder;
use Database\Seeders\Institute\StudentSeeder;
use Database\Seeders\Institute\TeacherSeeder;
use Database\Seeders\Notification\NotificationSeeder;
use Database\Seeders\Customer\CustomerSeeder;
use Illuminate\Database\Seeder;

class CoachingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BranchSeeder::class,
            UserSeeder::class,
            ContactMessageSeeder::class,
            AssetCategorySeeder::class,
            AssetShopSeeder::class,
            BranchAssetSeeder::class,
            AccountSeeder::class,
            NotificationSeeder::class,
            ProductSeeder::class,
            CrmCallSeeder::class,
            CrmSmsSeeder::class,
            CrmTemplateSeeder::class,
            CrmTopicSeeder::class,
            ClassBatchSeeder::class,
            ClassSeeder::class,
            StudentPaymentSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            BatchExamSeeder::class,
            BatchExamMarkSeeder::class,
            InstituteClassSubjectSeeder::class,
            ClassBatchTimeScheduleSeeder::class,
            CustomerSeeder::class,
            NoticeSeeder::class,
            NewsEventSeeder::class,
            SettingsSeeder::class,
            BannerSeeder::class,
            LeaveApplicationSeeder::class,
            BreakingNewsSeeder::class
        ]);
    }
}
