<div>
    {{-- Success is as dangerous as failure. --}}
    <section class="news_and_event_details_page">
        <div class="container">
            <div class="news_and_event_details_page_content">
                <!-- notice start -->
                <div class="news_and_event">
                    <div class="news_image_and_date_area">
                        <div class="news_image_area">
                            <div class="news_image"
                                style="background-image: url('/{{ $news_event->image }}');">
                            </div>
                        </div>

                        <div class="news_and_event_date">
                            <p>
                                <span class="day">
                                    @php
                                        $day = $news_event->created_at->format('d');
                                    @endphp
                                    {{ $day }} 
                                </span>
                                <span class="month">
                                    @php
                                        $month = $news_event->created_at->format('F');
                                    @endphp
                                    {{ $month }}
                                </span>
                                <span class="year">
                                    @php
                                        $year = $news_event->created_at->format('Y');
                                    @endphp
                                    {{ $year }}    
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="news_and_event_title">
                        <span>{{ $news_event->title }}</span>
                    </div>
                    <div class="news_and_event_details">
                        <p class="paragraph_area">{{ $news_event->description }}</p>
                        
                    </div>
                </div>
                <!-- notice end -->
            </div>
        </div>
    </section>
</div>
