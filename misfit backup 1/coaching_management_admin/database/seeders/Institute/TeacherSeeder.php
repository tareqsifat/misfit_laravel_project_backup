<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteTeacher;
use App\Models\User;
use App\Models\UserSalary;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteTeacher::truncate();
        DB::table('institute_class_batch_institute_teacher')->truncate();
        DB::table('institute_branch_institute_teacher')->truncate();
        $branchArray = [1,2,3,4,5,6,7,8];
        $designation = ['Assistant teacher', 'Senior Teacher', 'Bangla teacher', 'English Teacher', 'Science Teacher', 'Commerce Teacher'];
        for ($i=23; $i <28 ; $i++) { 
            $institute_teacher = new InstituteTeacher();
            $institute_teacher->user_id = $i;
            $institute_teacher->education = "BSC";
            $institute_teacher->hire_date = Carbon::now()->subMonth($i-1);
            $institute_teacher->creator = 1;
            $institute_teacher->slug = Str::random(5);
            $user = User::find($i);
            $user->designation = Arr::random($designation);
            // $user->salary = $i . "500";
            $institute_teacher->status = 1;
            $institute_teacher->save();
            $institute_teacher->batch()->attach([7]);
            $institute_teacher->branch()->attach([2]);
            // dd($institute_teacher->branch);
            $slug = $institute_teacher->branch[0]->name . " " . $i;
            $user->branch_code = Str::slug($slug, '-');
            $user->save();
            $user_salary = new UserSalary();
            $user_salary->user_id = $user->id;
            $user_salary->branch_id = $institute_teacher->branch[0]->id;
            $salary =  $i . "500";
            $user_salary->salary =  floatval($salary);
            $user_salary->save();
            $institute_teacher->save();
            
        }
        

    }
}
