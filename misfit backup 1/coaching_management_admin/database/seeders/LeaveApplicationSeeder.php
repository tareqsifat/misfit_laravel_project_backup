<?php

namespace Database\Seeders;

use App\Models\LeaveApplication;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveApplication::truncate();

        for ($i=12; $i <17 ; $i++) { 
            $leave = new LeaveApplication();
            $leave->user_id = $i;
            $leave->branch_id = 2;
            $leave->reason = "Reason for taking a leave " . $i;
            $leave->from_date = Carbon::now()->subMonth($i-1);
            $leave->to_date = Carbon::now()->subMonth($i-1)->addDay($i);
            $leave->duration = $i;
            $leave->creator = 2;
            $leave->status = "pending";
            $leave->save();
        }
    }
}
