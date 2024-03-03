<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\UserManagement\UserReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function all()
    {

        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = UserReview::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('date', $key)
                    ->orWhere('reveiw_given_by', $key)
                    ->orWhere('review', 'LIKE', '%' . $key . '%')
                    ->orWhere('date', 'LIKE', '%' . $key . '%')
                    ->orWhere('reveiw_given_by', 'LIKE', '%' . $key . '%');
            });
        }

        $UserReviews = $query->paginate($paginate);
        return response()->json($UserReviews);
    }

    public function show($id)
    {
        $data = UserReview::where('id',$id)->first();
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
            'date' => ['required'],
            'review' => ['required'],
            'reveiw_given_by' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new UserReview();
        $data->user_id = Auth::user()->id;
        $data->review = request()->review;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->reveiw_given_by = request()->reveiw_given_by;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'date' => ['required'],
            'review' => ['required'],
            'reveiw_given_by' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new UserReview();
        $data->user_id = Auth::user()->id;
        $data->review = request()->review;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->reveiw_given_by = request()->reveiw_given_by;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = UserReview::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['UserReview not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'date' => ['required'],
            'review' => ['required'],
            'reveiw_given_by' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = Auth::user()->id;
        $data->review = request()->review;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->reveiw_given_by = request()->reveiw_given_by;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = UserReview::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['UserReview not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'date' => ['required'],
            'review' => ['required'],
            'reveiw_given_by' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = Auth::user()->id;
        $data->review = request()->review;
        $data->date = request()->date;
        $data->reveiw_given_by = request()->reveiw_given_by;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:user_reviews,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = UserReview::where('id', request()->id)->delete();

        return response()->json([
            'result' => 'deleted',
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
            $check = UserReview::where('id',$item->id)->first();
            if(!$check){
                try {
                    UserReview::create((array) $item);
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
