@extends('website.layout.webstie')

@section('content')
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="single-post mb-0">

                <!-- Single Post
                ============================================= -->
                <div class="entry clearfix">

                    <!-- Entry Title
                    ============================================= -->
                    <div class="entry-title">
                        <h2>{{ $blogs->title }}</h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <div class="entry-meta">
                        <ul>
                            <li><i class="icon-calendar3"></i> {{ $blogs->created_at->format('d M Y h:i:s a') }}</li>
                            <li><a href="#"><i class="icon-user"></i>{{ $blogs->user_info->name }}</a></li>
                            <li><i class="icon-folder-open"></i> <a href="#">{{ $blogs->category_info->name }}</a>, <a href="#">{{ $blogs->subcategory_info->name }}</a></li>
                            <li><a href="#commentlist"><i class="icon-comments"></i>{{ $count }} {{ $count>1 ? 'comments' : 'comment' }}</a></li>
                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                        </ul>
                    </div><!-- .entry-meta end -->

                    <!-- Entry Image
                    ============================================= -->
                    <div class="entry-image bottommargin">
                        <a href="#"><img src='{{ asset("/uploads/blogs/$blogs->image") }}' alt="{{ $blogs->image }}"></a>
                    </div><!-- .entry-image end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content mt-0">

                        <p>{{ $blogs->body }}</p>

                        
                        <!-- Post Single - Content End -->

                        <!-- Tag Cloud
                        ============================================= -->
                        <div class="tagcloud clearfix bottommargin">
                            @foreach (explode(',', $blogs->tags) as $tag)
                                <a href="#">{{ $tag }}</a>
                                {{-- <a href="#">information</a>
                                <a href="#">media</a>
                                <a href="#">press</a>
                                <a href="#">gallery</a>
                                <a href="#">illustration</a> --}}
                            @endforeach
                        </div><!-- .tagcloud end -->

                        <div class="clear"></div>

                        <!-- Post Single - Share
                        ============================================= -->
                        <div class="si-share border-0 d-flex justify-content-between align-items-center">
                            <span>Share this Post:</span>
                            <div>
                                <div class="fb-share-button" data-href="http://127.0.0.1:8000/blog/10614329ca70578-your-most-unhappy-customers" data-layout="button" data-size="small">
                                    <a target="entry-content" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2Fblog%2F10614329ca70578-your-most-unhappy-customers&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                                </div>
                                <a href="#" class="social-icon si-borderless si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-pinterest">
                                    <i class="icon-pinterest"></i>
                                    <i class="icon-pinterest"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-rss">
                                    <i class="icon-rss"></i>
                                    <i class="icon-rss"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-email3">
                                    <i class="icon-email3"></i>
                                    <i class="icon-email3"></i>
                                </a>
                            </div>
                        </div><!-- Post Single - Share End -->

                    </div>
                </div><!-- .entry end -->

                <!-- Post Navigation
                ============================================= -->
                <div class="row justify-content-between col-mb-30 post-navigation">
                    @if($prev_post->all())
                        @foreach ($prev_post as $item)
                            <div class="col-12 col-md-auto text-center">
                                <a href="{{ route('website_blog_show',$item->slug) }}">&lArr; {{ $item->title }}</a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 col-md-auto text-center">
                        </div>   
                    @endif
                       

                    <div class="col-12 col-md-auto text-center">
                        @foreach ($next_post as $item)
                            <a href="{{ route('website_blog_show',$item->slug) }}"> {{ $item->title }}&rArr;</a>
                        @endforeach
                        {{-- <a href="#">This is an Embedded Audio Post &rArr;</a> --}}
                    </div>
                </div><!-- .post-navigation end -->

                <div class="line"></div>

                <!-- Post Author Info
                ============================================= -->
                {{-- <div class="card">
                    <div class="card-header"><strong>Posted by <a href="#">John Doe</a></strong></div>
                    <div class="card-body">
                        <div class="author-image">
                            <img src="images/author/1.jpg" alt="Image" class="rounded-circle">
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eveniet, eligendi et nobis neque minus mollitia sit repudiandae ad repellendus recusandae blanditiis praesentium vitae ab sint earum voluptate velit beatae alias fugit accusantium laboriosam nisi reiciendis deleniti tenetur molestiae maxime id quaerat consequatur fugiat aliquam laborum nam aliquid. Consectetur, perferendis?
                    </div>
                </div><!-- Post Single - Author End --> --}}

                <div class="line"></div>

                <h4>Related Posts:</h4>

                <div class="related-posts row posts-md col-mb-30">
                    @foreach ($related_post as $item)
                        @if ($item->id != $blogs->id) {{-- this if is not to show the post of this page again in the related post --}}
                            <div class="entry col-12 col-md-6">
                                <div class="grid-inner row align-items-center gutter-20">
                                    <div class="col-4 col-xl-5">
                                        <div class="entry-image">
                                            <a href="#"><img src='{{ asset("/uploads/blogs/$item->image") }}' alt="{{ $item->image }}"></a>
                                        </div>
                                    </div>
                                    <div class="col-8 col-xl-7">
                                        <div class="entry-title title-xs nott">
                                            <h3><a href="#">{{ $item->title }}</a></h3>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li><i class="icon-calendar3"></i>{{ $item->created_at->format('d M Y h:i:s a') }}</li>
                                                <li><a href="#"><i class="icon-comments"></i>12</a></li>
                                            </ul>
                                        </div>
                                        <div class="entry-content d-none d-xl-block">{{ \Illuminate\Support\Str::limit($item->body, 60) }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Comments
                ============================================= -->
                <div id="comments" class="clearfix">

                    @if ($count != 0)
                        <h3 id="comments-title"><span>{{ $count }}</span> {{ $count<2 ? 'Comment' : 'Comments'}}</h3>                        
                        <ol class="commentlist clearfix" id="commentlist">
                            @foreach ($blogs->comments as $item)
                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                    <div id="comment-1" class="comment-wrap clearfix">

                                        <div class="comment-meta">

                                            <div class="comment-author vcard">

                                                <span class="comment-avatar clearfix">
                                                <img alt='Image' src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' class='avatar avatar-60 photo avatar-default' height='60' width='60' /></span>

                                            </div>

                                        </div>

                                        <div class="comment-content clearfix">

                                            <div class="comment-author">{{ $item->name }}<span><a href="#" title="Permalink to this comment">{{ $item->created_at->format( 'd M Y h:i:s a' ) }}</a></span></div>

                                            <p>{{ $item->body }}</p>

                                            {{-- <button  style="padding: 20px" class=''> --}}
                                                <i  class="icon-reply btn btn-info"  onclick="document.getElementById('reply_form').style.display = 'block'"></i>
                                            {{-- </button> --}}

                                        </div>
                                        <div class="clear"></div>
                                        <div id="reply_form" style="display: none">

                                            <h3>Leave a <span>Reply</span></h3>
                    
                                            {{-- <form class="row" action="#" method="post" id="commentform"> --}}
                                            <form method="POST" class="insert_form row" action="{{ route('reply.store') }}" enctype="multipart/form-data" id="horizontal-form">
                                                @csrf
                                                <div class="col-md-4 form-group">
                                                    <label for="author">Name</label>
                                                    <input type="text" name="name" id="author" value="" size="22" tabindex="1" class="sm-form-control" />
                                                </div>
                    
                                                <div class="col-md-4 form-group" style="display: none">
                                                    <select name="blog_id" id="">
                                                        <option value="{{ $blogs->id }}"></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 form-group" style="display: none">
                                                    <select name="comment_id" id="">
                                                        <option value="{{ $item->id }}"></option>
                                                    </select>
                                                </div>
                    
                                                <div class="col-md-4 form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" value="" size="22" tabindex="2" class="sm-form-control" />
                                                </div>
                    
                                                <div class="col-md-4 form-group">
                                                    <label for="url">Website</label>
                                                    <input type="text" name="website" id="url" value="" size="22" tabindex="3" class="sm-form-control" />
                                                </div>
                    
                                                <div class="w-100"></div>
                    
                                                <div class="col-12 form-group">
                                                    <label for="comment">Reply</label>
                                                    <textarea name="body" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
                                                </div>
                    
                                                <div class="col-12 form-group">
                                                    <button name="submit" type="submit" id="submit-button" tabindex="5" value="no_value" class="button button-3d m-0">Submit reply</button>
                                                </div>
                                            </form>
                    
                                        </div>
                                    </div>

                                    @if (!empty($item->reply->all()))
                                        {{-- <p>{{ $item->reply }}</p> --}}
                                        <ul class='children'>
                                            @foreach ($item->reply as $items)
                                                <li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">

                                                    <div id="comment-3" class="comment-wrap clearfix">

                                                        <div class="comment-meta">

                                                            <div class="comment-author vcard">

                                                                <span class="comment-avatar clearfix">
                                                                <img alt='Image' src='https://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=40&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D40&amp;r=G' class='avatar avatar-40 photo' height='40' width='40' /></span>

                                                            </div>

                                                        </div>

                                                        <div class="comment-content clearfix">

                                                            <div class="comment-author"><a href='#' rel='external nofollow' class='url'>{{ $items->name }}</a><span><a href="#" title="Permalink to this comment">{{ $items->created_at->format('d M Y h:i:s a') }}</a></span></div>

                                                            <p>{{ $items->body }}</p>

                                                            {{-- <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a> --}}

                                                        </div>

                                                        <div class="clear"></div>

                                                    </div>

                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        
                                    @endif
                                    {{-- Comment:reply --}}
                                    
                                </li>
                            @endforeach
                            

                            {{-- <li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">

                                <div id="comment-2" class="comment-wrap clearfix">

                                    <div class="comment-meta">

                                        <div class="comment-author vcard">

                                            <span class="comment-avatar clearfix">
                                            <img alt='Image' src='https://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G' class='avatar avatar-60 photo' height='60' width='60' /></span>

                                        </div>

                                    </div>

                                    <div class="comment-content clearfix">

                                        <div class="comment-author"><a href='https://themeforest.net/user/semicolonweb' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                                        <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                                        <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>

                                    </div>

                                    <div class="clear"></div>

                                </div>

                            </li> --}}

                        </ol><!-- .commentlist end -->

                        <div class="clear"></div>

                        {{-- comment_Session_message --}}
                        @if (session()->has('alert-success'))
                            <div class="text-theme-9 mt-2">
                                {{ session('alert-success') }}
                            </div>
                        @endif
                    @endif

                    <!-- Comments List
                    ============================================= -->
                    
                    
                    <!-- Comment Form
                    ============================================= -->
                    <div id="respond">

                        <h3>Leave a <span>Comment</span></h3>

                        {{-- <form class="row" action="#" method="post" id="commentform"> --}}
                        <form method="POST" class="insert_form row" action="{{ route('comments.store') }}" enctype="multipart/form-data" id="horizontal-form">
                            @csrf
                            <div class="col-md-4 form-group">
                                <label for="author">Name</label>
                                <input type="text" name="name" id="author" value="" size="22" tabindex="1" class="sm-form-control" />
                            </div>

                            <div class="col-md-4 form-group" style="display: none">
                                <select name="blog_id" id="">
                                    <option value="{{ $blogs->id }}"></option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="" size="22" tabindex="2" class="sm-form-control" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="url">Website</label>
                                <input type="text" name="website" id="url" value="" size="22" tabindex="3" class="sm-form-control" />
                            </div>

                            <div class="w-100"></div>

                            <div class="col-12 form-group">
                                <label for="comment">Comment</label>
                                <textarea name="body" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
                            </div>

                            <div class="col-12 form-group">
                                <button name="submit" type="submit" id="submit-button" tabindex="5" value="no_value" class="button button-3d m-0">Submit Comment</button>
                            </div>
                        </form>

                    </div><!-- #respond end -->
                    

                </div><!-- #comments end -->

            </div>

        </div>

    </div>
</section>
@endsection