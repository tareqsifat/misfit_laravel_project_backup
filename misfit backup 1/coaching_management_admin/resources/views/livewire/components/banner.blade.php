<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <section class="banner_area">
        <div class="banner">
            <div class="container">
                <!-- banner_content start -->
                <div class="banner_content">
                    <div class="banner_title">
                        <h1>{{ $banner->title }} <span>{{ $banner->title_highlight }} </span></h1>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="banner_discription">
                                <p>{{ $banner->paragraph }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="banner_button_area">
                        <a href="{{ $banner->link }}">
                            <span> start a course</span>
                        </a>
                    </div>
                </div>
                <!-- banner_content end -->
            </div>
        </div>
    </section>
</div>
