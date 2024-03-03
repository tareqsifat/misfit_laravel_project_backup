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
            Project Details
        </div>
        <div class="card-body">
            <h5 class="card-title fw-bold">Name</h5>
            <p class="card-text" style="margin-left: 20px">{{ $project->name }}</p>
            <h5 class="card-title fw-bold">Code</h5>
            <p class="card-text" style="margin-left: 20px">{{ $project->code }}</p>
        </div>
    </div>
@endsection
