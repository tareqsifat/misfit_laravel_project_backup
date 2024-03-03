@extends('layouts.app')

@section('breadcrumb')
    <title>Task Create</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            Task Create
        </div>
        <div class="card-body">

            <form action="{{ route('tasks.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="string" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter name">
                    @error('name')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="project_id" class="form-label">Project Id</label>
                    <select id="project_id" name="project_id" class="form-select" aria-label="Default select example">
                        @foreach($projects as $project)
                            <option value="">--select--</option>
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Description
                        <textarea class="form-control" id="exampleFormControlTextarea1" cols="100" rows="10"></textarea>
                    </label>
                    @error('code')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection
