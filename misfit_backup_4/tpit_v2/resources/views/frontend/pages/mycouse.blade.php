@php
$meta = [
// "meta" => [],
    "seo" => [
        "title" => "My Course",
        "image" => asset('seo.jpg'),
    ]
];
@endphp
@extends('frontend.layouts.layout',$meta)
@section('contents')
    <div class="my_courses_area">
        <div class="container">
            <div class="my_courses">
                <div class="my_courses_title">আমার কোর্সসমূহ</div>
                <div class="my_all_courses">
                    <div class="complete_course">
                        <div class="complete_courses_icon"><i class="fa-regular fa-circle-check"></i></div>
                        <div class="complete_courses_info">
                            <div class="complete_courses_title">কোর্স কমপ্লিট</div>
                            <div class="complete_courses_total">১ টি</div>
                        </div>
                    </div>
                    <div class="contunued_course">
                        <div class="contunued_courses_icon"><i class="fa-regular fa-circle-right"></i></div>
                        <div class="contunued_courses_info">
                            <div class="contunued_courses_title">চলমান কোর্স</div>
                            <div class="contunued_courses_total">২ টি</div>
                        </div>
                    </div>
                    <div class="incomplete_course">
                        <div class="incomplete_courses_icon"><i class="fa-regular fa-circle-xmark"></i></div>
                        <div class="incomplete_courses_info">
                            <div class="incomplete_courses_title">অসম্পন্ন কোর্স</div>
                            <div class="incomplete_courses_total">০</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my_contunued_courses">
                <div class="my_contunued_courses_title">চলমান কোর্সসমূহ</div>
                <div class="contunued_courses_border"></div>
                <div class="my_contunued_all_courses">
                    <div class="c_card graphic_designer">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="./assets/images/home_page_image/our_course_area/grafix.png"
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
                                    <!-- <span class="day_icon">
                                        <img src="./assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span> -->
                                    <span class="day_tex">
                                        আমার স্কোরঃ
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
                                <!-- <div class="all_amount">
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
                                </div> -->
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্স বিস্তারিত</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="./assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->
                    </div>
                    <div class="c_card web">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="./assets/images/home_page_image/our_course_area/web.png"
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
                                    <!-- <span class="day_icon">
                                        <img src="./assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span> -->
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
                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="./assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                </div>
            </div>
            <div class="my_contunued_courses">
                <div class="my_contunued_courses_title">কমপ্লিট কোর্সসমূহ</div>
                <div class="contunued_courses_border"></div>
                <div class="my_contunued_all_courses">
                    <div class="c_card graphic_designer">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="./assets/images/home_page_image/our_course_area/grafix.png"
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
                                    <!-- <span class="day_icon">
                                        <img src="./assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span> -->
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
                                <!-- <div class="all_amount">
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
                                </div> -->
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্স সার্টিফিকেট দেখুন</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="./assets/images/home_page_image/our_course_area/arrow.png"
                                            alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
