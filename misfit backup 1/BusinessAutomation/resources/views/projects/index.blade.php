@extends('layouts.app')

@section('breadcrumb')
    <title>Project Index</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="card">
        <h5 class="card-header">Filter Projects</h5>
        <div class="card-body">
            <form action="{{ route('projects.index') }}" method="get" class="form-inline">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group mr-2">
                                <label for="search_key" class="mr-2">Search by Name:</label>
                                <input id="search_key" name="search_key" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-3" style="margin-top: 22px">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row d-flex">
                <div class="col-9 pt-2">
                    Project Index
                </div>
                <div class="col-3">
                    <a href="{{ route('projects.create') }}" type="button" class="btn btn-primary">Add new Project</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($projects as $key => $project)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->code }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">show</a>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">update</a>
                                    </div>
                                    <div class="col-3">
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="alert('Are You Sure?')" class="btn btn-danger">delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><span class="text-center"> There is no projects</span></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
