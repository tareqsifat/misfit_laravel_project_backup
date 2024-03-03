<section class="our_course_area" >
    <div class="container">
        <div class="our_course_area_content" id="our_course_types">

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
                    <li class="course_type_active">
                        <a @click.prevent="get_courses(course_url)" href="#">সকল কোর্স</a>
                    </li>
                    <li v-for="type in types" :key="type.id" class="course_type_active">
                        <a @click.prevent="get_course_by_type(type.id)" href="#">@{{ type.title }}</a>
                    </li>
                </ul>
            </div>
            <!-- course_schedule_name end-->

            <!-- our_course_all_card start -->
            <div class="our_course_all_card">
                <template>
                    <div class="c_card graphic_designer" v-for="course in courses.data" :key="course.id">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img :src="course.image" alt="graphic_designer, tech park it" />
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text">@{{ course.title }}</p>
                            </a>
                            <!-- card_title end -->

                            <div>
                                <!-- day_and_boking_area start -->
                                <div class="day_and_boking_area">
                                    <div class="day_area">
                                        <span class="day_icon">
                                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                                alt="clock, tech park it" />
                                        </span>
                                        <span class="day_tex" v-if="course.details">
                                            @{{ course.details.left_days }} দিন বাকী
                                        </span>
                                    </div>
                                    <div class="boking_area">
                                        <span class="boking_text" v-if="course.details && course.details.booked_percent > 0">
                                            @{{ course.details.booked_percent }}%
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
                                        <div class="previous_amount_area" v-if="course.details">
                                            <p class="previous_amount">
                                                <span class="taka"> ৳ </span>
                                                <span class="taka" > @{{ course.details.course_price }}</span>
                                            </p>
                                        </div>
                                        <div class="current_amount_area" v-if="course.details && course.details.after_discount_price > 0">
                                            <p class="current_amount">
                                                <span class="taka"> ৳ </span>
                                                <span class="taka"> @{{ course.details.after_discount_price }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- all_amount area end -->

                                    <!-- button_area start -->
                                    <a :href="`/course/${course.slug}`" class="button_all">
                                        <span class="btn-text">কোর্সটি দেখি</span>
                                        <span class="btn_icon">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </a>
                                    <!-- button_area end-->
                                </div>
                                <!-- amount_and_button_area end -->
                            </div>
                        </div>
                        <!-- card_title_area end -->
                    </div>
                </template>
            </div>

            <div>
                <button v-if="courses.prev_page_url" @click.prevent="get_courses(courses.prev_page_url)">prev</button>
                <button v-if="courses.next_page_url" @click.prevent="get_courses(courses.next_page_url)">next</button>
            </div>

        </div>
        <!-- our_course_all_card end -->
        <script>
            setTimeout(() => {
                initiate_our_course_types();
            }, 1000);
        </script>
    </div>
</section>
