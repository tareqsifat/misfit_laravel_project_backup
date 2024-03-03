<?php

namespace Database\Seeders\CRM;

use App\Models\CRM\CrmCommunicatoinTopic;
use Illuminate\Database\Seeder;

class CrmTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrmCommunicatoinTopic::truncate();
        $topic = new CrmCommunicatoinTopic();
        $topic->title = "Admission";
        $topic->save();

        $topic = new CrmCommunicatoinTopic();
        $topic->title = "Monthly fee";
        $topic->save();

        $topic = new CrmCommunicatoinTopic();
        $topic->title = "Feedback";
        $topic->save();

        $topic = new CrmCommunicatoinTopic();
        $topic->title = "Customer support";
        $topic->save();

        $topic = new CrmCommunicatoinTopic();
        $topic->title = "Result";
        $topic->save();
    }
}
