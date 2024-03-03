<div>
    {{-- Stop trying to control. --}}
    <section class="notice_page">
        <!-- notice_title start -->
        <div class="notice_title">
            <h2>notice</h2>
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
                    <div class="row">
                        <!-- categories_area start -->
                        {{-- <div class="col-md-6">
                            <div class="categories_and_popular categories_area">
                                <div class="title categories_title">
                                    <h4>categories</h4>
                                </div>
                                <div class="item categories_item">
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
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>
                                        <li>
                                            <a href="#">program</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <!-- categories_area end -->
                        <!-- popular_tag_area start -->
                        {{-- <div class="col-md-6">
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
                        </div> --}}
                        <!-- popular_tag_area end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- categories_and_popular_tags_area end -->
        <!-- notice_all_area start -->
        <section class="notice_all_area">
            <div class="container">
                <div class="notice_all_content row">
                    <!-- notice start -->
                    @foreach ($notices as $notice)    
                        <div class="notice col-xl-6">
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
                            <div class="notice_details">
                                <a href="{{ route('notice_details_page', $notice->id) }}">{{ $notice->title }}</a><br>
                                <p>{{ \Illuminate\Support\Str::limit($notice->description, 120) }}</p>
                                <a href="{{ route('notice_details_page', $notice->id) }}">read more <span class="dote">...</span> </a>
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
                    {{ $notices->links() }}
                </div>
            </div>
        </section>
        <!-- pegination_area end -->
    </section>
</div>
