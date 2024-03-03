<template>
    <div id="blog_edit">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Blog Edit</h3>
                                </div>

                                <div class="card-body pt-0">
                                    <el-form>
                                        <el-form-item label="Title">
                                            <el-input v-model="form.title" placeholder="e.g. New News"></el-input>
                                        </el-form-item>

                                        <el-form-item label="Image (1170*700)">
                                            <input type="file" class="form-control" @change="changeImage">
                                            <div class="mt-2">
                                                <img :src="imageShow" v-if="imageShow.length > 0" width="100" height="100" alt="">
                                            </div>
                                            <span class="text-danger" v-if='errors.image'>{{ errors.image[0] }}</span>
                                        </el-form-item>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Description</label>
                                                <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-form-item label="meta title">
                                            <el-input v-model="form.meta_title" placeholder="e.g. New News"></el-input>
                                        </el-form-item>

                                        <el-form-item label="meta description">
                                            <el-input v-model="form.meta_description" placeholder="e.g. New News"></el-input>
                                        </el-form-item>

                                        <router-link :to="{name: 'blogList'}" class="btn btn-default">Back</router-link>
                                        <el-button type="primary" @click="updateBlog">Update</el-button>
                                    </el-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    export default {
        name: "BlogEdit",
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    meta_title: '',
                    meta_description: ''
                },
                errors: {},
                image:'',
                imageShow:'',
                editor: ClassicEditor,
                editorConfig: {

                },
            }
        },

        methods: {
            changeImage(e){
                this.image = e.target.files[0]
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageShow = e.target.result
                };
                reader.readAsDataURL(file);
            },
            clearData(){
                this.errors = {}
                this.form = {}
            },
            editBlog(){
                this.$store.dispatch('blog/editBlog', this.$route.params.id)
            },
            updateBlog(){
                const formData = new FormData();
                formData.append("id", this.form.id);
                formData.append("title", this.form.title);
                formData.append("description", this.form.description);
                formData.append("meta_title", this.form.meta_title);
                formData.append("meta_description", this.form.meta_description);
                formData.append("image", this.image);

                axios.post('/admin/blog-update', formData)
                    .then((result) => {
                        this.$router.push({name: 'blogList'})
                        this.$message({
                            showClose: true,
                            message: 'Blog updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
        },

        computed:{
            blog(){
                return this.$store.getters['blog/editBlog'];
            }
        },

        created() {
            this.editBlog();
        },

        watch:{
            blog(){
                this.form = this.blog
                if(this.form.blog_category == 1){
                    this.form.blog_category = "Recipe Blogs"
                }else{
                    this.form.blog_category = "Home Decor Ideas"
                }
                this.imageShow = '/assets/uploads/blog/'+this.blog.image
            }
        }
    }
</script>

<style scoped>

</style>
