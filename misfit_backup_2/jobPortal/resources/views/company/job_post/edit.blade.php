@extends('company.layout.index')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    {{-- @dd(App\Models\CompanyProfile\Company::find(Auth::guard('employer')->user()->id)) --}}
                    {{-- @dd(Auth::guard('employer')->user()) --}}
                    
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form action="{{ route('company.job_post.update', $job_post->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="text-danger"><b>:message</b></div>')) !!}
                                    @endif
                                    @if(auth_check('user_account') && auth_user('user_account'))
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
                                    @else
                                        <input type="hidden" name="posted_by_id" value="1">
                                        <input type="hidden" name="company_id" value="1">
                                    @endif
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
                                        <input type="text" class="form-control" id="name" name="job_title" placeholder="Job Title" value="{{ old('job_title', $job_post) }}" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Dead Line</label>
                                        <input type="date" class="form-control" id="location" name="deadline" placeholder="Deadline" value="{{ old('deadline', $job_post) }}" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="summernote">Vacancy</label>
                                        <input type="number" class="form-control" id="location" name="vacancy" value="{{ old('vacancy', $job_post) }}" placeholder="Vacancy" />
                                    </div>
                                    <div class="form-group">
                                        <label for="team_sizze">Job Salary</label>
                                        <input type="text" class="form-control" id="team_sizze" name="job_salary" value="{{ old('job_salary', $job_post) }}" placeholder="Job Salary" />
                                    </div>
                                    <div class="form-group">
                                        <label for="website_link">Job Location</label>
                                        <input type="text" class="form-control" id="website_link" name="job_location" value="{{ old('job_location', $job_post) }}" placeholder="Job Location" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="website_link">Job Description</label>
                                        <textarea name="job_description" id="summernote" rows="10" required>{!! old('job_description', $job_post) !!}</textarea>
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
