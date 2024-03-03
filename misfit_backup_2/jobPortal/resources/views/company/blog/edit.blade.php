@extends('company.layout.index')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            {{-- @dd(Session::all()) --}}
                            <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ old('title', $blog) }}" placeholder="Enter Blog Title" />
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Sub Title</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2" name="sub_title" value="{{ old('sub_title', $blog) }}" placeholder="Enter Blog Sub Title" />
                                        @error('sub_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <label for="summernote"></label>
                                        <textarea name="description" id="summernote" rows="10">{{ old('description', $blog) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img src="/{{ $blog->image }}" alt="{{ $blog->title }}" height="100px">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"/>
                                        @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
