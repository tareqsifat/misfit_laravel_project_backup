@php
$meta = [
// "meta" => [],
'seo' => [
'title' => 'Tech Park IT',
'image' => asset('seo.jpg'),
],
];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
<!-- banner_part start -->
@include('frontend.pages.homepage_sections.banner_section')
<!-- banner_part end -->

<!-- course_item start -->
@include('frontend.pages.homepage_sections.course_category_section', [
'categories' => $course_categories,
])
<!-- course_item end -->

<!-- our_course area start -->
@include('frontend.pages.homepage_sections.course_section')

<!-- our_course area end -->

<!-- our_course_specialty area start -->
<section class="our_course_specialty" style="background-image: url(http://techparkit.org/frontend/assets/images/home_page_image/our_course_specialty/bg_img.png);">
    <div class="container">
        <div class="our_course_specialty_area_content">

            <!--our_course_specialty_area_title start -->
            <div class="our_course_specialty_area_title">
                <h2 class="area_title">
                    আমাদের কোর্সসমূহের বিশেষত্ব
                </h2>
            </div>
            <!-- our_course_specialty_area_title end -->

            <!-- course_card_area start -->
            <div class="course_card_area">

                <!-- card start -->
                <div class="c_card card_1">
                    <div class="card_img_area">
                        <div class="card_img">
                            <img src="https://techparkit.org/frontend/assets/images/home_page_image/our_course_specialty/support.png" alt="card tech park it
                                ">
                        </div>
                    </div>
                    <div class="card_text">
                        <p>সার্বক্ষণিক সাপোর্ট</p>
                    </div>
                </div>
                <!-- card end -->
                <!-- card start -->
                <div class="c_card card_2">
                    <div class="card_img_area">
                        <div class="card_img">
                            <img src="https://techparkit.org/frontend/assets/images/home_page_image/our_course_specialty/live.png" alt="card tech park it
                                ">
                        </div>
                    </div>
                    <div class="card_text">
                        <p>সার্বক্ষণিক সাপোর্ট</p>
                    </div>
                </div>
                <!-- card end -->
                <!-- card start -->
                <div class="c_card card_3">
                    <div class="card_img_area">
                        <div class="card_img">
                            <img src="https://techparkit.org/frontend/assets/images/home_page_image/our_course_specialty/quiz.png" alt="card tech park it
                                ">
                        </div>
                    </div>
                    <div class="card_text">
                        <p>সার্বক্ষণিক সাপোর্ট</p>
                    </div>
                </div>
                <!-- card end -->
                <!-- card start -->
                <div class="c_card card_4">
                    <div class="card_img_area">
                        <div class="card_img">
                            <img src="https://techparkit.org/frontend/assets/images/home_page_image/our_course_specialty/tainer.png" alt="card tech park it
                                ">
                        </div>
                    </div>
                    <div class="card_text">
                        <p>সার্বক্ষণিক সাপোর্ট</p>
                    </div>
                </div>
                <!-- card end -->
                <!-- card start -->
                <div class="c_card card_5">
                    <div class="card_img_area">
                        <div class="card_img">
                            <img src="https://techparkit.org/frontend/assets/images/home_page_image/our_course_specialty/certificate.png" alt="card tech park it
                                ">
                        </div>
                    </div>
                    <div class="card_text">
                        <p>সার্বক্ষণিক সাপোর্ট</p>
                    </div>
                </div>
                <!-- card end -->


            </div>
            <!-- course_card_area end -->

        </div>
    </div>
</section>


<!-- earning_area start -->
<section class="earning_area">
    <div class="container">
        <div class="earning_area_content">

            <!-- earning_area_title start -->
            <div class="earning_area_title">
                <h2 class="area_title">
                    কোর্স শেষেই আর্নিং শুরু করুন
                </h2>
            </div>
            <!-- earning_area_title end -->

            <!-- earning_area_sub_title start -->
            <div class="earning_area_sub_title">
                <p class="sub_title">আমাদের কোর্স মডিউল এমনভাবে সাজানো যে স্টুডেন্টরা কোর্স কমপ্লিট করার
                    সাথে সাথেই জব-রেডি হয়ে যায়</p>
            </div>
            <!-- earning_area_sub_title end -->

            <!-- earning_area_bottom start -->
            <div class="earning_area_bottom">
                <ul>
                    <li class="one">
                        <div class="step_number">
                            <a href="#">1</a>

                            <div class="right_arrow_area arrow_area_1">
                                <div class="right_arrow arrow_1">
                                    <!-- <hr class="stain"> -->
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </div>
                        </div>

                        <p class="bottom_text">কোর্সে জয়েন করুন</p>
                    </li>
                    <!-- <li>
                                <div class="arrow">
                                    <img src="{{ asset('frontend') }}/assets/images/home_page_image/earning_area/Arrow 1.png" alt="arrow tech park it">
                                </div>
                            </li> -->
                    <li>
                        <div class="step_number step_two">
                            <a href="#">2</a>
                            <div class="right_arrow_area arrow_area_2">
                                <div class="right_arrow  arrow_2">
                                    <!-- <hr class="stain"> -->
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                        <p class="bottom_text">কোর্স কমপ্লিট করুন</p>
                    </li>
                    <!-- <li>
                                <div class="arrow">
                                    <img src="{{ asset('frontend') }}/assets/images/home_page_image/earning_area/Arrow 2.png" alt="arrow tech park it">
                                </div>
                            </li> -->
                    <li>
                        <div class="step_number step_three">
                            <a href="#">3</a>
                            <div class="right_arrow_area arrow_area_3">
                                <div class="right_arrow arrow_3">
                                    <!-- <hr class="stain"> -->
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                        <p class="bottom_text">কোর্সের টাস্কগুলো পোর্টফোলিওতে শেয়ার করুন</p>
                    </li>
                    <!-- <li>
                                <div class="arrow">
                                    <img src="{{ asset('frontend') }}/assets/images/home_page_image/earning_area/Arrow 2.png" alt="arrow tech park it">
                                </div>
                            </li> -->
                    <li>
                        <div class="step_number">
                            <a href="#">4</a>
                        </div>
                        <p class="bottom_text">গেট Hired</p>
                    </li>
                </ul>
            </div>
            <!-- earning_area_bottom end -->

        </div>
    </div>
</section>
<!-- earning_area end -->

<!-- Student success history arer start -->
<section class="student_success_history_area">
    <div class="container">
        <div class="student_success_history_content">

            <!--student_success_history_area_title start -->
            <div class="student_success_history_area_title">
                <h2 class="area_title">
                    শিক্ষার্থীদের সাকসেস স্টোরি
                </h2>
            </div>
            <!-- student_success_history_area_title end -->

            <!-- student_success_history_area_sub_title start -->
            <div class="student_success_history_area_sub_title">
                <span class="sub_title">
                    আমাদের শিক্ষার্থীরা সফলতার সাথে কোর্স শেষ করে সফলতার সাথে ফ্রিলান্সিং ও জব করছে।
                </span>
                <span class="sub_title">
                    আমাদের শিক্ষার্থীদের মুখ থেকেই শুনুন তাদের সফলতার গল্প
                </span>
            </div>
            <!-- student_success_history_area_sub_title end -->

            <!-- student_success_video_area start -->
            <div class="student_success_video_area">
                <button class="success_video_area">
                    <div class="success_video_cover_photo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/student_success_area/video_img.png"
                            alt="video_img tech park it">
                    </div>
                    <div class="video_button_icon">
                        <!-- <i class="fa-solid fa-circle-play"></i> -->
                        <i class="fa-solid fa-play"></i>
                    </div>
                </button>
                <button class="success_video_area">
                    <div class="success_video_cover_photo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/student_success_area/video_img.png"
                            alt="video_img tech park it">
                    </div>
                    <div class="video_button_icon">
                        <!-- <i class="fa-solid fa-circle-play"></i> -->
                        <i class="fa-solid fa-play"></i>
                    </div>
                </button>
                <button class="success_video_area">
                    <div class="success_video_cover_photo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/student_success_area/video_img.png"
                            alt="video_img tech park it">
                    </div>
                    <div class="video_button_icon">
                        <!-- <i class="fa-solid fa-circle-play"></i> -->
                        <i class="fa-solid fa-play"></i>
                    </div>
                </button>
                <button class="success_video_area">
                    <div class="success_video_cover_photo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/student_success_area/video_img.png"
                            alt="video_img tech park it">
                    </div>
                    <div class="video_button_icon">
                        <!-- <i class="fa-solid fa-circle-play"></i> -->
                        <i class="fa-solid fa-play"></i>
                    </div>
                </button>
            </div>
            <!-- student_success_video_area end -->

            <!-- student_success_history_area_button start-->
            <div class="success_history_button_area">
                <button class="button_all">
                    <span class="btn_text">আরও দেখুন</span>
                    <span class="btn_icon"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </div>
            <!-- student_success_history_area_button end-->

        </div>
    </div>
</section>
<!-- Student success history arer end -->

<!-- profational_trainer area start-->
<section class="profational_trainer_area">
    <div class="container">
        <div class="profational_trainer_area_content">
            <div class="row">

                <!-- left_area start -->
                <div class="col-xs-12 col-md-6">
                    <div class="left_area">
                        <div class="trainer_img">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/profational_trainer_area/traine.jpg"
                                alt="trainer tech park it">
                        </div>
                    </div>
                </div>
                <!-- left_area end -->

                <!-- right_area start -->
                <div class="col-xs-12 col-md-6">
                    <div class="right_area">
                        <div class="right_area_content">
                            <!-- profational_trainer_area title start -->
                            <div class="profational_trainer_area_title">
                                <h2 class="area_title">
                                    আমাদের প্রফেশনাল ট্রেইনারস
                                </h2>
                            </div>
                            <!-- profational_trainer_area title end -->

                            <!-- profational_trainer_area sub_title start -->
                            <div class="profational_trainer_area_sub_title">
                                <span class="sub_title sub1">
                                    আমাদের রয়েছেন প্রফেশনাল ট্রেইনারস, যারা প্রত্যেকেরই রয়েছে স্ব স্ব ক্ষেত্রে বেশ
                                    কয়েকবছর ধরে কোর্স করানোর অভিজ্ঞতা
                                </span>
                                <span class="sub_title">
                                    যাদের হাত ধরে বহু শিক্ষার্থী ফ্রিলানিং ও জব সেক্টরে সফলতার সাথে কাজ করছেন
                                </span>
                            </div>
                            <!-- profational_trainer_area sub_title end -->

                            <!-- profational_trainer_area_button start-->
                            <div class="profational_trainer_button_area">
                                <button class="button_all">
                                    <span class="btn_text">বিস্তারিত দেখুন</span>
                                    <span class="btn_icon"><i class="fa-solid fa-arrow-right"></i></span>
                                </button>
                            </div>
                            <!-- profational_trainer_area_button end-->
                        </div>
                    </div>
                </div>
                <!-- right_area end -->

            </div>

        </div>
    </div>
</section>
<!-- profational_trainer area end-->

<!-- free_seminar_area_start -->
<section class="free_seminar_area">
    <div class="container">
        <div class="free_seminar_area_content">
            <div class="row">
                <!-- left_area start -->
                <div class="col-xs-12 col-md-12 col-lg-6">
                    <div class="left_area">
                        <!--free_seminar_area title start -->
                        <div class="free_seminar_area_title">
                            <h2 class="area_title">
                                অংশ নিন আমাদের ফ্রি সেমিনারে
                            </h2>
                        </div>
                        <!-- free_seminar_area title end -->

                        <!-- free_seminar_area sub_title start -->
                        <div class="free_seminar_area_sub_title">
                            <span class="sub_title">
                                আপনার ক্যারিয়ার কোন সেক্টরে গড়ে তুলবেন, সিদ্ধান্ত নিতে পারছেন না? আমাদের ফ্রি
                                সেমিনারে জয়েন করুন। বিষয়ভিত্তিক এই সেমিনারগুলোতে প্রতিটি কোর্সের সম্ভাবনা সম্পর্কে
                                জানতে পারবেন। তাছাড়া সেমিনারে উপস্থিত এক্সপার্ট কাউন্সেলরের সাথে কথা বলে আপনি সহজেই
                                উপযুক্ত কোর্স বেছে নেওয়ার সিদ্ধান্ত নিতে পারেন।
                            </span>
                        </div>
                        <!-- free_seminar_area sub_title end -->

                        <!-- date_line_area start -->
                        @foreach ($seminar as $item)
                            @php
                                $date1 = \Carbon\Carbon::now();
                                $date2 = \Carbon\Carbon::parse($item->date_time);

                                $difference = $date1->diffInDays($date2);
                            @endphp
                            <div class="date_line_area">

                                <div class="date">
                                    <span class="date_number">{{ $difference }}</span>
                                    <span class="date_text">দিন বাকী</span>
                                </div>

                                <div class="data_science">
                                    <span class="data_science_text_title">
                                        {{ $item->title }}
                                    </span>
                                    <div class="data_science_text_sub_title">
                                        <!-- অনলাইন | ১৯ ডিসেম্বর ২৩ সোমবার, 09:00 pm -->
                                        <span> অনলাইন</span>
                                        <span class="space_space"> |</span>
                                        <span>
                                            {{ Carbon\Carbon::parse($item->date_time)->format('d F l, h:i a') }}
                                        </span>

                                    </div>
                                </div>

                                <div class="join_button">
                                    <button class="button_all">
                                        <span class="btn_text"> জয়েন</span>
                                    </button>
                                </div>

                            </div>
                        @endforeach
                        <!-- date_line_area end -->
                        <!-- date_line_area start -->

                        <!--  date_line_area end -->

                        <!-- free_seminar_area_button start-->
                        <div class="free_seminar_button_area">
                            <a href="/seminar" class="button_all">
                                <span class="btn_icon"><i class="fa-solid fa-calendar-days"></i></span>
                                <span class="btn_text">সকল সেমিনারের সময়সূচি</span>
                            </a>
                        </div>
                        <!-- free_seminar_area_button end-->

                    </div>
                </div>
                <!-- left_area end -->

                <div class="col-xs-12 col-md-12 col-lg-6">
                    <div class="right_area">
                        <div class="free_seminar_image">
                            <img src="/frontend/assets/images/home_page_image/free_seminar_area/img.png" alt="seminar_image tech park it">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- free_seminar_area_end -->

<!-- job_career_area start-->
<section class="job_career_area">
    <div class="container">
        <div class="job_career_area_content">
            <div class="row">
                <!-- left_area start -->
                <div class="col-xs-12 col-md-6">
                    <div class="left_area">
                        <!--job_career_area title start -->
                        <div class="job_career_area_title">
                            <h2 class="area_title">
                                আপনার জব ক্যারিয়ার নিয়ে চিন্তিত?
                            </h2>
                        </div>
                        <!-- job_career_area title end -->
                        <!-- job_career_image start -->
                        <div class="job_career_image">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/job_career_area/img.png"
                                alt="job_career tech park it">
                        </div>
                        <!-- job_career_image end -->
                    </div>
                </div>
                <!-- left_area end -->

                <!-- right_area start -->
                <div class="col-xs-12 col-md-6">
                    <div class="right_area">
                        <!-- form_area start -->
                        <div class="form_area">
                            <!-- form_area_sub_title start -->
                            <div class="form_area_sub_title">
                                <p class="sub_title">
                                    আমাদের সাথে এপয়েন্টমেন্ট বুক করুন, আমরা আপনাকে ক্যারিয়ার সংক্রান্ত পরামর্শ দিব
                                </p>
                            </div>
                            <!-- form_area_sub_title end -->

                            <!-- form stat -->
                            <form action="#">
                                <input type="text" placeholder="আপনার নাম *">
                                <input type="email" placeholder="আপনার ইমেইল *">
                                <input type="tel" placeholder="আপনার ফোন নাম্বার">
                                <textarea name="#" id="#" cols="30" rows="10" placeholder="বিস্তারিত লিখুন"></textarea>
                                <button class="button_all">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    <span> সাবমিট করুন</span>
                                </button>
                            </form>
                            <!-- form end -->
                        </div>
                        <!-- form_area end -->
                    </div>
                </div>
                <!-- right_area  -->

            </div>
        </div>
    </div>
</section>
<!-- job_career area end-->


