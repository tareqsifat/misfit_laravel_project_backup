@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Add New Testimonial
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('testimonial.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp;Back</a>
            </div>
        </div>
        <form method="POST" class="insert_form" action="{{ route('testimonial.store') }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Image</label>
                    @error('image')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="image" type="file" class="form-control">
                </div>
                {{-- <div class="preview"> --}}
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Body</label>
                    @error('body')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <textarea name="body" id="horizontal-form-1"placeholder="Description" class="form-control"></textarea>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection