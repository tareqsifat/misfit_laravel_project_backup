<div>
    {{-- In work, do what you enjoy. --}}
    <div id="recipe">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li class="active">Blog</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Blog Area Start-->
        <div class="blog-area mt-4">
            <div class="container">
                <div class="row">
                    <!--Blog Post Start-->
                    <div class="col-lg-9 ml-auto mr-auto">
                        <div class="blog_area">
                            @foreach ($blogs as $blog)    
                                <article class="blog_single">
                                    <header class="entry-header">
                                        <h2 class="entry-title">

                                            <a href="{{ route('getSingleBlog', $blog->blog_slug) }}">{{ $blog->title }}</a>
                                        </h2>
                                        <span class="post-author">
                                        <span class="post-by"> Posts by : </span> admin </span>
                                        <span class="post-separator">|</span>
                                        <span class="blog-post-date"><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d F y') }}</span>
                                    </header>
                                    <div class="post-thumbnail">
                                        <a href="{{ route('getSingleBlog', $blog->blog_slug) }}">
                                            <img src="{{ asset('assets/uploads/slider') }}/{{ $blog->image }}" width="60%" :alt="blog.title">
                                        </a>
                                    </div>
                                    <div class="postinfo-wrapper">
                                        <div class="post-info">
                                            <div class="entry-summary">

                                                <p>{!! \Illuminate\Support\Str::limit($blog->description,50,'...') !!}</p>
                                                <a href="{{ route('getSingleBlog', $blog->blog_slug) }}" class="default-btn">Read More</a>
                                                <!--<div class="social-sharing">
                                                    <div class="widget widget_socialsharing_widget">
                                                        <h3 class="widget-title">Share this post</h3>
                                                        <ul class="blog-social-icons">
                                                            <li>
                                                                <a target="_blank" title="Facebook" href="#" class="facebook social-icon">
                                                                    <i class="fab fa-facebook"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a target="_blank" title="twitter" href="#" class="twitter social-icon">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a target="_blank" title="pinterest" href="#" class="pinterest social-icon">
                                                                    <i class="fab fa-pinterest"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a target="_blank" title="linkedin" href="#" class="linkedin social-icon">
                                                                    <i class="fab fa-linkedin"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--start comment in post page -->
                                    <!--<a class="comment" href="#">3 comments</a>-->
                                    <!--start comment in post page -->
                                </article>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="ml-auto mr-auto">
                                <!--Pagination Start-->
                                <div class="pagination-product d-md-flex justify-content-md-between align-items-center">
                                    <!--<div class="showing-product">
                                        <p> Showing 1-10 of 15 item(s) </p>
                                    </div>-->
                                    <div class="page-list shop-paginate">
                                        {{-- <el-pagination class="text-center mt-3"
                                               background
                                               @current-change="paginationChange"
                                               :current-page.sync="currentPage"
                                               :page-size="blogs.per_page"
                                               layout="prev, pager, next"
                                               :total="blogs.total">
                                        </el-pagination> --}}
                                        {{ $blogs->onEachSide(3)->links() }}
                                    </div>
                                </div>
                                <!--Pagination End-->
                            </div>
                        </div>
                    </div>
                    <!--Blog Post End-->
                </div>
            </div>
        </div>
        <!--Blog Area End-->
    </div>
</div>
