<template>
    <div id="recipe">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
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
                            <article class="blog_single" v-for="blog in blogs.data" :key="blog.id">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <!-- <router-link :to="{name: 'singleBlog', params: {blogSlug:blog.blog_slug}}">{{ blog.title }}</router-link> -->

                                        <a :href="`/blog/${blog.blog_slug}`">{{ blog.title }}</a>
                                    </h2>
                                    <span class="post-author">
                                    <span class="post-by"> Posts by : </span> admin </span>
                                    <span class="post-separator">|</span>
                                    <span class="blog-post-date"><i class="fas fa-calendar-alt"></i> {{ blog.created_at | timeFormat }}</span>
                                </header>
                                <div class="post-thumbnail">
                                    <router-link :to="{name: 'singleBlog', params: {blogSlug:blog.blog_slug}}">
                                        <img :src="`/assets/uploads/blog/${blog.image}`" width="60%" :alt="blog.title">
                                    </router-link>
                                </div>
                                <div class="postinfo-wrapper">
                                    <div class="post-info">
                                        <div class="entry-summary">
                                            <p :inner-html.prop="blog.description | sortlength(50,'...')"></p>
                                            <router-link :to="{name: 'singleBlog', params: {blogSlug:blog.blog_slug}}" class="default-btn">Read More</router-link>
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
                        </div>
                        <div class="row">
                            <div class="ml-auto mr-auto">
                                <!--Pagination Start-->
                                <div class="pagination-product d-md-flex justify-content-md-between align-items-center">
                                    <!--<div class="showing-product">
                                        <p> Showing 1-10 of 15 item(s) </p>
                                    </div>-->
                                    <div class="page-list shop-paginate">
                                        <el-pagination class="text-center mt-3"
                                               background
                                               @current-change="paginationChange"
                                               :current-page.sync="currentPage"
                                               :page-size="blogs.per_page"
                                               layout="prev, pager, next"
                                               :total="blogs.total">
                                        </el-pagination>
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
</template>

<script>
    export default {
        name: "BlogComponent",
        data(){
            return{
                currentPage: 1,
            }
        },
        computed: {
            blogs(){
                return this.$store.getters['blog/getAllBlog']
            }
        },

        methods: {
            getAllBlog(){
                this.$store.dispatch('blog/getAllBlog', this.currentPage);
            },
            paginationChange(){
                this.$store.dispatch('blog/getAllBlog', this.currentPage);
            }
        },

        created() {
            this.getAllBlog();
        },

        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Blog | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
