@extends('admin.layout.index')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" placeholder="Enter Blog Title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Sub Title</label><input type="text" class="form-control" id="exampleInputEmail2" name="sub_title" placeholder="Enter Blog Sub Title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <label for="summernote"></label>
                                        <textarea name="description" id="summernote" rows="10"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('js')
        <script>
            $(function () {
                // Summernote
                $('#summernote').summernote({
                    height: 300, // Set the desired height
                    focus: true,
                });
            })
        </script>
    @endpush
@endsection
