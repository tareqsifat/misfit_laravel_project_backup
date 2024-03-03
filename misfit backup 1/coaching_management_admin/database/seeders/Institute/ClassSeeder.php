<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteClass::truncate();
        $class = new InstituteClass();
        $class->title = "Class Five";
        $class->branch_id = 2;
        $class->save();

        $class = new InstituteClass();
        $class->title = "Class Six";
        $class->branch_id = 2;
        $class->save();

        $class = new InstituteClass();
        $class->title = "Class Seven";
        $class->branch_id = 2;
        $class->save();

        $class = new InstituteClass();
        $class->title = "Class Eight";
        $class->branch_id = 2;
        $class->save();

        $class = new InstituteClass();
        $class->title = "Class Nine";
        $class->branch_id = 2;
        $class->save();

        $class = new InstituteClass();
        $class->title = "Class Ten";
        $class->branch_id = 2;
        $class->save();
    }
}
