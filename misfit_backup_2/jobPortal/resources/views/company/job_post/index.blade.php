@extends('company.layout.index')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Job posts</li>
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
                            <h3 class="card-title">All job posts</h3>

                            <div class="float-right">
                                <a href="{{ route('company.job_post.create') }}" class="btn btn-primary">+ Create Job post</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Job title</th>
                                        <th>Job Type</th>
                                        <th>Location</th>
                                        <th>Deadline</th>
                                        <th>Salary range</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_posts as $key => $job)    
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if($job->company)
                                                    <img src="/{{ $job->company->image }}" alt="" class="img-fluid" width="80">
                                                    <br>
                                                    <b>{{ $job->company->name }}</b>
                                                @endif
                                            </td>
                                            <td>{{ $job->job_title }}</td>
                                            <td>
                                                @if($job->job_type)
                                                    {{ $job->job_type->type_name }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $job->job_location }}
                                            </td>
                                            <td>{{ $job->deadline }}</td>
                                            <td>{{ $job->job_salary }}</td>
                                            <td>
                                                <a href="{{ route('company.job_post.show', $job->id) }}" class="badge bg-warning">View</a>
                                                <a href="{{ route('company.job_post.edit', $job->id) }}" class="badge bg-info">Edit</a>
                                                <a onclick="alert('Are you sure!'); event.preventDefault();
                                                document.getElementById('delete-form-{{ $job->id }}').submit();" href="#" class="badge bg-danger">Delete</a>

                                                <form action="{{ route('company.job_post.destroy', $job->id) }}" id="delete-form-{{ $job->id }}" method="POST" class="d-none">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex align-items-center mt-3">
                                {{ $job_posts->links('pagination::bootstrap-4') }}
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