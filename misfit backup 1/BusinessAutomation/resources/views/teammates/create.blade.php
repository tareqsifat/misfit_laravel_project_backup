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
            Teammate Create
        </div>
        <div class="card-body">

            <form action="{{ route('teammates.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="string" name="name" class="form-control" id="name" placeholder="Enter name">
                    @error('name')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    @error('email')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="string" name="position" class="form-control" id="position" placeholder="Enter Position">
                    @error('position')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee Id</label>
                    <input type="string" name="employee_id" class="form-control" id="employee_id" placeholder="Enter Employee id">
                    @error('employee_id')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                    @error('password')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password" placeholder="Re Enter Password">
                    @error('password_confirmation')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create </button>
                </div>

            </form>
        </div>
    </div>

@endsection
