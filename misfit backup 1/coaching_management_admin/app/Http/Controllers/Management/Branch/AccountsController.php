<?php

namespace App\Http\Controllers\Management\Branch;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountCategory;
use App\Models\Accounts\AccountDetails;
use App\Models\Accounts\BranchAccount;
use App\Models\Accounts\BranchAccountLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    private function getBranchID()
    {
        $branch_admin = auth()->user()->load('branch_admin');

        return $branch_admin->branch_admin[0]->branch_details->id;
    }
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = BranchAccount::where(function ($q) {
            $q->where('branch_id', null)
                ->orWhere('branch_id', $this->getBranchID());
        })->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('description', $key)
                    ->orWhere('account_no', $key)
                    ->orWhere('account_mobile_no', $key)
                    ->orWhere('account_email', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%')
                    ->orWhere('account_no', 'LIKE', '%' . $key . '%')
                    ->orWhere('account_mobile_no', 'LIKE', '%' . $key . '%')
                    ->orWhere('account_email', 'LIKE', '%' . $key . '%');
            });
        }
        // $users = $query->withSum(['income_log' => function($q) use ($branch_admins) {
        //     $q->where('branch_id', $branch_admins->id)->where('');
        // }], 'amount')->paginate($paginate);

        $query->withSum(['income_log' => function ($q) {
            $q->where('branch_id', $this->getBranchID())->where('is_income', 1);
        }], 'amount');

        $query->withSum(['expense_log' => function ($q) {
            $q->where('branch_id', $this->getBranchID())->where('is_expense', 1);
        }], 'amount');


        $accounts = $query->with(['account_details' => function ($q) {
            $q->where('branch_id', $this->getBranchID());
        }])->paginate($paginate);

        return response()->json($accounts);
    }

    public function admin_accounts()
    {

        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = BranchAccount::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('description', $key)
                    ->orWhere('account_no', $key)
                    ->orWhere('account_mobile_no', $key)
                    ->orWhere('account_email', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%')
                    ->orWhere('account_no', 'LIKE', '%' . $key . '%')
                    ->orWhere('account_mobile_no', 'LIKE', '%' . $key . '%')
                    ->orWhere('account_email', 'LIKE', '%' . $key . '%');
            });
        }
        // $users = $query->withSum(['income_log' => function($q) use ($branch_admins) {
        //     $q->where('branch_id', $branch_admins->id)->where('');
        // }], 'amount')->paginate($paginate);

        $query->withSum(['income_log' => function ($q) {
            $q->where('is_income', 1);
        }], 'amount');

        $query->withSum(['expense_log' => function ($q) {
            $q->where('is_expense', 1);
        }], 'amount');


        $accounts = $query->with(['account_details', 'institute_branch'])->paginate($paginate);

        return response()->json($accounts);
    }

    public function transfer_balance()
    {
        $validator = Validator::make(request()->all(), [
            'account_from' => ['required'],
            'account_to' => ['required'],
            'amount' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $fromAccountQuery = BranchAccount::where('id', request()->account_from);
        $fromAccountQuery->withSum(['income_log' => function ($q) {
            $q->where('branch_id', $this->getBranchID())->where('is_income', 1);
        }], 'amount'); // Provide the column name for summing

        $fromAccountQuery->withSum(['expense_log' => function ($q) {
            $q->where('branch_id', $this->getBranchID())->where('is_expense', 1);
        }], 'amount'); // Provide the column name for summing

        $fromAccount = $fromAccountQuery->first();

        $balance_check = $fromAccount->income_log_sum_amount - $fromAccount->expense_log_sum_amount;

        // for updating the categoru
        $account_category_id = AccountCategory::where('title', 'Other expense')->pluck('id')->first();
        if($account_category_id == null) {
            $account_category = new AccountCategory();
            $account_category->title = "Other expense";
            $account_category->description = "Other expenses";
            $account_category->is_visible = 1;
            $account_category->save();
            $account_category_id = $account_category->id;
        }
        // dd($balance_check);

        if(request()->amount > $balance_check && $fromAccount->is_cash != 1) {
            return response()->json(["message" => "Insufficiant balance!", 'condition' => 'failed']);
        }else {
            $branch_account_log = new BranchAccountLog();
            $branch_account_log->branch_id = $this->getBranchID();
            $branch_account_log->account_category_id = $account_category_id;
            $branch_account_log->description = "Balance transfer";
            $branch_account_log->account_id = request()->account_from;
            $branch_account_log->amount = request()->amount;
            $branch_account_log->type = 'debit';
            $branch_account_log->is_expense = 1;
            $branch_account_log->save();


            $branch_account_log = new BranchAccountLog();
            $branch_account_log->branch_id = $this->getBranchID();
            $branch_account_log->account_category_id = $account_category_id;
            $branch_account_log->account_id = request()->account_to;
            $branch_account_log->description = "Balance received from another account";
            $branch_account_log->amount = request()->amount;
            $branch_account_log->type = 'credit';
            $branch_account_log->is_income = 1;
            $branch_account_log->save();

            return response()->json("Fund transfered successfully!", 200);
        }
    }

    public function all_accounts()
    {
        $branch_accounts = BranchAccount::where(function ($q) {
            $q->where('branch_id', null)
                ->orWhere('branch_id', $this->getBranchID());
        })->get();

        return response()->json($branch_accounts);
    }

    public function total_expense()
    {
        $paginate = (int) request()->paginate;

        $data = BranchAccountLog::where('branch_id', $this->getBranchID())
            ->where('is_expense', 1)
            ->with('category')
            ->paginate($paginate);

        return response()->json($data);
    }

    public function show($id)
    {
        $data = BranchAccount::where('id', $id)->where('branch_id', $this->getBranchID())->with('account_details')->first();
        // dd($data);
        if (!$data) {
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['account' => ['data not found']],
            ], 422);
        }
        return response()->json($data, 200);
    }

    public function store()
    {

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'account_no' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BranchAccount();
        $data->title = request()->title;
        $data->is_cash = request()->is_cash;
        $data->description = request()->description;
        $data->branch_id = $this->getBranchID();
        $data->save();


        $account_details = new AccountDetails();
        $account_details->account_id = $data->id;
        $account_details->branch_id = $this->getBranchID();
        $account_details->account_no = request()->account_no;
        $account_details->account_mobile_no = request()->account_mobile_no;
        $account_details->account_email = request()->account_email;
        $account_details->save();

        $account_log = new BranchAccountLog();
        $account_log->branch_id = $this->getBranchID();
        $account_log->account_category_id = 6;
        $account_log->account_id = $data->id;
        $account_log->amount = request()->starting_balance;
        $account_log->type = "credit";
        $account_log->description = "Starting balance";
        $account_log->is_income = 1;
        $account_log->is_expense = 0;
        $account_log->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'account_no' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BranchAccount();
        $data->branch_id = $this->getBranchID();
        $data->title = request()->title;
        $data->is_cash = request()->is_cash;
        $data->description = request()->description;
        $data->account_no = request()->account_no;
        $data->account_mobile_no = request()->account_mobile_no;
        $data->account_email = request()->account_email;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = BranchAccount::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['account not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'account_no' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }


        $data->title = request()->title;
        $data->is_cash = request()->is_cash;
        $data->description = request()->description;
        $data->branch_id = $this->getBranchID();
        $data->save();


        $account_details = BranchAccount::where('account_id', request()->id)->first();
        $account_details->account_id = $data->id;
        $account_details->branch_id = $this->getBranchID();
        $account_details->account_no = request()->account_no;
        $account_details->account_mobile_no = request()->account_mobile_no;
        $account_details->account_email = request()->account_email;
        $account_details->save();

        return response()->json($data, 200);
    }



    public function soft_delete()
    {
    }

    public function destroy()
    {

        $branch_account_log_history = BranchAccountLog::where('account_id', request()->id)->get();

        if (!is_null($branch_account_log_history)) {
            foreach ($branch_account_log_history as $key => $value) {
                if ($value->amount > 0) {
                    return response()->json([
                        'error' => 'This account has transaction.It cannot be deleted.',
                    ], 400);
                }
            }
        }

        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:branch_accounts,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $brach_account = BranchAccount::where('id', request()->id)->first();
        if ($brach_account->is_cash == 1) {
            return response()->json([
                'error' => 'Cash account cannot be deleted.',
            ], 400);
        }

        BranchAccount::where('id', request()->id)->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }

    public function bulk_import()
    {
        $validator = Validator::make(request()->all(), [
            'data' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        foreach (request()->data as $item) {
            $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']) : Carbon::now()->toDateTimeString();
            $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']) : Carbon::now()->toDateTimeString();
            $item = (object) $item;
            $check = BranchAccount::where('id', $item->id)->first();
            if (!$check) {
                try {
                    BranchAccount::create((array) $item);
                } catch (\Throwable $th) {
                    return response()->json([
                        'err_message' => 'validation error',
                        'errors' => $th->getMessage(),
                    ], 400);
                }
            }
        }

        return response()->json('success', 200);
    }
}
