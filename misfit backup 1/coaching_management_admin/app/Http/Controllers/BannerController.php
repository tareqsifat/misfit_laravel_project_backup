<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = Banner::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('paragraph', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->paginate($paginate);
        return response()->json($users);
    }

    public function show($id)
    {
        $data = Banner::where('id',$id)->first();
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
            'paragraph' => ['required', 'string'],
            'image' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Banner();
        $data->title = request()->title;
        $data->title_highlight = request()->title_highlight;
        $data->paragraph = request()->paragraph;
        $data->link = request()->link;
        $data->save();

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/site/banner-' . $data->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            // Storage::put($path, $file);
            Image::make($file)->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    

    public function update()
    {
        $data = Banner::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['asset not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'paragraph' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->paragraph = request()->paragraph;
        $data->title_highlight = request()->title_highlight;
        $data->link = request()->link;
        $data->save();

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/site/banner-' . $data->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        
    }

    public function soft_delete()
    {
        
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:news_events,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Banner::where('id', request()->id)->delete();

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
            $check = Banner::where('id',$item->id)->first();
            if(!$check){
                try {
                    Banner::create((array) $item);
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
