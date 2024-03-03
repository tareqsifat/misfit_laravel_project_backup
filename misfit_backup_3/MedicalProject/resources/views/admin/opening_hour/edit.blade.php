@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Opening hour Edit
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('opening_hour.index') }}" class="btn btn-primary"><i class="icon-backward"></i> &nbsp; Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('opening_hour.update', $collection->id) }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            @method('PUT')
            <div class="preview">
                <div class="from-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Day</label>
                    <p><b style="font-size: 30px">{{ $collection->day }}</b></p>
                    
                </div>
                <div class="from-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">Start time</label>
                    @error('start_time')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="start_time" type="time" class="form-control" value="{{ $collection->stat_time }}">
                </div>
                <div class="from-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20">End time</label>
                    @error('end_time')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="end_time" type="time" class="form-control" placeholder="End time">
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20" >isclosed</label>
                    @error('isclosed')
                        <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input type="radio" name="isclosed" @if($collection->isclosed == "1") checked @endif value="1">
                    <label for="horizontal-form-1" class="form-control">Closed</label>

                    <input type="radio" name="isclosed" @if($collection->isclosed == "0") checked @endif value="0">
                    <label for="horizontal-form-1" class="form-control">Open</label>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp; update</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection