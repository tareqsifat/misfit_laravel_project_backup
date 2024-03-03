@extends('company.layout.index')

@section('content')
{{--    @dd($job_post)--}}
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Label</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Job Type</td>
                                    <td>
                                            {{ $job_post->job_type->type_name }}
                                    </td>
{{--                                    <td><span class="badge bg-danger">55%</span></td>--}}
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Job Posted At</td>
                                    <td>
                                        {{ $job_post->created_date }}
                                    </td>
{{--                                    <td><span class="badge bg-warning">70%</span></td>--}}
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Dead line</td>
                                    <td>
                                        {{ $job_post->dead_line }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>job title</td>
                                    <td>
                                        {{ $job_post->job_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Vacancy</td>
                                    <td>
                                        {{ $job_post->vacancy }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>salary</td>
                                    <td>
                                        {{ $job_post->job_salary }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>location</td>
                                    <td>
                                        {{ $job_post->job_location }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>description</td>
                                    <td>
                                        {!! $job_post->job_description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>is active</td>
                                    <td>
                                        {{ $job_post->getActiveAttribute($job_post->is_active) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <p>{{$job_post}}</p>
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
    {{$job_post}}
@endsection
