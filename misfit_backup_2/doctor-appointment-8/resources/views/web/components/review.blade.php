<section class="section" id="portfolio"
  style="background: url('{{ asset('/') }}assets/web/bg-3.jpg') center center;background-repeat: no-repeat;background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title mb-4 bg-primary p-3 text-light">What Patients Says</h4>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row justify-content-center bg-primary">
            <div class="col-lg-8 mt-4 pt-2 text-center">
                <div class="client-review-slider">

                    @foreach($testimonials as $testimonial)
                    <div class="tiny-slide text-center">
                        <p class="text-light fw-normal fst-italic">" {{ $testimonial->description }}"</p>
                        <img src="{{ asset('/') }}uploads/testimonials/{{ $testimonial->image }}"
                          class="img-fluid avatar avatar-small rounded-circle mx-auto shadow my-3" alt="">
                        <h6 class="text-light">{{ $testimonial->title }} </h6><small
                          class="text-light">{{ $testimonial->subtitle }}</small>
                    </div>
                    <!--end customer testi-->
                    @endforeach


                </div>
                <!--end carousel-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->


    <!--end container-->
</section>