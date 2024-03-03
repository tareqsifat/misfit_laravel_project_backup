@extends('web.layout.index')

@section('content')
{{-- {{$blog}} --}}

<div class="page-heading-section section bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-2.webp" data-overlay="50">
    <div class="container">
        <div class="page-heading-content text-center">
            <h3 class="title">Blog</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Blog</li>
            </ol>
        </div>
    </div>
</div>
<div class="section section-padding">
    <div class="container">
        <div class="row mb-n5">

            {{-- <div class="col-lg-8 col-12 mb-5 pe-lg-5"> --}}
            <div class="col-12  mb-5">

                <!-- Blog Wrapper Start -->
                <div class="blog-wrap row">

                    <!-- Blog Single Start -->
                    <div class="col-12">
                        <div class="blog blog-single">
                            <div class="media">
                                <img src="/{{ $blog->image }}" alt="{{$blog->title}}">
                            </div>
                            <div class="content">
                                <h6 class="title">{{ $blog->title }}</h6>
                                <ul class="meta">
                                    <li>Posted on {{ $blog->created_at->format('M d, Y') }}</li>
                                    <li><a href="#">3 Comments</a></li>
                                </ul>
                                <div class="desc">
                                    {!! $blog->description !!}
                                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi enim corporis totam. Deserunt, aperiam. Neque quibusdam nihil sunt, soluta unde inventore odit ea consequatur voluptatem doloribus assumenda, nisi expedita ipsam eaque harum. Quam, ipsa? Nihil, harum, veniam dignissimos laudantium nobis libero a nostrum quis voluptatum beatae pariatur hic cum odio natus, tenetur officia similique incidunt!</p>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio totam ab reiciendis distinctio dicta deserunt? Culpa ex quam eligendi sapiente quo laboriosam velit pariatur obcaecati omnis soluta necessitatibus, fugiat minima?</p>
                                    <blockquote class="blockquote">
                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas aspernatur nemo pariatur eius corrupti cupiditate rem molestias voluptatem explicabo eum.</p>
                                        <footer class="blockquote-footer"> <cite title="Source Title">Source Title</cite></footer>
                                    </blockquote>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusantium facilis molestiae qui quod rerum numquam, neque inventore non eius reiciendis, necessitatibus exercitationem, maxime natus dignissimos saepe veritatis id recusandae distinctio doloremque aliquam provident similique consequatur. A cupiditate tempore repellat sint.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore sint quaerat dolore, ipsa voluptates illo ullam sed numquam! Pariatur excepturi reiciendis sequi dolorum placeat quaerat at, nostrum iusto soluta corrupti.</p>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet, omnis aliquam! Porro minima quasi repudiandae ad officia expedita quae? Aspernatur ipsam provident ullam architecto natus, accusantium asperiores earum totam quaerat odit eligendi? Sunt dolore saepe minima reiciendis nesciunt odio tempora repudiandae non veritatis esse officia maxime, voluptatum reprehenderit? Sint sapiente omnis dolore error ipsa quibusdam obcaecati nisi accusamus dolorum reiciendis a quos, maiores dignissimos nostrum aspernatur, pariatur quia amet. Praesentium nobis ullam quae accusantium recusandae.</p> --}}
                                </div>
                                <div class="foot row justify-content-between align-items-start mb-n2">
                                    <div class="blog-tags col-auto mb-2">
                                        <ul>
                                            <li><strong>Tags:</strong></li>
                                            <li><a href="#">tips</a></li>
                                            <li><a href="#">job</a></li>
                                            <li><a href="#">questions</a></li>
                                            <li><a href="#">interview</a></li>
                                        </ul>
                                    </div>
                                    <div class="blog-share col-auto mb-2">
                                        <ul>
                                            <li><strong>Share:</strong></li>
                                            <li><a target="_blank" rel="noopener" href="https://www.facebook.com/" class="fa fa-facebook"></a></li>
                                            <li><a target="_blank" rel="noopener" href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                            <li><a target="_blank" rel="noopener" href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                            <li><a target="_blank" rel="noopener" href="https://www.pinterest.com/" class="fa fa-pinterest-p"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Blog Single End -->

                    <!-- Blog Navigation Start -->
                    <div class="col-12">
                        <ul class="blog-navigation row mx-0">
                            <li class="col-sm-6 col-12"><a href="#" class="prev-blog">7 Careers To Consider If You Love Traveling</a></li>
                            <li class="col-sm-6 col-12 mt-3 mt-sm-0"><a href="#" class="next-blog">When the Perfect Candidate Turns Out To Be an Imperfect Fit</a></li>
                        </ul>
                    </div>
                    <!-- Blog Navigation End -->

                    <!-- Blog Comments Start -->
                    <div class="col-12">
                        <div class="blog-comments">
                            <h6 class="mb-4">3 Comments</h6>
                            <ul class="comment-list">
                                <li>
                                    <div class="comment">
                                        <div class="image"><img src="assets/images/authors/author-2.jpg" alt=""></div>
                                        <div class="content">
                                            <div class="head">
                                                <h6 class="name">Harold McCoy</h6>
                                                <span class="date">25 Jan, 2023</span>
                                            </div>
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae quibusdam deserunt, quaerat mollitia corrupti pariatur?</p>
                                            <a href="#" class="reply"><i class="fa fa-reply"></i> reply</a>
                                        </div>
                                    </div>
                                    <ul class="child-comment">
                                        <li>
                                            <div class="comment">
                                                <div class="image"><img src="assets/images/authors/author-3.jpg" alt=""></div>
                                                <div class="content">
                                                    <div class="head">
                                                        <h6 class="name">Ronald Wright</h6>
                                                        <span class="date">25 Jan, 2023</span>
                                                    </div>
                                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae quibusdam deserunt, quaerat mollitia corrupti pariatur?</p>
                                                    <a href="#" class="reply"><i class="fa fa-reply"></i> reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment">
                                        <div class="image"><img src="assets/images/authors/author-1.jpg" alt=""></div>
                                        <div class="content">
                                            <div class="head">
                                                <h6 class="name">Sharon Harper</h6>
                                                <span class="date">25 Jan, 2023</span>
                                            </div>
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae quibusdam deserunt, quaerat mollitia corrupti pariatur?</p>
                                            <a href="#" class="reply"><i class="fa fa-reply"></i> reply</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Blog Comments End -->

                    <!-- Blog Comments Form Start -->
                    <div class="col-12">
                        <div class="comment-form">
                            <h6 class="mb-4">Drop Your Comment</h6>
                            <form action="#">
                                <div class="row mb-n3">
                                    <div class="col-md-6 col-12 mb-3"><input type="text" placeholder="Your Name"></div>
                                    <div class="col-md-6 col-12 mb-3"><input type="email" placeholder="Your Email"></div>
                                    <div class="col-12 mb-3"><textarea rows="4" placeholder="Comment"></textarea></div>
                                    <div class="col-12 mb-3"><input type="submit" class="btn btn-primary" value="Submit now"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Blog Comments Form End -->

                </div>
                <!-- Blog Wrapper End -->

            </div>

            <!-- Blog Sidebar Wrap Start -->
            {{-- <div class="col-lg-4 col-12 mb-5">
                <div class="sidebar-wrap">
                    <!-- Sidebar (Search) Start -->
                    <div class="sidebar-widget">
                        <div class="inner">
                            <h6 class="title">Search Keywords</h6>
                            <form action="#">
                                <input type="text" placeholder="Search">
                            </form>
                        </div>
                    </div>
                    <!-- Sidebar (Search) End -->

                    <!-- Sidebar (Recent Posts) Start -->
                    <div class="sidebar-widget">
                        <div class="inner">
                            <h6 class="title">Recent Posts</h6>
                            <ul class="sidebar-post">
                                <li>
                                    <a href="blog-single.html" class="image"><img src="assets/images/blog/sidebar-1.jpg" alt=""></a>
                                    <a href="blog-single.html" class="title">The Top 5 Job Interview Questions For IT Professional</a>
                                </li>
                                <li>
                                    <a href="blog-single.html" class="image"><img src="assets/images/blog/sidebar-2.jpg" alt=""></a>
                                    <a href="blog-single.html" class="title">7 Careers To Consider If You Love Traveling</a>
                                </li>
                                <li>
                                    <a href="blog-single.html" class="image"><img src="assets/images/blog/sidebar-3.jpg" alt=""></a>
                                    <a href="blog-single.html" class="title">When the Perfect Candidate Turns Out To Be an Imperfect Fit</a>
                                </li>
                                <li>
                                    <a href="blog-single.html" class="image"><img src="assets/images/blog/sidebar-4.jpg" alt=""></a>
                                    <a href="blog-single.html" class="title">5 ways to keep calm and carry on during your job search</a>
                                </li>
                                <li>
                                    <a href="blog-single.html" class="image"><img src="assets/images/blog/sidebar-5.jpg" alt=""></a>
                                    <a href="blog-single.html" class="title">Should I reapply for a job vacancy that was reposted?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar (Recent Posts) End -->

                    <!-- Sidebar (Recent Comments) Start -->
                    <div class="sidebar-widget">
                        <div class="inner">
                            <h6 class="title">Recent Comments</h6>
                            <ul class="sidebar-list sidebar-list-comment">
                                <li>Theresa Tran on <a href="blog-single.html">The Top 5 Job Interview Questions For IT Professional</a>
                                </li>
                                <li>admin on <a href="blog-single.html">7 Careers To Consider If You Love Traveling</a>
                                </li>
                                <li>Jessica Brewer on <a href="blog-single.html">When the Perfect Candidate Turns Out To Be an Imperfect Fit</a>
                                </li>
                                <li>Sharon Hall on <a href="blog-single.html">5 ways to keep calm and carry on during your job search</a>
                                </li>
                                <li>admin on <a href="blog-single.html">Should I reapply for a job vacancy that was reposted?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar (Recent Comments) End -->

                    <!-- Sidebar (Category) Start -->
                    <div class="sidebar-widget">
                        <div class="inner">
                            <h6 class="title">Category</h6>
                            <ul class="sidebar-list">
                                <li><a href="#">Business</a>
                                </li>
                                <li><a href="#">Design & Creative</a>
                                </li>
                                <li><a href="#">Education</a>
                                </li>
                                <li><a href="#">IT & Computer</a>
                                </li>
                                <li><a href="#">Photography</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar (Category) End -->

                    <!-- Sidebar (Archives) Start -->
                    <div class="sidebar-widget">
                        <div class="inner">
                            <h6 class="title">Archives</h6>
                            <ul class="sidebar-list">
                                <li><a href="#">September 2023</a></li>
                                <li><a href="#">August 2023</a></li>
                                <li><a href="#">June 2023</a></li>
                                <li><a href="#">May 2023</a></li>
                                <li><a href="#">April 2023</a></li>
                                <li><a href="#">March 2023</a></li>
                                <li><a href="#">February 2023</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar (Archives) End -->
                </div>
            </div> --}}
            <!-- Blog Sidebar Wrap End -->

        </div>

    </div>
</div>
@endsection