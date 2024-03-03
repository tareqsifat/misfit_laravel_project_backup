<?php

namespace Database\Seeders;

use App\Models\Institute\InstituteBranch;
use App\Models\Institute\InstituteBranchContacts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteBranch::truncate();
        InstituteBranchContacts::truncate();
        

        $instituteBranch = new InstituteBranch();
        $instituteBranch->name = "Farmgate branch";
        $instituteBranch->street = "Green road, road no-2";
        $instituteBranch->city = "Dhaka";
        $instituteBranch->state = "Dhaka, Bangladesh";
        $instituteBranch->zip_code = "1216";
        $instituteBranch->country = "Bangladesh";
        $instituteBranch->save();

        for ($i=0; $i <2 ; $i++) { 
            $branchContact = new InstituteBranchContacts();
            $branchContact->intstitue_branch_id = $i+1;
            $branchContact->first_name = "Mr";
            $branchContact->last_name = "Admin " . $i;
            $branchContact->phone_number = "0175484154" . $i;
            $branchContact->email = "branch_admin". $i . "@gmail.com";
            $branchContact->creator = 2;
            $branchContact->status = 1;
            $branchContact->save();
        }
        // $instituteBranch->branch_admin()->attach([3]);

        $instituteBranch = new InstituteBranch();
        $instituteBranch->name = "Mirpur branch";
        $instituteBranch->street = "Proshika, road no-6";
        $instituteBranch->city = "Dhaka";
        $instituteBranch->state = "Dhaka, Bangladesh";
        $instituteBranch->zip_code = "1216";
        $instituteBranch->country = "Bangladesh";
        $instituteBranch->save();
        // $instituteBranch->branch_admin()->attach([2]);
    }
}
