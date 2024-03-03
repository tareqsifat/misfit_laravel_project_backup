@extends('company.layout.index')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-12">
                        <h1 class="p-4">{{$blog->title}}</h1>
                        <br><br>
                        <h3 class="pb-4">{{ $blog->sub_title }}</h3>

                        {!! $blog->description !!}
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
