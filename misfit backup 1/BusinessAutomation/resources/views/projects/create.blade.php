@extends('layouts.app')

@section('breadcrumb')
    <title>Project Create</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            Project Create
        </div>
        <div class="card-body">

            <form action="{{ route('projects.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="string" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter name">
                    @error('name')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Email address</label>
                    <input type="string" name="code" class="form-control" id="code" value="{{ old('code') }}" placeholder="Enter Project Code">
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
