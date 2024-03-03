@extends('admin.layout.index')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form action="{{ route('job-posts.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="text-danger"><b>:message</b></div>')) !!}
                                    @endif
                                    <div class="form-group">
                                        <label>Posted By</label>
                                        <select class="form-control" name="posted_by_id">
                                            <option value="0">Admin</option>
                                            <option value="1">Comapny</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Companies</label>
                                        <select class="form-control" name="company_id">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>job Types</label>
                                        <select class="form-control" name="job_type_id">
                                            @foreach ($job_types as $job_type)
                                                <option value="{{ $job_type->id }}">{{ $job_type->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Job Title</label>
                                        <input type="text" class="form-control" id="name" name="job_title" placeholder="Job Title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Dead Line</label>
                                        <input type="date" class="form-control" id="location" name="deadline" placeholder="Deadline" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="summernote">Vacancy</label>
                                        <input type="number" class="form-control" id="location" name="vacancy" placeholder="Vacancy" />
                                    </div>
                                    <div class="form-group">
                                        <label for="team_sizze">Job Salary</label>
                                        <input type="text" class="form-control" id="team_sizze" name="job_salary" placeholder="Job Salary" />
                                    </div>
                                    <div class="form-group">
                                        <label for="website_link">Job Location</label>
                                        <input type="text" class="form-control" id="website_link" name="job_location" placeholder="Job Location" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="website_link">Job Description</label>
                                        <textarea name="job_description" id="summernote" rows="10" required></textarea>
                                    </div>
                                </div>
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
