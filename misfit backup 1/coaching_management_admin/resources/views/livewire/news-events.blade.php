<div>
    {{-- Stop trying to control. --}}
    <section class="news_and_event_page">
        <!-- notice_title start -->
        <div class="news_and_event_title">
            <h2>news & event</h2>
        </div>
        <!-- notice_title end -->
        <!-- search_area start -->
        <section class="search_area">
            <div class="container">
                <div class="search_content">
                    <form method="" action="#" class="search_area">
                        <label for="#">search</label>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search...">
                        <button class="button_area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <!-- search_area end -->
        <!-- categories_and_popular_tags_area start -->
        <section class="categories_and_popular_tags_area">
            <div class="container">
                <div class="categories_and_popular_tags_content">
                    {{-- <div class="row">
                        <!-- categories_area start -->
                        <div class="col-md-6">
                            <div class="categories_and_popular categories_area">
                                <div class="title categories_title">
                                    <h4>categories</h4>
                                </div>
                                <div class="item categories_item">
                                    <ul>
                                        <li>
                                            <a href="#">admition</a>
                                        </li>
                                        <li>
                                            <a href="#">sports</a>
                                        </li>
                                        <li>
                                            <a href="#">exam</a>
                                        </li>
                                        <li>
                                            <a href="#">sports</a>
                                        </li>
                                        <li>
                                            <a href="#">culcaral</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- categories_area end -->
                        <!-- popular_tag_area start -->
                        <div class="col-md-6">
                            <div class="categories_and_popular popular_tag_area">
                                <div class="title popular_tag_title">
                                    <h4>popular tag</h4>
                                </div>
                                <div class="item popular_tag_item">
                                    <ul>
                                        <li>
                                            <a href="#">exam</a>
                                        </li>
                                        <li>
                                            <a href="#">result</a>
                                        </li>
                                        <li>
                                            <a href="#">holiday</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- popular_tag_area end -->
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- categories_and_popular_tags_area end -->
        <!-- notice_all_area start -->
        <section class="news_and_events_all_area">
            <div class="container">
                <div class="news_and_events_all_content row">
                    @foreach ($news as $item)
                        <div class="news_and_events col-xl-6">
                            <div class="news_and_events_date">
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
                            <div class="image_and_news_event_details">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="image_area">
                                            <a href="{{ route('news_event_details_page', $item->id) }}" class="image" style="background-image: url('/{{ $item->image }}');"></a>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-9">
                                        <div class="news_event_details">
                                            <div class="news_title">
                                                <a href="{{ route('news_event_details_page', $item->id) }}">{{ $item->title }}</a>
                                            </div>
                                            <div class="news_details">
                                                <p>
                                                    {{ \Illuminate\Support\Str::limit($item->description, 120) }}
                                                </p>
                                            </div>
                                            <a href="{{ route('news_event_details_page', $item->id) }}">read more <span class="dote">...</span> </a>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- notice_all_area end -->
        <!-- pegination_area start -->
        <section class="pegination_area">
            <div class="container">
                <div class="pegination_content">
                    {{-- <ul>
                        <li>
                            <a class="previous_next" href="#">previous</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">1</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">2</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">3</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">4</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">5</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">6</a>
                        </li>
                        <li>
                            <a class="pegination_number" href="#">7</a>
                        </li>

                        <li>
                            <a class="previous_next" href="#">next</a>
                        </li>
                    </ul> --}}
                    {{ $news->links() }}
                </div>
            </div>
            
            {{-- <div class="pagination">
                
            </div> --}}
        </section>
        <!-- pegination_area end -->
    </section>
</div>
