@extends('admin.layout.admin')

@section('content')
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Create a Doctor Profile
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('doctors.index') }}" class="btn btn-primary"><i class="icon-backward"></i>
                    &nbsp; Back</a>
            </div>
        </div>
        <form method="POST" class="insert_form" action="{{ route('doctors.store') }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Photo</label>
                    @error('photo')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="photo" type="file" class="form-control" placeholder="Photo">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Name</label>
                    @error('name')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="name" type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Designation</label>
                    @error('designation')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="designation" type="text" class="form-control" placeholder="Designation">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Description</label>
                    @error('description')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="description" type="text" class="form-control" placeholder="Description">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Google Account</label>
                    @error('google_ac')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="google_ac" type="text" class="form-control" placeholder="your gmail id">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Facebook Id Link</label>
                    @error('facebook_ac')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="facebook_ac" type="text" class="form-control" placeholder="your facebook link">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Twitter Id Link</label>
                    @error('twitter_ac')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="twitter_ac" type="text" class="form-control" placeholder="your twitter link">
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; Add</button>
                </div>
            </div>
        </form>
    </div>
@endsection
