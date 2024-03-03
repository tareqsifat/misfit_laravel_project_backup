@extends('company.layout.index')

@section('content')

    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog Lists</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blog lists</li>
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
                                <h3 class="card-title">Blog list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    @if(count($blogs) != 0)
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Task</th>
                                                <th>Progress</th>
                                                <th>Label</th>
                                            </tr>
                                        </thead>
                                    @endif
                                    <tbody>
                                        @forelse($blogs as $key => $blog)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$blog->title}}</td>
                                                <td>{{$blog->sub_title}}</td>
                                                <td>
                                                    <a href="{{ route('blog.edit', $blog->id) }}">
                                                        <span class="badge bg-warning">edit</span>
                                                    </a>
                                                    <a href="{{ route('blog.show', $blog->id) }}">
                                                        <span class="badge bg-info">show</span>
                                                    </a>
                                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" onclick="alert('are you sure?')">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="badge bg-danger">delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <span class="d-flex justify-content-center" style="padding: 15px">There are no Blogs</span>
                                        @endforelse
                                    </tbody>
                                </table>
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
