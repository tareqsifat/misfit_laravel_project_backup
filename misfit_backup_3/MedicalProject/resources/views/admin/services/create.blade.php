@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Create Service
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('service.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp;Back</a>
            </div>
        </div>
        <form method="POST" class="insert_form" action="{{ route('service.store') }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Title</label>
                    @error('title')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="title" type="text" class="form-control" placeholder="Service Title">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20" >Description</label>
                    @error('description')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <textarea name="description" id="horizontal-form-1" class="form-control" placeholder="Service Description"></textarea>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection