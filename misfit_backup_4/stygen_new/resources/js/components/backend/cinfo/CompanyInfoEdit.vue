<template>
    <div id="company_info_edit">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Company Info Edit</h3>
                                </div>

                                <div class="card-body pt-0">
                                    <el-form>
                                        <el-form-item label="Facebook URL">
                                            <el-input v-model="form.facebook_link" placeholder="e.g. www.facebook.com"></el-input>
                                        </el-form-item>

                                        <el-form-item label="YouTube URL">
                                            <el-input v-model="form.youtube_link" placeholder="e.g. www.youtube.com"></el-input>
                                        </el-form-item>

                                        <el-form-item label="Twitter URL">
                                            <el-input v-model="form.twitter_link" placeholder="e.g. www.twitter.com"></el-input>
                                        </el-form-item>

                                        <el-form-item label="Instagram URL">
                                            <el-input v-model="form.instagram_link" placeholder="e.g. www.instagram.com"></el-input>
                                        </el-form-item>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>About Us</label>
                                                <ckeditor :editor="editor" v-model="form.about" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Privacy Policy</label>
                                                <ckeditor :editor="editor" v-model="form.privacy_policy" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Terms & Condition</label>
                                                <ckeditor :editor="editor" v-model="form.terms_condition" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Warranty Guide</label>
                                                <ckeditor :editor="editor" v-model="form.warranty_guide" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Return Policy</label>
                                                <ckeditor :editor="editor" v-model="form.return_policy" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Seller Page</label>
                                                <ckeditor :editor="editor" v-model="form.seller_page" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Seller Term & Condition</label>
                                                <ckeditor :editor="editor" v-model="form.seller_terms_condition" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <router-link :to="{name: 'companyInfoList'}" class="btn btn-default">Back</router-link>
                                        <el-button type="primary" @click="updateCompanyInfo">Update</el-button>
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
        name: "CompanyInfoEdit",
        data() {
            return {
                form: {
                    facebook_link: '',
                    youtube_link: '',
                    twitter_link: '',
                    instagram_link: '',
                    warranty_guide: '',
                    return_policy: '',
                    about: '',
                    privacy_policy: '',
                    terms_condition: '',
                    seller_page: '',
                    seller_terms_condition: '',
                },
                errors: {},
                editor: ClassicEditor,
                editorConfig: {

                },
            }
        },

        methods: {
            clearData(){
                this.errors = {}
                this.form = {}
            },
            editCompanyInfo(){
                this.$store.dispatch('cinfo/editCompanyInfo', this.$route.params.id)
            },
            updateCompanyInfo(){
                const formData = new FormData();
                formData.append("id", this.form.id);
                formData.append("facebook_link", this.form.facebook_link);
                formData.append("youtube_link", this.form.youtube_link);
                formData.append("twitter_link", this.form.twitter_link);
                formData.append("instagram_link", this.form.instagram_link);
                formData.append("warranty_guide", this.form.warranty_guide);
                formData.append("return_policy", this.form.return_policy);
                formData.append("about", this.form.about);
                formData.append("privacy_policy", this.form.privacy_policy);
                formData.append("terms_condition", this.form.terms_condition);
                formData.append("seller_page", this.form.seller_page);
                formData.append("seller_terms_condition", this.form.seller_terms_condition);

                axios.post('/admin/company-info-update', formData)
                    .then((result) => {
                        this.$router.push({name: 'companyInfoList'})
                        this.$message({
                            showClose: true,
                            message: 'Company Info updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            }
        },

        computed:{
            company_info(){
                return this.$store.getters['cinfo/editCompanyInfo'];
            }
        },

        created() {
            this.editCompanyInfo();
        },

        watch:{
            company_info(){
                this.form = this.company_info
            }
        }
    }
</script>

<style scoped>

</style>
