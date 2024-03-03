<?php

namespace App\Http\Controllers\Management\Branch;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountCategory;
use App\Models\Accounts\BranchAccountLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountCategoryController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = AccountCategory::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->paginate($paginate);
        return response()->json($users);
    }

    public function get_all_categories()
    {
        $account_categories = AccountCategory::where('is_visible', 1)->get();
        return response()->json($account_categories);
    }

    public function visibility_update() {
        $data = AccountCategory::where('id', request()->account_id)->first();
        $data->is_visible = request()->visibility;
        $data->save();

        return response()->json($data,200);
    }

    public function show($id)
    {
        $data = AccountCategory::where('id',$id)->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new AccountCategory();
        $data->title = request()->title;
        $data->description = request()->description;
        $data->is_visible = request()->visibility;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new AccountCategory();
        $data->title = request()->title;
        $data->description = request()->description;
        $data->is_visible = request()->visibility;

        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = AccountCategory::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['category not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->description = request()->description;
        $data->is_visible = request()->visibility;

        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = AccountCategory::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['category not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->description = request()->description;
        $data->is_visible = request()->visibility;

        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:account_categories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = AccountCategory::find(request()->id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {

        $branch_account_log_history = BranchAccountLog::where('account_category_id', request()->id)->first();

        if(!is_null($branch_account_log_history)) {
            return response()->json([
                'error' => 'This Category has transaction.It cannot be deleted.',
            ], 400);
        }

        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:account_categories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = AccountCategory::where('id',request()->id)->delete();

        return response()->json([
            'result' => 'Deleted successfully',
        ], 200);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_branches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = AccountCategory::find(request()->id);
        $data->status = 1;
        $data->save();

        return response()->json([
                'result' => 'activated',
        ], 200);
    }

    public function bulk_import()
    {
        $validator = Validator::make(request()->all(), [
            'data' => ['required','array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        foreach (request()->data as $item) {
            $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']): Carbon::now()->toDateTimeString();
            $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']): Carbon::now()->toDateTimeString();
            $item = (object) $item;
            $check = AccountCategory::where('id',$item->id)->first();
            if(!$check){
                try {
                    AccountCategory::create((array) $item);
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
