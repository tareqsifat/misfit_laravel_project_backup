<!-- Start -->
<section class="section"
  style="background: url('{{ asset('/') }}assets/web/bg.jpg') center center;background-repeat: no-repeat;background-size: cover;">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6">
                <div class="position-relative">
                    <img src="{{ asset('/') }}uploads/content/{{ $content->about_image }}" class="w-100" alt="">
                </div>
                <div class="mt-4 pt-2">
                    <a href="#appointment" class="btn btn-primary w-100 btn-lg ">Make Appointment Now</a>

                </div>
            </div>
            <!--end col-->

            <div class="col-lg-7 col-md-6 mt-4 mt-lg-0 pt- pt-lg-0" id="about">
                <div class="ms-lg-4">
                    <div class="section-title">
                        <p>
                            {!! $content->about_content !!}
                        </p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->


</section>