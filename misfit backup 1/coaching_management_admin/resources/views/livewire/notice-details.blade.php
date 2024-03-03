<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <section class="notice_details_page">
        <div class="container">
            <div class="notice_details_page_content">
                <!-- notice start -->
                <div class="notice">
                    <div class="notice_date">
                        <p>
                            <span class="day">
                                @php
                                    $day = $notice->created_at->format('d');
                                @endphp
                                {{ $day }} 
                            </span>
                            <span class="month">
                                @php
                                    $month = $notice->created_at->format('F');
                                @endphp
                                {{ $month }}
                            </span>
                            <span class="year">
                                @php
                                    $year = $notice->created_at->format('Y');
                                @endphp
                                {{ $year }}    
                            </span>
                        </p>
                    </div>
                    <div class="notice_title">
                        <span>{{ $notice->title }}</span>
                    </div>
                    <div class="notice_details">
                        <p class="paragraph_area">{{ $notice->description }}</p>
                    </div>
                </div>
                <!-- notice end -->
            </div>
        </div>
    </section>
</div>