<!-- my_it_service_area start -->
<section class="my_it_service_area"
    style="background-image: url({{ asset('frontend') }}/assets/images/home_page_image/ti_service/bg_img.png);">
    <div class="container">
        <div class="my_it_service_area_content">

            <!--my_it_service_area_title start -->
            <div class="my_it_service_area_title">
                <h2 class="area_title">
                    আমাদের আইটি সার্ভিসগুলো
                </h2>
            </div>
            <!-- my_it_service_area end -->

            <!-- my_it_service_area_sub_title start -->
            <div class="my_it_service_area_sub_title">
                <span class="sub_title">
                    আমরা ক্লায়েন্ট-কেন্দ্রিক ওয়েব ডিজাইন ও ডেভোলাপমেন্ট এবং সাইভার সিকিউরিটি সার্ভিস প্রদান করি
                </span>

            </div>
            <!-- my_it_service_area_sub_title end -->

            <!-- service_area start -->
            <div class="service_area">


                <div class="service wordpress">
                    <div class="service_logo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/wordpress.png"
                            alt="service techpark it">
                    </div>
                    <div class="service_title_and_description">
                        <div class="title">
                            <p class="title_text">
                                ওয়ার্ডপ্রেস ডেভোলাপমেন্ট
                            </p>
                        </div>
                        <div class="description">
                            <p class="description_text">
                                ওয়ার্ডপ্রেস ইন্সটলেশন, থিম কাস্টমাইজেশন,
                                রেসপনসিভ ডিজাইন, ওয়ার্ডপ্রেস ডেভেলপমেন্ট,
                                ওয়ার্ডপ্রেস প্লাগইন ইন্টিগ্রেশন এবং ওয়ার্ডপ্রেস এসইও।
                            </p>
                        </div>
                    </div>
                </div>


                <div class="service  react ">
                    <div class="service_logo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/react.png"
                            alt="service techpark it">
                    </div>
                    <div class="service_title_and_description">
                        <div class="title">
                            <p class="title_text">
                                React ডেভোলাপমেন্ট
                            </p>
                        </div>
                        <div class="description">
                            <p class="description_text">
                                আমরা React ফ্রন্টএন্ড ডেভোলাপমেন্ট এবং

                                আপনার সিঙ্গেল পেজ React ওয়েবসাইট (SPA) তৈরি করুন
                            </p>
                        </div>
                    </div>
                </div>


                <div class="service e_commers">
                    <div class="service_logo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/e_comarce.png"
                            alt="service techpark it">
                    </div>
                    <div class="service_title_and_description">
                        <div class="title">
                            <p class="title_text">
                                Laravel ই-কমার্স
                            </p>
                        </div>
                        <div class="description">
                            <p class="description_text">
                                আমরা ফুলস্ট্যাক Laravel ই-কমার্স সাইট ডেভোলাপমেন্ট সার্ভিস প্রদান করি
                            </p>
                        </div>
                    </div>
                </div>


                <div class="service psd">
                    <div class="service_logo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/phd.png"
                            alt="service techpark it">
                    </div>
                    <div class="service_title_and_description">
                        <div class="title">
                            <p class="title_text">
                                PSD to HTML
                            </p>
                        </div>
                        <div class="description">
                            <p class="description_text">
                                PSD/Figma/Adobe XD ডিজাইন HTML-এ কনভার্ট করি
                            </p>
                        </div>
                    </div>
                </div>


                <div class="service vue">
                    <div class="service_logo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/vuejs-ar21 1.png"
                            alt="service techpark it">
                    </div>
                    <div class="service_title_and_description">
                        <div class="title">
                            <p class="title_text">
                                Vue ডেভোলাপমেন্ট
                            </p>
                        </div>
                        <div class="description">
                            <p class="description_text">
                                Laravel+VueJS এর মাধ্যমে আপনার ওয়েবসাইট তৈরি করুন আমাদের থেকে আপনি VueJS এর মাধ্যমে
                                SPA Application বানাতে পারবেন
                            </p>
                        </div>
                    </div>
                </div>

                <div class="service server">
                    <div class="service_logo">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/server.png"
                            alt="service techpark it">
                    </div>
                    <div class="service_title_and_description">
                        <div class="title">
                            <p class="title_text">
                                সাইভার সিকিউরিটি
                            </p>
                        </div>
                        <div class="description">
                            <p class="description_text">
                                আমরা সকল ধরনের সাইবার সিকিউরিটি সার্ভিস প্রদান করি
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service_area end-->
        </div>
    </div>
</section>
<!-- my_it_service_area end-->

<!-- working_company_name area start -->
<section class="working_company_name_area">
    <div class="working_company_name_area_content">

        <!--working_company_name_area_title start -->
        <div class="working_company_name_area_title">
            <h2 class="area_title">
                আমরা যাদের সাথে কাজ করছি
            </h2>
        </div>
        <!-- -working_company_name_area_title end -->

        <!-- all_company_name and logo area start -->
        <div class="all_company_name">
            <ul>
                <li class="company_logo">
                    <a href="#">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/work_company_name/1.png"
                            alt="logo">
                    </a>
                </li>
                <li class="company_logo">
                    <a href="#">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/work_company_name/2.png"
                            alt="logo">
                    </a>
                </li>
                <li class="company_logo">
                    <a href="#">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/work_company_name/3.png"
                            alt="logo">
                    </a>
                </li>
                <li class="company_logo">
                    <a href="#">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/work_company_name/4.png"
                            alt="logo">
                    </a>
                </li>
                <li class="company_logo">
                    <a href="#">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/work_company_name/5.png"
                            alt="logo">
                    </a>
                </li>
                <li class="company_logo">
                    <a href="#">
                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/work_company_name/6.png"
                            alt="logo">
                    </a>
                </li>

            </ul>
        </div>
        <!-- all_company_name and logo area end -->
    </div>
</section>
<!-- working_company_name area end -->
@endsection
