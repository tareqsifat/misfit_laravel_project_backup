@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Add user
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('user_index') }}" class="btn btn-primary"><i class="icon-backward"></i>
                   &nbsp; Back</a>
            </div>
        </div>
        <form method="POST" class="insert_form" action="{{ route('user_store') }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            <div class="preview">
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Photo</label>
                    @error('photo')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="photo" type="file" class="form-control">
                </div>
                {{-- <div class="preview"> --}}
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">First Name</label>
                    @error('firstname')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="firstname" type="text" class="form-control" placeholder="First Name">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Last Name</label>
                    @error('lastname')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="lastname" type="text" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Username</label>
                    @error('username')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="username" type="text" class="form-control" placeholder="Username">
                </div>
                    {{-- <div class="preview"> --}}
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Email</label>
                    @error('email')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="email" type="email" class="form-control" placeholder="Email">
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
                    <label for="horizontal-form-1" class="form-label sm:w-20">Password</label>
                    @error('password')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Confirm Password</label>
                    @error('password_confirmation')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection