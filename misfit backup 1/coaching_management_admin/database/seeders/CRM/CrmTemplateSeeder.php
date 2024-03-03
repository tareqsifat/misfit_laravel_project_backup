<?php

namespace Database\Seeders\CRM;

use App\Models\CRM\CrmSmsHistory;
use App\Models\CRM\CrmSmsTemplate;
use Illuminate\Database\Seeder;

class CrmTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrmSmsTemplate::truncate();
        $sms_template = new CrmSmsTemplate();
        $sms_template->schema = "Dear student, Improve your English by admit into our interactive english course. click the link below, to get started";
        $sms_template->branch_id = 1;
        $sms_template->save();

        $sms_template = new CrmSmsTemplate();
        $sms_template->schema = "Dear student, Please pay your monthly due for your ssc batch";
        $sms_template->branch_id = 1;
        $sms_template->save();

        $sms_template = new CrmSmsTemplate();
        $sms_template->schema = "Dear student, Please let us know how we can improve our service";
        $sms_template->branch_id = 2;
        $sms_template->save();

        $sms_template = new CrmSmsTemplate();
        $sms_template->schema = "Dear student, Your result for the daily model test is: ";
        $sms_template->branch_id = 3;
        $sms_template->save();
    }
}
