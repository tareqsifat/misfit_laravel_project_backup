<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class SettingsController extends Controller
{
    public function all()
    {

        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = Setting::where('status', 1)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('value', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('value', 'LIKE', '%' . $key . '%');
            });
        }

        $settings = $query->paginate($paginate);
        return response()->json($settings);
    }

    public function site_logo() : object {
        $site_logo = Setting::where('title', 'site_logo')->first();

        return response()->json($site_logo);
    }

    public function updateLogo() : object {
        $validator = Validator::make(request()->all(), [
            'logo' => ['required', 'file'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Setting::where('title','site_logo')->first();

        if (request()->hasFile('logo')) {
            $file = request()->file('logo');
            $path = 'uploads/site/logo-' . $data->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->fit(240, 64)->save(public_path($path));
            $data->value = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function all_settings()
    {
        $settings = Setting::get();
        return response()->json($settings);
    }

    public function show($id)
    {
        $data = Setting::where('id',$id)->first();
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
            'title' => ['required', 'string'],
            'value' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Setting();
        $data->title = request()->title;
        $data->value = request()->value;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'value' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Setting();
        $data->title = request()->title;
        $data->value = request()->value;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = Setting::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['setting not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'value' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->value = request()->value;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = Setting::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['setting not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'value' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->value = request()->value;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:settings,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Setting::where('id', request()->id)->delete();

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
            $check = Setting::where('id',$item->id)->first();
            if(!$check){
                try {
                    Setting::create((array) $item);
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
