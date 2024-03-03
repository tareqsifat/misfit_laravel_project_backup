<?php

namespace Database\Seeders\CRM;

use App\Models\CRM\CrmSmsHistory;
use Illuminate\Database\Seeder;

class CrmSmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrmSmsHistory::truncate();
        $crm_sms = new CrmSmsHistory();
        $crm_sms->topic_id = 1;
        $crm_sms->customer_id = 1;
        $crm_sms->description = "Dear student, Improve your English by admit into our interactive english course. click the link below, to get started";
        $crm_sms->save();

        $crm_sms = new CrmSmsHistory();
        $crm_sms->topic_id = 2;
        $crm_sms->customer_id = 2;
        $crm_sms->description = "Dear student, Please pay your monthly due for your ssc batch";
        $crm_sms->save();

        $crm_sms = new CrmSmsHistory();
        $crm_sms->topic_id = 3;
        $crm_sms->customer_id = 3;
        $crm_sms->description = "Dear student, Please let us know how we can improve our service";
        $crm_sms->save();

        $crm_sms = new CrmSmsHistory();
        $crm_sms->topic_id = 4;
        $crm_sms->customer_id = 4;
        $crm_sms->description = "Dear student, Your result for the daily model test is: ";
        $crm_sms->save();
    }
}
