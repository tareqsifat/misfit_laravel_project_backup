@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Edit Appointment Question
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('appoint_que.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp; Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('appoint_que.update', $collection->id) }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            @method('PUT')
            <div class="preview">
                <div class="form-group p-8">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Question</label>
                    {{-- <textarea name="question" id="horizontal-form-1" class="form-control" value="{{ $collection->question }}"></textarea> --}}
                    <input id="horizontal-form-1" name="question" type="text" class="form-control" value="{{ $collection->question }}">
                    @error('question')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                </div>
                <div class="form-group p-8">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Answer</label>
                    <textarea name="answer" id="horizontal-form-1" class="form-control" value="{{ $collection->answer }}">{{ $collection->answer }}</textarea>
                    @error('answer')
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