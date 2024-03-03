<?php

namespace Database\Seeders\CRM;

use App\Models\CRM\CrmCallHistory;
use Illuminate\Database\Seeder;

class CrmCallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrmCallHistory::truncate();
        $crm_call = new CrmCallHistory();
        $crm_call->topic_id = 1;
        $crm_call->customer_id = 1;
        $crm_call->feedback = "positive";
        $crm_call->save();

        $crm_call = new CrmCallHistory();
        $crm_call->topic_id = 2;
        $crm_call->customer_id = 2;
        $crm_call->feedback = "confirm";
        $crm_call->save();

        $crm_call = new CrmCallHistory();
        $crm_call->topic_id = 3;
        $crm_call->customer_id = 3;
        $crm_call->feedback = "improve the classroom facility";
        $crm_call->save();

        $crm_call = new CrmCallHistory();
        $crm_call->topic_id = 4;
        $crm_call->customer_id = 4;
        $crm_call->feedback = "Satisfied";
        $crm_call->save();
    }
}
