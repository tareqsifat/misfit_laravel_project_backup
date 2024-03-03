<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteStudent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteStudent::truncate();
        DB::table('institute_class_batch_institute_student')->truncate();
        DB::table('institute_branch_institute_student')->truncate();
        $branchArray = [1,2,3,4,5,6,7,8];
        for ($i=7; $i <23 ; $i++) { 
            
            $student = new InstituteStudent();
            $student->user_id = $i;
            $student->admission_date = Carbon::now()->subDays(1);
            $student->creator = 1;
            $student->slug = Str::random(10);
            $student->status = 1;
            $student->save();
            $student->institute_class_batches()->attach([Arr::random($branchArray)]);
            $student->branch()->attach([2]);
            $user = User::find($i);
            // dd($student->branch);
            $slug = $student->branch[0]->name . " " . $i;
            // dd(Str::slug($slug, '-'));
            $user->branch_code = Str::slug($slug, '-');
            $user->save();
            $student->save();
        }

    }
}
