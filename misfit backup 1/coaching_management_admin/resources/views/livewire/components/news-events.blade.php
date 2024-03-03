<div>
    {{-- Be like water. --}}
    <section class="news_events_and_notice_area">
        <div class="container">
            <div class="news_events_and_notice_area_content">
                <div class="row">
                    <!-- news_events_area start -->
                    <div class="col-md-6">
                        <div class="news_events_area">
                            <!-- news_events_area_title start -->
                            <div class="news_events_area_title">
                                <h2>news & events</h2>
                            </div>
                            <!-- news_events_area_title end -->
                            <div class="news_events_area_content_all">
                                <div class="news_events_area_content_all_2">

                                    @foreach ($news as $item)    
                                    <!-- -------------------------- -->
                                    <!-- news_events_area_content start -->
                                    <div class="news_events_area_content">
                                        <!-- news_date start -->
                                        <div class="news_date">
                                            <p>
                                                <span class="day">
                                                    @php
                                                        $day = $item->created_at->format('d');
                                                    @endphp
                                                    {{ $day }} 
                                                </span>
                                                <span class="month">
                                                    @php
                                                        $month = $item->created_at->format('F');
                                                    @endphp
                                                    {{ $month }}
                                                </span>
                                                <span class="year">
                                                    @php
                                                        $year = $item->created_at->format('Y');
                                                    @endphp
                                                    {{ $year }}    
                                                </span>
                                            </p>
                                        </div>
                                        <!-- news_date end -->
                                        <!-- news_img_and_news_text area start -->
                                        <div class="news_img_and_news_text">
                                            <div class="row" style="margin-bottom: 20px;">
                                                <!-- news_img area start -->
                                                
                                                <div class="col-md-3">
                                                    <div class="news_img_area">
                                                        
                                                        <a href="#" class="news_img"
                                                            style="background-image: url('/{{ $item->image }}');">
                                                            <!-- <img src="./assets/images/news_events_img/img1.jpg" alt="img"> -->
                                                        </a>
                                                    </div>

                                                </div>
                                                <!-- news_img area end -->
                                                <!-- news_text_area start -->
                                                <div class="col-md-9">
                                                    <div class="news_text_area">
                                                        <div class="news_title">
                                                            <a href="{{ route('news_event_details_page', $item->id) }}"><b>{{ $item->title }}</b></a>
                                                        </div>
                                                        <div class="news_details">
                                                            <p>
                                                                {{ \Illuminate\Support\Str::limit($item->description, 100) }}
                                                            </p>
                                                        </div>
                                                        <div class="news_button">
                                                            <a href="{{ route('news_event_details_page', $item->id) }}">read more <span>...</span> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- news_text_area end -->
                                            </div>
                                        </div>
                                        <!-- news_img_and_news_text area end -->

                                    </div>
                                    <!-- news_events_area_content end -->
                                     <!-- -------------------------- -->
                                    @endforeach
                                </div>
                                <!-- view_more_button area start -->
                                <div class="view_more_button">
                                    <a href="{{ route('news_event_page') }}">view more</a>
                                </div>
                                <!-- view_more_button area end -->
                            </div>
                        </div>
                    </div>
                    <!-- news_events_area end -->
                    <!-- notice_area start -->
                    <div class="col-md-6">
                        <div class="notice_area">
                            <div class="notice_area_title">
                                <h2>notice</h2>
                            </div>
                            <!-- notice_area_all_content start -->
                            <div class="notice_area_all_content">
                                <div class="notice_area_content">
                                    <!-- notice start -->
                                    @foreach ($notices as $notice)
                                    <div class="notice">
                                        <div class="notice_date">
                                            <p>
                                                {{-- <span>07</span>
                                                <span>march</span>
                                                <span>2023</span> --}}
                                                <span class="day">
                                                    @php
                                                        $day = $item->created_at->format('d');
                                                    @endphp
                                                    {{ $day }} 
                                                </span>
                                                <span class="month">
                                                    @php
                                                        $month = $item->created_at->format('F');
                                                    @endphp
                                                    {{ $month }}
                                                </span>
                                                <span class="year">
                                                    @php
                                                        $year = $item->created_at->format('Y');
                                                    @endphp
                                                    {{ $year }}    
                                                </span>
                                            </p>
                                            
                                        </div>
                                        <div class="notice_details">
                                            <a class="news_title" href="{{ route('notice_details_page', $notice->id) }}"><b>{{ $notice->title }}</b></a><br>
                                            <div class="news_details">
                                                <p>
                                                    {{ \Illuminate\Support\Str::limit($notice->description, 100) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    {{-- <div class="notice">
                                        <div class="notice_date">
                                            <p>
                                                <span>07</span>
                                                <span>march</span>
                                                <span>2023</span>
                                            </p>
                                        </div>
                                        <div class="notice_details">
                                            <a href="#">Lorem ipsum dolor sit amet consec
                                                tetur adipisicing elit. Assumenda quib
                                                usdam at laboriosam. Error consectetur ea, pra
                                                esentium rem maiores sint? Ab.
                                            </a>
                                        </div>
                                    </div> --}}
                                    <!-- notice end -->
                                </div>
                                <!-- view_more_button area start -->
                                <div class="view_more_button">
                                    <a href="{{ route('notice_page') }}">view more</a>
                                </div>
                                <!-- view_more_button area end -->
                            </div>
                            <!-- notice_area_all_content end -->

                        </div>
                    </div>
                    <!-- notice_area end-->
                </div>
            </div>

        </div>
    </section>
</div>
