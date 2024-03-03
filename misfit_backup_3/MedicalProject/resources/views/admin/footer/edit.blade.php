@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Footer Update
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('footer.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp; Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('footer.update', $collection->id) }}" enctype="multipart/form-data" style="padding-right: 10px" id="horizontal-form">
            @csrf
            @method('PUT')
            <div class="preview">
                <div class="form-group p-4 mb-3">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Compny name</label>
                    <input id="horizontal-form-1" name="company_name" type="text" class="form-control" value="{{ $collection->company_name }}">
                    {{-- <textarea name="company_name" id="horizontal-form-1" class="form-control" value="{{ $collection->company_name }}"></textarea> --}}
                    @error('company_name')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-4 mb-3">
                    <label for="horizontal-form-1" class="form-label sm:w-20">email</label>
                    <input id="horizontal-form-1" name="email" type="text" class="form-control" value="{{ $collection->email }}">
                    @error('email')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-4 mb-3">
                    <label for="horizontal-form-1" class="form-label sm:w-20">phone</label>
                    <input id="horizontal-form-1" name="phone" type="text" class="form-control" value="{{ $collection->phone }}">
                    {{-- <textarea name="phone" id="horizontal-form-1" class="form-control" value="{{ $collection->phone }}"></textarea> --}}
                    @error('phone')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-4 mb-3">
                    <label for="horizontal-form-1" class="form-label sm:w-20">facebook</label>
                    <input id="horizontal-form-1" name="facebook" type="text" class="form-control" value="{{ $collection->facebook }}">
                    {{-- <textarea name="facebook" id="horizontal-form-1" class="form-control" value="{{ $collection->facebook }}"></textarea> --}}
                    @error('facebook')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                
                <div class="form-group p-4 mb-3">
                    <label for="horizontal-form-1" class="form-label sm:w-20">feed</label>
                    <input id="horizontal-form-1" name="feed" type="text" class="form-control" value="{{ $collection->feed }}">
                    {{-- <textarea name="feed" id="horizontal-form-1" class="form-control" value="{{ $collection->feed }}"></textarea> --}}
                    @error('feed')
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