<template>
    <div id="single_blog">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li>
                                    <router-link :to="{name: 'landing'}">Home </router-link>
                                    <router-link :to="{name: 'blog'}">/ Blog</router-link>
                                </li>
                                <li class="active">{{ blog.title }}</li>
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
                            <article class="blog_single blog-details">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        {{ blog.title }}
                                    </h2>
                                    <span class="post-author">
                                    <span class="post-by"> Posts by : </span> admin </span>
                                    <span class="post-separator">|</span>
                                    <span class="blog-post-date"><i class="fas fa-calendar-alt"></i> {{ blog.created_at | timeFormat }}</span>
                                </header>
                                <div class="post-thumbnail img-full">
                                    <img :src="`/assets/uploads/blog/${blog.image}`" :alt="blog.title">
                                </div>
                                <div class="postinfo-wrapper">
                                    <div class="post-info">
                                        <div class="entry-summary blog-post-description">
                                            <!-- <p v-html="blog.description"></p> -->

                                            <p v-if="blogproduct" v-html="blogproduct"></p>
                                            <p v-else v-html="blog.description"></p>
                                            <!--Blog Post Tag-->
                                            <!--<div class="single-post-tag">
                                                <a href="#">3 comments</a>
                                                Tags:
                                                <a href="#">fashion</a>,
                                                <a href="#">t-shirt</a>,
                                                <a href="#">white</a>,
                                            </div>-->
                                            <!--Blog Post Tag-->
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
                            </article>
                            <!--<div class="relatedposts">
                                <h3>Related posts</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="relatedthumb">
                                            <div class="image img-full">
                                                <a href="#"><img src="img/blog/blog2.jpg" alt=""></a>
                                            </div>
                                            <h4><a href="#">Post with Gallery</a></h4>
                                            <span class="rl-post-date">December 1, 2018</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="relatedthumb">
                                            <div class="image img-full">
                                                <a href="#"><img src="img/blog/blog4.jpg" alt=""></a>
                                            </div>
                                            <h4><a href="#">Post with Gallery</a></h4>
                                            <span class="rl-post-date">December 1, 2018</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="relatedthumb">
                                            <div class="image img-full">
                                                <a href="#"><img src="img/blog/blog5.jpg" alt=""></a>
                                            </div>
                                            <h4><a href="#">Post with Gallery</a></h4>
                                            <span class="rl-post-date">December 1, 2018</span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <!--Comment Area Start-->
                        <!--<div class="comments-area mt-80">
                            <h3>3 comments</h3>
                            <ol class="commentlist">
                                <li>
                                    <div class="single-comment">
                                        <div class="comment-avatar img-full">
                                            <img src="img/icon/author.png" alt="">
                                        </div>
                                        <div class="comment-info">
                                            <a href="#">admin</a>
                                            <div class="reply">
                                                <a href="#">Reply</a>
                                            </div>
                                            <span class="date">October 6, 2014 at 1:38 am</span>
                                            <p>just a nice post</p>
                                        </div>
                                    </div>
                                    <ol>
                                        <li>
                                            <div class="single-comment">
                                                <div class="comment-avatar img-full">
                                                    <img src="img/icon/admin.jpg" alt="">
                                                </div>
                                                <div class="comment-info">
                                                    <a href="#">admin</a>
                                                    <div class="reply">
                                                        <a href="#">Reply</a>
                                                    </div>
                                                    <span class="date">October 6, 2014 at 1:38 am</span>
                                                    <p>just a nice post</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                            <ol class="commentlist">
                                <li>
                                    <div class="single-comment">
                                        <div class="comment-avatar img-full">
                                            <img src="img/icon/author.png" alt="">
                                        </div>
                                        <div class="comment-info">
                                            <a href="#">admin</a>
                                            <div class="reply">
                                                <a href="#">Reply</a>
                                            </div>
                                            <span class="date">October 6, 2014 at 1:38 am</span>
                                            <p>just a nice post</p>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <div class="comment-box mt-30 mb-40">
                            <h3>Leave a Comment</h3>
                            <form action="#">
                                <p class="comment-note"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <label>Comment*</label>
                                            <textarea name="commenter-message" placeholder="Message" id="commenter-message" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input">
                                            <label>Name*</label>
                                            <input name="commenter-name" id="commenter-name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input">
                                            <label>Email*</label>
                                            <input name="commenter-email" id="commenter-email" type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input">
                                            <label>Website*</label>
                                            <input name="commenter-url" id="commenter-url" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <button class="default-btn" type="submit">Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>-->
                        <!--Comment Area End-->
                    </div>
                    <!--Blog Post End-->
                    <!--Blog Sidebar Start-->
                    <!--<div class="col-lg-3">
                        <div class="blog_sidebar">
                            <div class="row_products_side">
                                <div class="product_left_sidbar">
                                    <div class="product-filter  mb-30">
                                        <h5>Search </h5>
                                        <div class="search__sidbar">
                                            <div class="input_form">
                                                <input id="search_input" name="s" placeholder="Search..." class="input_text" type="text">
                                                <button id="blogsearchsubmit" type="submit" class="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-filter  mb-30">
                                        <h5>Blog Archives </h5>
                                        <div class="blog_Archives__sidbar">
                                            <ul>
                                                <li>
                                                    <a href="#">March 2015</a>&nbsp;(1)</li>
                                                <li>
                                                    <a href="#">December 2014</a>&nbsp;(3)</li>
                                                <li>
                                                    <a href="#">November 2014</a>&nbsp;(4)</li>
                                                <li>
                                                    <a href="#">September 2014</a>&nbsp;(1)</li>
                                                <li>
                                                    <a href="#">August 2014</a>&nbsp;(1)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-filter  mb-30">
                                        <h5>Recent Posts</h5>
                                        <div class="blog_Archives__sidbar">
                                            <ul>
                                                <li> <a href="#">Blog image post</a>&nbsp;(1)</li>
                                                <li> <a href="#">Post with Gallery</a>&nbsp;(3)</li>
                                                <li><a href="#">Post with Audio</a>&nbsp;(4)</li>
                                                <li><a href="#">Post with Video</a>&nbsp;(1)</li>
                                                <li><a href="#">Post with Text</a>&nbsp;(1)</li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-filter  mb-30">
                                        <div class="sidebar-banner single-banner">
                                            <div class="banner-img">
                                                <a href="#"><img src="img/banner/shop-sidebar.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-filter mb-30">
                                        <h5>tags</h5>
                                        <div class="product-tag-block-content blog-tag">
                                            <ul>
                                                <li><a href="#">brand</a></li>
                                                <li><a href="#">black</a></li>
                                                <li><a href="#">white</a></li>
                                                <li><a href="#">chire</a></li>
                                                <li><a href="#">table</a></li>
                                                <li><a href="#">Lorem</a></li>
                                                <li><a href="#">ipsum</a></li>
                                                <li><a href="#">dolor</a></li>
                                                <li><a href="#">sit</a></li>
                                                <li><a href="#">amet</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!--Blog Sidebar End-->
                </div>
            </div>
        </div>
        <!--Blog Area End-->
    </div>
</template>

<script>
    import blogProduct from '../blog/BlogProduct';
    export default {
        name: "SingleBlogComponent",
        data(){
            return{
                blogproduct: '',
                descriptions: '',
                description_split: '',
                blog_slug: ''
            }
        },
        computed: {
            blog(){
                return this.$store.getters['blog/getSingleBlog']
            }
        },

        methods: {
            getSingleBlog(){
                this.$store.dispatch('blog/getSingleBlog', this.$route.params.blogSlug);
            },
            // blogslug() {
            //     let sku = this.blog.description.split("--");
            //     console.log(sku);
            // },
            singleBlogName() {
                axios.post('/single-blog-name', {'blog_slug': this.$route.params.blogSlug})
                    .then((result) => {
                        this.blog_slug = result.data.blog_name
                        document.title = result.data.blog_name+' | Stygen'
                    }).catch((error) => {

                });
            },
        },

        created() {
            this.getSingleBlog();
            this.singleBlogName();
            this.blogProducts();
        }
    }
</script>

<style scoped>

</style>
