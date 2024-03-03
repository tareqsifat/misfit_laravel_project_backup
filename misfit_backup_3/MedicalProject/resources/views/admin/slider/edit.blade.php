@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Slider update
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('slider.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp; Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('slider.update', $collection->id) }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            @method('PUT')
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Image</label>
                    <input id="horizontal-form-1" name="image" type="file" class="form-control">
                    <img src='{{ asset("/uploads/sliders/$collection->image") }}' alt="{{ $collection->image }}" style="height: 50px">
                    <span class="text-danger name"></span>
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">left Title</label>
                    <input id="horizontal-form-1" name="left_title" type="text" class="form-control" value="{{ $collection->left_title }}">
                    <span class="text-danger name"></span>
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Right Litle</label>
                    <input id="horizontal-form-1" name="right_title" type="text" class="form-control" value="{{ $collection->right_title }}">
                    <span class="text-danger name"></span>
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Description</label>
                    <textarea name="description" id="horizontal-form-1" class="form-control">{{ $collection->description }}</textarea>
                    <span class="text-danger name"></span>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; update</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection