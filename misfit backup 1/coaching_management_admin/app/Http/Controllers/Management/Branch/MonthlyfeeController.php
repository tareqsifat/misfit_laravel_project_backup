<?php

namespace App\Http\Controllers\Management\Branch;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountCategory;
use App\Models\Accounts\BranchAccount;
use App\Models\Accounts\BranchAccountLog;
use App\Models\Institute\InstituteStudent;
use App\Models\Institute\InstituteStudentPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonthlyfeeController extends Controller
{
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        if(count($branch_admin->branch_admin) > 0) {
            return $branch_admin->branch_admin[0]->branch_details->id;
        }else {
            $branch_user = auth()->user()->load('branch_user');
            $branch_id = $branch_user->branch_user[0]->id;
            return $branch_id;
        }
    }

    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        // $query = InstituteStudentPayment::where('branch_id', $this->getBranchID())
        // ->orderBy($orderBy, $orderByType);

        // if (request()->has('search_key')) {
        //     $key = request()->search_key;
        //     $query->where(function ($q) use ($key) {
        //         return $q->where('id', $key)
        //             ->orWhere('amount', $key)
        //             ->orWhere('date', $key)
        //             ->orWhere('amount', $key)
        //             ->orWhere('date', 'LIKE', '%' . $key . '%')
        //             ->orWhere('amount', 'LIKE', '%' . $key . '%');
        //     });
        // }

        // $accounts = $query->with(['student' => function($q) {
        //     $q->with('user');
        // },'account_log' => function($q2) {
        //     $q2->with('account');
        // }])->paginate($paginate);
        // return response()->json($accounts);

        $query = InstituteStudentPayment::where('branch_id', $this->getBranchID())
        ->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('amount', $key)
                    ->orWhere('date', $key)
                    ->orWhere('amount', $key)
                    ->orWhere('date', 'LIKE', '%' . $key . '%')
                    ->orWhere('amount', 'LIKE', '%' . $key . '%')
                    ->orWhereHas('student', function ($q) use ($key) {
                        $q->whereHas('user', function ($q) use ($key) {
                            $q->where('branch_code', 'LIKE', '%' . $key . '%')
                            ->orWhere('first_name', $key)
                            ->orWhere('last_name', $key);
                        });
                    });
            });
        }

        $accounts = $query->with(['student' => function($q) {
            $q->with('user');
        },'account_log' => function($q2) {
            $q2->with('account');
        }])->paginate($paginate);

        return response()->json($accounts);
    }

    public function single_student_monthly_fees() {
        // dd($this->getBranchID(), auth()->user()->id);
        $query = InstituteStudentPayment::where('branch_id', $this->getBranchID())->where('user_id', auth()->user()->id);

        $accounts = $query->with(['student' => function($q) {
            $q->with('user');
        }])->get();

        return response()->json($accounts);
    }

    public function admin_monthly_fees() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteStudentPayment::orderBy($orderBy, $orderByType);
        
        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('amount', $key)
                    ->orWhere('date', $key)
                    ->orWhere('amount', $key)
                    ->orWhere('date', 'LIKE', '%' . $key . '%')
                    ->orWhere('amount', 'LIKE', '%' . $key . '%');
            });
        }
        if(request()->has('branch_id')) {
            $query = $query->where('branch_id', request()->branch_id);
        }
        
        $accounts = $query->with(['student' => function($q) {
            $q->with('user');
        },'account_log' => function($q2) {
            $q2->with('account');
        }, 'branch'])->paginate($paginate);
        return response()->json($accounts);
    }

    public function get_all_students() {    
        $students = InstituteStudent::whereExists(
            function($query) {  
                $query->from('institute_branch_institute_student')
                    ->where('institute_branch_institute_student.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_institute_student.institute_student_id', 'institute_students.id');
            })->with(['user'])->get(); 
        
        return response()->json($students);
    }

    public function admin_details($id) : object {
        $data = InstituteStudentPayment::where('id',$id)
        ->with(['student' => function($q) {
            $q->with('user');
        }])
        ->first();
        
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['account'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function show($id)
    {
        $data = InstituteStudentPayment::where('id',$id)
        ->where('branch_id', $this->getBranchID())
        ->with(['student' => function($q) {
            $q->with('user');
        }, 'account_log' => function($q2) {
            $q2->with('category');
        }])
        ->first();
        
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['account'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function store()
    {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'institute_student_id' => ['required'],
            'amount' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        /*
            -First find account category with monthly fee
            -then find the account with cash
            -Insert the data into Account log first
            -Insert the data into student payment table 
        */
        $account_category = AccountCategory::where('title', "monthly fee")->first();
        $account = BranchAccount::where('title', 'cash')->first();

        // Insert the data into Account log first
        $account_log = new BranchAccountLog();
        $account_log->branch_id = $this->getBranchID();
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account->id;
        $account_log->amount = request()->amount;
        $account_log->type = "credit";
        $account_log->description = "Monthly student fee";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        // Insert the data into student payment table 
        $date = Carbon::parse(request()->date)->toDateString();
        $student_payment = new InstituteStudentPayment();
        $student_payment->user_id = request()->user_id;
        $student_payment->branch_id = $this->getBranchID();
        $student_payment->account_log_id = $account_log->id;
        $student_payment->amount = request()->amount;
        $student_payment->date = $date;
        $student_payment->institute_student_id = request()->institute_student_id;
        $student_payment->save();

        return response()->json($student_payment,200);
    }
}
