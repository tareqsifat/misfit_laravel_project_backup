@extends('company.layout.index')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Companies</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <div class="card">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Company list</h3>

                            <div class="float-right">
                                <a href="{{ route('company.create') }}" class="btn btn-primary">+ Create Company</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Company Name</th>
                                        <th>Website</th>
                                        <th>Team size</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $key => $company)    
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><img src="/{{ $company->image }}" alt="" class="img-fluid" width="80"></td>
                                            <td>{{ $company->name }}</td>
                                            <td><a target="_blank" href="{{ $company->company_website_url }}">{{ $company->company_website_url }}</a></td>
                                            <td>{{ $company->team_size }}</td>
                                            <td>
                                                <a href="#" class="badge bg-warning">View</a>
                                                <a href="#" class="badge bg-info">Edit</a>
                                                <a onclick="alert('Are you sure!'); event.preventDefault();
                                                document.getElementById('delete-form-{{ $company->id }}').submit();" href="#" class="badge bg-danger">Delete</a>
                                                
                                                <form action="{{ route('company.destroy', $company->id) }}" id="delete-form-{{ $company->id }}" method="POST" class="d-none">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex align-items-center mt-3">
                                {{ $companies->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection