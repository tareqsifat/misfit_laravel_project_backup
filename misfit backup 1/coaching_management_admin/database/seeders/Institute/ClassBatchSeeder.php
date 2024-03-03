<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteClassBatch;
use Illuminate\Database\Seeder;

class ClassBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteClassBatch::truncate();
        $batch = new InstituteClassBatch();
        $batch->name = "Shapla";
        $batch->branch_id = 2;
        $batch->institute_class_id = 1;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Beli";
        $batch->branch_id = 2;
        $batch->institute_class_id = 2;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Morning";
        $batch->branch_id = 2;
        $batch->institute_class_id = 3;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Evening";
        $batch->branch_id = 2;
        $batch->institute_class_id = 4;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Morning";
        $batch->branch_id = 2;
        $batch->institute_class_id = 5;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Evening";
        $batch->branch_id = 2;
        $batch->institute_class_id = 5;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Morning";
        $batch->branch_id = 2;
        $batch->institute_class_id = 6;
        $batch->save();

        $batch = new InstituteClassBatch();
        $batch->name = "Evening";
        $batch->branch_id = 2;
        $batch->institute_class_id = 6;
        $batch->save();
    }
}
