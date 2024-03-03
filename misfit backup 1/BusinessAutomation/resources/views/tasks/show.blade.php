@extends('layouts.app')

@section('breadcrumb')
    <title>Task Show</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')
{{--    @dd(\Illuminate\Support\Facades\Session::all())--}}
    <div class="card">
        <div class="card-header">
            Task Details
        </div>
        <div class="card-body">
            <h5 class="card-title fw-bold">Name</h5>
            <p class="card-text" style="margin-left: 20px">{{ $task->name }}</p>
            <h5 class="card-title fw-bold">Name</h5>
            <p class="card-text" style="margin-left: 20px">{{ $task->project->name }}</p>
            <h5 class="card-title fw-bold">Code</h5>
            <p class="card-text" style="margin-left: 20px">{{ $task->project->code }}</p>
            <h5 class="card-title fw-bold">Description</h5>
            <p class="card-text" style="margin-left: 20px">{{ $task->description }}</p>
            <h5 class="card-title fw-bold">Status</h5>
            <p class="card-text" style="margin-left: 20px">{{ $task->status }}</p>

            @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                <h5 class="card-title fw-bold">Assign this task to a teammate</h5>
                <form action="{{ route('assign_task_to_teammate') }}" class="form-control p-4" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <label for="select">Teammate</label>
                    <select id="select" name="user_id" class="form-select" aria-label="Default select example">
                        @foreach($teammates as $teammate)
                            <option value="1">--select--</option>
                            <option value="{{ $teammate->id }}">{{ $teammate->name }}</option>
                        @endforeach
                    </select>

                    <div class="d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            @elseif(\Illuminate\Support\Facades\Auth::user()->id == 2)
                <h5 class="card-title fw-bold">Task Status Update</h5>
                <form action="{{ route('task_status_update') }}" class="form-control p-4" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <label for="select">Teammate</label>
                    <select id="select" name="status" class="form-select" aria-label="Default select example">
                        <option value="1">--select--</option>
                        <option value="pending">Pending</option>
                        <option value="working">Working</option>
                        <option value="done">Done</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
