@extends('layouts.app')

@section('breadcrumb')
    <title>Teammate Index</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ Route::current()->uri() }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row d-flex">
                <div class="col-9 pt-2">
                    Teammate Index
                </div>
                <div class="col-3">
                    <a href="{{ route('teammates.create') }}" type="button" class="btn btn-primary">Add new Teammate</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    <th scope="col">Employee Id</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($teammates as $key => $teammate)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $teammate->name }}</td>
                            <td>{{ $teammate->email }}</td>
                            <td>{{ $teammate->position }}</td>
                            <td>{{ $teammate->employee_id }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <a href="{{ route('teammates.show', $teammate->id) }}" class="btn btn-primary">show</a>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('teammates.edit', $teammate->id) }}" class="btn btn-warning">update</a>
                                    </div>
                                    <div class="col-3">
                                        <form action="{{ route('teammates.destroy', $teammate->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="alert('Are You Sure?')" class="btn btn-danger">delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><span class="text-center"> There is no teammate</span></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
