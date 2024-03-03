@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Doctor Edit
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('doctors.index') }}" class="btn btn-primary"><i class="icon-backward"></i> &nbsp; Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('doctors.update', $collection->id) }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            @method('PUT')
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Photo</label>
                    <input id="horizontal-form-1" name="photo" type="file" class="form-control">
                    <img src='{{ asset("/uploads/doctors/$collection->photo") }}' style="height: 50px;" alt="{{ $collection->photo }}">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Name</label>
                    <input id="horizontal-form-1" name="name" type="text" class="form-control" value="{{ $collection->name }}">
                    @error('name')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Designation</label>
                    @error('designation')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="designation" type="text" class="form-control" value="{{ $collection->designation }}">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Description</label>
                    @error('description')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="description" type="text" class="form-control" value="{{ $collection->description }}">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Google Account</label>
                    @error('google_ac')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="google_ac" type="text" class="form-control" value="{{ $collection->google_ac }}">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Facebook Id Link</label>
                    @error('facebook_ac')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="facebook_ac" type="text" class="form-control" value="{{ $collection->facebook_ac }}">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Twitter Id Link</label>
                    @error('twitter_ac')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="twitter_ac" type="text" class="form-control" value="{{ $collection->twitter_ac }}">
                </div>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; update</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection