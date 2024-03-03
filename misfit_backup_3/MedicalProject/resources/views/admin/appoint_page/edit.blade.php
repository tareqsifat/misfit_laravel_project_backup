@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                All Blog
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('appoint_page.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp; Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('appoint_page.update', $collection->id) }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            @method('PUT')
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Title Image</label>
                    <input id="horizontal-form-1" name="title_image" type="file" class="form-control">
                    <img src='{{ asset("/uploads/appoint_pages/$collection->title_image") }}' style="height: 50px;" alt="{{ $collection->title_image }}">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Form Image</label>
                    <input id="horizontal-form-1" name="form_image" type="file" class="form-control">
                    <img src='{{ asset("/uploads/appoint_pages/$collection->form_image") }}' style="height: 50px;" alt="{{ $collection->form_image }}">
                    @error('form_image')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Title Message</label>
                    <input id="horizontal-form-1" name="title_message" type="text" class="form-control" value="{{ $collection->title_message }}">
                    @error('title_message')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Question Message</label>
                    <input id="horizontal-form-1" name="question_message" type="text" class="form-control" value="{{ $collection->question_message }}">
                    @error('title_message')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; update</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection