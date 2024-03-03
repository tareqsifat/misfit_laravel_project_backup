@php
    $meta = [
        'seo' => [
            'title' => 'contact',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <!-- free_seminar_area_start -->
    <section class="free_seminar_area free_seminar_area_copy">
        <div class="container">
            <div class="free_seminar_area_content free_seminar_area_content_copy">
                <!-- <div class="row"> -->
                <!-- left_area start -->
                <!-- <div class="col-"> -->
                <div class="left_area left_area_copy">
                    <!--free_seminar_area title start -->
                    <div class="free_seminar_area_title">
                        <h2 class="area_title">
                            ফ্রি সেমিনারের সময়সূচি
                        </h2>
                    </div>
                    <!-- free_seminar_area title end -->

                    <!-- free_seminar_area sub_title start -->
                    <div class="free_seminar_area_sub_title">
                        <span class="sub_title">
                            আপনার ক্যারিয়ার কোন সেক্টরে গড়ে তুলবেন, সিদ্ধান্ত নিতে পারছেন না? আমাদের ফ্রি সেমিনারে জয়েন
                            করুন। বিষয়ভিত্তিক এই সেমিনারগুলোতে প্রতিটি কোর্সের সম্ভাবনা সম্পর্কে জানতে পারবেন। তাছাড়া
                            সেমিনারে উপস্থিত এক্সপার্ট কাউন্সেলরের সাথে কথা বলে আপনি সহজেই উপযুক্ত কোর্স বেছে নেওয়ার
                            সিদ্ধান্ত নিতে পারেন।
                        </span>
                    </div>
                    <!-- free_seminar_area sub_title end -->

                    <!-- date_line_area start -->
                    @foreach ($seminars as $item)
                    <div class="date_line_area date_line_area_copy">

                        @php
                        $date1 = \Carbon\Carbon::now(); 
                        $date2 = \Carbon\Carbon::parse($item->date_time);

                        $diff = $date1->diffInDays($date2);

                       @endphp

                        <div class="date date_copy">
                            <span class="date_number date_number_copy">{{$diff}}</span>
                            <span class="date_text">দিন বাকী</span>
                        </div>

                        <div class="data_science data_science_copy">
                            <span class="data_science_text_title data_science_text_title_copy">{{$item->title}}</span>
                            <div class="data_science_text_sub_title data_science_text_sub_title_copy">
                                <!-- অনলাইন | ১৯ ডিসেম্বর ২৩ সোমবার, 09:00 pm -->
                                <span> অনলাইন</span>
                                <span class="space_space"> |</span>
                                <span>{{\Carbon\Carbon::parse($item->date_time)->format('d F Y h:m A')}}</span>

                            </div>
                        </div>

                        <div class="join_button join_button_copy">
                            <button class="button_all button_all_copy">
                                <span class="btn_text"> জয়েন</span>
                            </button>
                        </div>

                    </div>
                    @endforeach 
                    
                    <!--  date_line_area end -->             

                </div>
                <!-- </div> -->
                <!-- left_area end -->

                <!-- </div> -->
            </div>
        </div>
    </section>
    <!-- free_seminar_area_end -->

@endsection
