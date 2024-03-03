@extends('layouts.app')

@section('breadcrumb')
    <title>Teammate Create</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            Teammate Details
        </div>
        <div class="card-body">
            <h5 class="card-title fw-bold">Name</h5>
            <p class="card-text" style="margin-left: 20px">{{ $teammate->name }}</p>
            <h5 class="card-title fw-bold">Email</h5>
            <p class="card-text" style="margin-left: 20px">{{ $teammate->email }}</p>
            <h5 class="card-title fw-bold">Position</h5>
            <p class="card-text" style="margin-left: 20px">{{ $teammate->position }}</p>
            <h5 class="card-title fw-bold">Employee Id</h5>
            <p class="card-text" style="margin-left: 20px">{{ $teammate->employee_id }}</p>

            <h5 class="card-title fw-bold">Assign a task to this teammate</h5>
            <form action="{{ route('assign_task_to_teammate') }}" class="form-control p-4" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $teammate->id }}">
                <label for="select">Task Id</label>
                <select id="select" name="task_id" class="form-select" aria-label="Default select example">
                    @foreach($tasks  as $task)
                        <option value="">--select--</option>
                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                    @endforeach
                </select>

                <div class="d-flex justify-content-end pt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
