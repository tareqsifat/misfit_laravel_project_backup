<?php

namespace Database\Seeders;

use App\Models\BranchAdmin;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use App\Models\UserSalary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::truncate();
        DB::table('user_user_role')->truncate();
        DB::table('user_user_permission')->truncate();
        DB::table('institute_branch_user')->truncate();
        DB::table('institute_branch_admin')->truncate();

        $user_role = new UserRole();
        $user_role->id = 10;
        $user_role->name = 'super_admin';
        $user_role->role_serial = 1;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->id = 20;
        $user_role->name = 'admin';
        $user_role->role_serial = 2;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->id = 30;
        $user_role->name = 'user';
        $user_role->role_serial = 3;
        $user_role->save();
        
        $user_role = new UserRole();
        $user_role->id = 40;
        $user_role->name = 'Teacher';
        $user_role->role_serial = 4;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->id = 50;
        $user_role->name = 'branch_admin';
        $user_role->role_serial = 5;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->id = 60;
        $user_role->name = 'Student';
        $user_role->role_serial = 6;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->id = 70;
        $user_role->name = 'Employee';
        $user_role->role_serial = 7;
        $user_role->save();

        UserPermission::truncate();

        $permission = new UserPermission();
        $user_role->id = 10;
        $permission->title = 'can_create';
        $permission->permission_serial = 1;
        $permission->save();

        $permission = new UserPermission();
        $user_role->id = 20;
        $permission->title = 'can_edit';
        $permission->permission_serial = 2;
        $permission->save();

        $permission = new UserPermission();
        $user_role->id = 30;
        $permission->title = 'can_delete';
        $permission->permission_serial = 3;
        $permission->save();

        User::truncate();

        // user id = 1
        $user = new User();
        $user->first_name = 'super';
        $user->last_name = 'admin';
        $user->user_name = 'super admin';
        $user->telegram_id = '812239513';
        // $user->role_id = 1;
        $user->mobile_number = '016123';
        $user->email = 'superadmin@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->roles()->attach([1,2,3]);
        $user->permissions()->attach([1,2,3]);
        

        $user = new User();
        $user->first_name = 'Branch';
        $user->last_name = 'admin';
        $user->user_name = 'branch admin';
        $user->telegram_id = '812239578';
        // $user->role_id = 1;
        $user->mobile_number = '01612987';
        $user->email = 'branchadmin@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->roles()->attach([5]);
        $user->permissions()->attach([1,2,3]);
        $branch_admin = new BranchAdmin();
        $branch_admin->user_id = $user->id;
        $branch_admin->institue_branch_id = 2;
        $branch_admin->save();
        $user->branch_user()->attach([2]);

        // user id = 2
        $user = new User();
        $user->first_name = 'mr';
        $user->last_name = 'admin';
        $user->user_name = 'admin';
        $user->telegram_id = '812239513';
        // $user->role_id = 2;
        $user->mobile_number = '016124';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->roles()->attach([2,5]);
        $user->permissions()->attach([1,2]);
        $branch_admin = new BranchAdmin();
        $branch_admin->user_id = $user->id;
        $branch_admin->institue_branch_id = 1;
        $branch_admin->save();
        $user->branch_user()->attach([2]);


        // user id = 3
        $user = new User();
        $user->first_name = 'mr';
        $user->last_name = 'user';
        $user->user_name = 'user';
        $user->telegram_id = '812239513';
        // $user->role_id = 3;
        $user->mobile_number = '016125';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->roles()->attach([3]);
        $user->permissions()->attach([1]);
        $user->branch_user()->attach([2]);

        // employee
        $user = new User();
        $user->first_name = 'mr';
        $user->last_name = 'employee';
        $user->user_name = 'employee1';
        $user->telegram_id = '453535837';
        // $user->role_id = 3;
        $user->mobile_number = '0454326583';
        $user->email = 'employee1@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->roles()->attach([7]);
        $user->branch_user()->attach([2]);
        $user_salary = new UserSalary();
        $user_salary->user_id = $user->id;
        $user_salary->branch_id = $user->branch_user[0]->id;
        $salary =  "12" . $user->id . "00";
        $user_salary->salary =  floatval($salary);
        $user_salary->save();

        $user = new User();
        $user->first_name = 'mr';
        $user->last_name = 'employee 2';
        $user->user_name = 'employee2';
        $user->telegram_id = '453535838';
        // $user->role_id = 3;
        $user->mobile_number = '0454326584';
        $user->email = 'employee2@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->roles()->attach([7]);
        $user->branch_user()->attach([2]);
        $user_salary = new UserSalary();
        $user_salary->user_id = $user->id;
        $user_salary->branch_id = $user->branch_user[0]->id;
        $salary =  "12" . $user->id . "00";
        $user_salary->salary =  floatval($salary);
        $user_salary->save();

        //Institute Students seeder
        for ($i=1; $i <17 ; $i++) { 
            $user = new User();
            $user->first_name = 'mr';
            $user->last_name = 'student' . $i;
            $user->user_name = 'student'. $i;
            $user->telegram_id = '812239512'. $i;
            // $user->role_id = 3;
            $user->mobile_number = '016125945'. $i;
            $user->email = 'student' . $i . '@gmail.com';
            $user->password = Hash::make('12345678');
            $user->save();
            $user->roles()->attach([6]);
            $user->branch_user()->attach([2]);
        }

        //Institute Teachers seeder
        for ($i=1; $i <6 ; $i++) { 
            $user = new User();
            $user->first_name = 'mr';
            $user->last_name = 'teacher' . $i;
            $user->user_name = 'teacher'. $i;
            $user->telegram_id = '812239512' . $i;
            // $user->role_id = 3;
            $user->mobile_number = '016125944'. $i+1;
            $user->email = 'teacher' . $i . '@gmail.com';
            $user->password = Hash::make('12345678');
            $user->save();
            $user->roles()->attach([7,4]);
            $user->branch_user()->attach([2]);
        }
    }
}
