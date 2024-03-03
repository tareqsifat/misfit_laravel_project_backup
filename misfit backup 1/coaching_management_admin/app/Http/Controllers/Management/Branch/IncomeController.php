<?php

namespace App\Http\Controllers\Management\Branch;

use App\Http\Controllers\Controller;
use App\Models\Accounts\BranchAccount;
use App\Models\Accounts\BranchAccountLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        return $branch_admin->branch_admin[0]->branch_details->id;
    }

    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = BranchAccountLog::where('branch_id', $this->getBranchID())
        ->where('is_income', 1)
        ->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('type', $key)
                    ->orWhere('description', $key)
                    ->orWhere('amount', $key)
                    ->orWhere('type', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%')
                    ->orWhere('amount', 'LIKE', '%' . $key . '%');
            });
        }

        $accounts = $query->with(['category', 'branch'])->paginate($paginate);
        return response()->json($accounts);
    }

    public function admin_incomes() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = BranchAccountLog::where('is_income', 1)
        ->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('type', $key)
                    ->orWhere('description', $key)
                    ->orWhere('amount', $key)
                    ->orWhere('type', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%')
                    ->orWhere('amount', 'LIKE', '%' . $key . '%');
            });
        }

        $accounts = $query->with(['category', 'branch'])->paginate($paginate);
        return response()->json($accounts);
    }

    public function admin_show($id) : object {
        $data = BranchAccountLog::where('id',$id)
        ->where('is_income', 1)
        ->with(['category', 'branch'])
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
        $data = BranchAccountLog::where('id',$id)
        ->where('is_income', 1)
        ->where('branch_id', $this->getBranchID())
        ->with('category')
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
        $validator = Validator::make(request()->all(), [
            'category' => ['required'],
            'amount' => ['required'],
            'description' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $account_id = BranchAccount::where('title', 'cash')->first();
        
        $data = new BranchAccountLog();
        $data->branch_id = $this->getBranchID();
        $data->account_category_id = request()->category;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->account_id = $account_id->id;
        $data->amount = request()->amount;
        $data->type = "credit";
        $data->description = request()->description;
        $data->is_income = 1;
        $data->save();

        return response()->json($data,200);
    }
}
