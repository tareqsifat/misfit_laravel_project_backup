<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeAttendenceController extends Controller
{
    // get the branch admin details from auth
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        return $branch_admin->id;
    }
    public function all()
    {
        $query = User::where('status', 1);
        $students = $query->whereExists(function($query) {  
            $query->from('user_user_role')
            ->whereIn('user_user_role.user_role_id', [4,7])
                ->whereColumn('user_user_role.user_id', 'users.id');
        })
        ->whereExists(function($query) {  
            $query->from('institute_branch_institute_teacher')
                ->where('institute_branch_institute_teacher.institute_branch_id', $this->getBranchID());
        })
        ->leftJoin('attendences', function ($join) {
            $join->on('attendences.table_id', '=', 'users.id')
                ->where('attendences.table', '=', 'employee')
                ->where('attendences.date', request()->attendence_date);
        })
        ->select('users.*', 'attendences.present', 'attendences.date', 'attendences.start_time', 'attendences.end_time')
        ->get(); 

        return response()->json($students);
    }

    public function single_teacher_attendence()
    {
        // dd(auth()->user()->id);
        $attendence = Attendence::where('table_id', auth()->user()->id)
        ->where('table', "employee")->with(['user'])
        ->get();
        return response()->json($attendence);
    }

    public function teacher_monthly_attendence()
    {
        // dd(request()->all());
        $attendence = Attendence::where('table_id', auth()->user()->id)
        ->where('table', "employee")->whereMonth('date', request()->month)->whereYear('date', request()->year)
        ->get();
        return response()->json($attendence);
    }

    public function employee_attendence()
    {
        // dd(request()->all());
        $attendence = Attendence::where('table_id', request()->employee_id)->where('date', request()->attendence_date)->first();
        
        if($attendence == null) {
            $attendence = new Attendence();
            $attendence->table = 'employee';
            $attendence->table_id = request()->employee_id;
            $attendence->date = Carbon::parse(request()->attendence_date)->toDateString();
            $attendence->start_time = request()->start_time;
            $attendence->end_time = request()->end_time;
            $attendence->present = request()->present;
            $attendence->save();
            
        }else{
            Attendence::where('table_id', request()->employee_id)
            ->where('table', 'employee')
            ->where('date', request()->attendence_date)
            ->delete();
        }
        return response()->json("Attendence updated!", 200);
    }

    public function employee_attendence_udpate() : object {
        $attendence = Attendence::where('table_id', request()->employee_id)->where('date', request()->attendence_date)->first();
        if($attendence != null) {
            $attendence->table = 'employee';
            $attendence->end_time = request()->end_time;
            $attendence->update();
        }
        return response()->json("Attendence updated!", 200);
    }

    public function show($id)
    {
        # code...
    }
}
