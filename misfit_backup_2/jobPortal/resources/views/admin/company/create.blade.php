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
                            <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter company location" />
                                    </div>  
                                    <div class="form-group">
                                        <label for="summernote">Description</label>
                                        {{-- <label for="summernote"></label> --}}
                                        <textarea name="description" id="summernote" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="team_sizze">Team size</label>
                                        <input type="text" class="form-control" id="team_sizze" name="team_size" placeholder="Enter team size" />
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"/>
                                    </div> 
                                    <div class="form-group">
                                        <label for="date">Establishment Date</label>
                                        <input type="date" class="form-control" id="date" name="establishment_date" />
                                    </div>  
                                    <div class="form-group">
                                        <label for="website_link">Website link</label>
                                        <input type="text" class="form-control" id="website_link" name="website_link" placeholder="Enter website link" />
                                    </div>
                                    <div class="form-group">
                                        <label for="website_link">Top Company</label>
                                        <select class="custom-select rounded-0" name="is_top_company" id="exampleSelectRounded0">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
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
