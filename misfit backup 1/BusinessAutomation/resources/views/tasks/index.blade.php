@extends('layouts.app')

@section('breadcrumb')
    <title>Task Index</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="card">
        <h5 class="card-header">Filter Tasks</h5>
        <div class="card-body">
            @if(\Illuminate\Support\Facades\Auth::user()->user_type_id == 1)
                <form action="{{ route('tasks.index') }}" method="get" class="form-inline">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group mr-2">
                                    <label for="project" class="mr-2">Project:</label>
                                    <select class="form-control" id="project" name="project">
                                        <option value="0">All Projects</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                                                    {{ $project->name }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mr-2">
                                    <label for="teammate" class="mr-2">Teammates:</label>
                                    <select class="form-control" id="teammate" name="user_id">
                                        <option value="0">All Teammates</option>
                                        @foreach($teammates as $teammate)
                                            <option value="{{ $teammate->id }}" {{ request('user_id') == $teammate->id ? 'selected' : '' }}>
                                                {{ $teammate->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mr-2">
                                    <label for="status" class="mr-2">Status:</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="all">All Statuses</option>
                                        <option value="1" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ request('status') == 'working' ? 'selected' : '' }}>Working</option>
                                        <option value="3" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3" style="margin-top: 22px">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type_id == 2)
            <form action="{{ route('teammate_task_index') }}" method="get" class="form-inline">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group mr-2">
                                <label for="project" class="mr-2">Project:</label>
                                <select class="form-control" id="project" name="project">
                                    <option value="0">All Projects</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mr-2">
                                <label for="status" class="mr-2">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="all">All Statuses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="working" {{ request('status') == 'working' ? 'selected' : '' }}>Working</option>
                                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4" style="margin-top: 22px">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
    <div class="card">
        @if(\Illuminate\Support\Facades\Auth::user()->user_type_id == 1)
            @include('includes.manager_task_table')
        @elseif(\Illuminate\Support\Facades\Auth::user()->user_type_id == 2)
            @include('includes.teammate_task_table')
        @endif
    </div>
@endsection
