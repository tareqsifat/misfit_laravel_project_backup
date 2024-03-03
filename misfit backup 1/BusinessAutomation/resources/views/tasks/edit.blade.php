@extends('layouts.app')

@section('breadcrumb')
    <title>Project Update</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            Project Update
        </div>
        <div class="card-body">

            <form action="{{ route('projects.update', $project->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="string" name="name" class="form-control" id="name" value="{{old('name', $project)}}" placeholder="Enter name">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="string" name="code" class="form-control" id="code" value="{{old('code', $project)}}" placeholder="Enter Project code">
                    @error('code')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update </button>
                </div>

            </form>
        </div>
    </div>

@endsection
