@extends('web.app.app')


@section('main-body')
@include('web.components.about')



<section class="section"
  style="background: url('{{ asset('/') }}assets/web/bg-2.jpg') center center;background-repeat: no-repeat;background-size: cover;">

    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6" id="appointment">
                @include('web.components.appointment')
            </div>
            <div class="col-lg-6 col-md-6 ">
                <div class="section">
                    <h3 class="text-center text-light">Frequenty Asked Quentions</h3>
                    <div class="accordion" id="accordionExample">
                        @foreach ($faqs as $faq)
                        <div class="accordion-item border rounded mt-2">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button border-0 bg-light collapsed" type="button"
                                  data-bs-toggle="collapse" data-bs-target="#colapse{{ $faq->id }}"
                                  aria-expanded="false" aria-controls="colapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="colapse{{ $faq->id }}" class="accordion-collapse border-0 collapse"
                              aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted">
                                    {{ $faq->answer }}.
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>

{{--
<div class="container">
    <div class="row">
        <div class="col-md-6">@include('web.components.appointment')</div>
        <div class="col-md-6">

        </div>

    </div>

</div> --}}





<section class="section bg-primary" id="service">
    <div class="container">

        <div class="row">

            <div class="col-12 col-md-12">
                <div class="section-title mb-4 pb-2 text-center">
                    <h3 class="text-center text-light">Our Medical Services</h3>
                </div>
            </div>

            @foreach ($services as $service)
            <div class="col-xl-3 col-md-4 col-12 mt-5">
                <div class="card features feature-primary border-0 text-center">
                    <div class="icon text-center rounded-md mx-auto">
                        <img src="{{ asset('/') }}uploads/services/{{ $service->image }}" alt="">
                    </div>
                    <div class="card-body p-0 mt-3">
                        <a href="departments.html" class="title text-dark h5">{{ $service->title }}</a>
                        <p class="text-muted mt-3">{{ $service->description }}</p>

                    </div>
                </div>
            </div>
            @endforeach

            <!--end col-->


            <!--end col-->
        </div>
    </div>
</section>
<!-- End -->
{{-- @include('web.components.timetable') --}}

{{-- @include('web.components.achivements') --}}
{{-- @include('web.components.faq') --}}
@include('web.components.review')

@include('web.components.news')


@endsection