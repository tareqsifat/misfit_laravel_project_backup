@php
$meta = [
    "seo" => [
        "title" => "contact",
        "image" => asset('seo.jpg'),
    ]
];
@endphp
@extends('frontend.layouts.layout',$meta)
@section('contents')
    <!-- our_course area start -->
    <section class="our_course_area our_course_area_copy">
        <div class="container">
            <div class="our_course_area_content our_course_area_content_copy">

                <!-- our_course_area_title start -->
                <div class="our_course_area_title">
                    <h2 class="area_title">
                        আমাদের কোর্সসমূহ
                    </h2>
                </div>
                <!-- our_course_area_title end -->

                <!-- course_schedule_name start-->
                <div class="course_schedule_name">
                    <ul>
                        <li>
                            <a href="#">সকল কোর্স</a>
                        </li>
                        <li>
                            <a href="#">অনলাইন কোর্স</a>
                        </li>
                        <li>
                            <a href="#">অফলাইন কোর্স</a>
                        </li>
                        <li>
                            <a href="#">ডে-কেয়ার কোর্স</a>
                        </li>
                    </ul>
                </div>
                <!-- course_schedule_name end-->

                <!-- our_course_all_card start -->
                <div class="our_course_all_card our_course_all_card_copy">
                    <!-- <div class="row"> -->
                    <!-- <div class="col-4"> -->
                    <!-- graphic_designer card area start-->
                    <div class="c_card graphic_designer c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/grafix.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text">প্রফেশনাল গ্রাফিক্স ডিজাইন</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->
                    </div>
                    <!-- graphic_designer card area end-->
                    <!-- </div> -->
                    <!-- <div class="col-4"> -->
                    <!-- web card area start-->
                    <div class="c_card web c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/web.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text">Full Stack Web Development
                                    with MERN</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <!-- web card area end-->
                    <!-- </div> -->
                    <!-- <div class="col-4"> -->
                    <!-- degital marketing card area start-->
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <div class="c_card digital_marketing c_card_copy">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
                                    </span>
                                    <span class="boking_text">
                                        বুকড
                                    </span>
                                </div>
                            </div>
                            <!-- day_and_boking_area end -->

                            <!-- amount_and_button_area start -->
                            <div class="amount_and_button_area">
                                <!-- all_amount area start -->
                                <div class="all_amount">
                                    <div class="previous_amount_area">
                                        <p class="previous_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <spancontact class="taka"> ৳ </spancontact>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <!-- degital marketing card area end-->
                    <!-- </div> -->
                </div>

            </div>
            <!-- our_course_all_card end -->
        </div>
        </div>
    </section>
    <!-- our_course area end -->
@endsection

