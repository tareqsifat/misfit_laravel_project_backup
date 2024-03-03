<template>
    <div id="seller_register">
        <div class="login-box" style="width:100%">
            <div class="login-logo mb-2 mt-0">
                <a href="/">
                    <img src="/assets/frontend/img/logo/logo.png" width="100px" alt="STYGEN">
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-body login-card-body">
                            <h3 class="text-center text-uppercase">Seller Register</h3>

                            <form action="/" method="post" @submit.prevent="sellerRegister()">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Account Type <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <select v-model="form.seller_type" @change="accountType" class="form-control">
                                                <option value="0">Select Account Type</option>
                                                <option value="1">Individual</option>
                                                <option value="2">Business</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-key"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['seller_type']">{{ errors['seller_type'][0] }}</span>
                                    </div>
                                </div>

                                <div class="row" v-if="nid">
                                    <div class="col-md-3">
                                        <label>NID <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" @change="changeNid">
                                            </div>
                                            <span class="text-danger" v-if="errors['nid']">{{ errors['nid'][0] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" v-if="tin">
                                    <div class="col-md-3">
                                        <label>TIN <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" @change="changeTin">
                                            </div>
                                            <span class="text-danger" v-if="errors['tin']">{{ errors['tin'][0] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" v-if="bin">
                                    <div class="col-md-3">
                                        <label>BIN <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" @change="changeBin">
                                            </div>
                                            <span class="text-danger" v-if="errors['bin']">{{ errors['bin'][0] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <input type="text" v-model="form.name" class="form-control" placeholder="Mr. X">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <input type="email" v-model="form.email" class="form-control" placeholder="example@example.com">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Phone <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <input type="text" v-model="form.phone" class="form-control" placeholder="01xxxxxxxxx">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['phone']">{{ errors['phone'][0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Address <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <input type="text" v-model="form.address" class="form-control" placeholder="House: x, Road: x, Flat x">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-home"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['address']">{{ errors['address'][0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Password <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <input type="password" v-model="form.password" class="form-control" placeholder="********">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['password']">{{ errors['password'][0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Confirm Password<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="input-group">
                                            <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="********">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger" v-if="errors['password_confirmation']">{{ errors['password_confirmation'][0] }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                        <input type="checkbox" checked id="agreeTerms" name="terms" value="agree">
                                        <label for="agreeTerms">
                                        I agree to the <a href="#" data-toggle="modal" data-target="#termsConditionModal">terms & condition</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="termsConditionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Terms & Condition</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p v-if="companyInfo" v-html="companyInfo.seller_terms_condition"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        </label>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                </div>
                            </form>
                            <p class="mb-0 text-center">
                                <router-link :to="{name: 'sellerLogin'}" class="text-center">Already registered. Please Login?</router-link>
                            </p>
                        </div>
                        <!-- /.login-card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login-box -->
    </div>
</template>

<script>
    export default {
        name: "SellerRegisterComponent",
        data(){
            return{
                errors:{},
                form: {
                    seller_type: 0,
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                    password: '',
                    password_confirmation: '',
                },
                nid: false,
                tin: false,
                bin: false,
                nidImage: '',
                tinImage: '',
                binImage: '',
            }
        },
        computed: {
            companyInfo(){
                return this.$store.getters['cinfo/getLandingCompanyInfo']
            },
        },
        created() {
            this.getLandingCompanyInfo();
        },
        methods:{
            accountType(){
                let accountType = this.form.seller_type;
                if(accountType == 1){
                    this.nid = true;
                    this.tin = false;
                    this.bin = false;
                }else if(accountType == 2){
                    this.nid = false;
                    this.tin = true;
                    this.bin = true;
                }else{
                    this.nid = false;
                    this.tin = false;
                    this.bin = false;
                }
            },
            changeNid(e){
                this.nidImage = e.target.files[0]
            },
            changeTin(e){
                this.tinImage = e.target.files[0]
            },
            changeBin(e){
                this.binImage = e.target.files[0]
            },
            sellerRegister(){
                const formData = new FormData();
                formData.append("seller_type", this.form.seller_type);
                formData.append("name", this.form.name);
                formData.append("email", this.form.email);
                formData.append("phone", this.form.phone);
                formData.append("address", this.form.address);
                formData.append("password", this.form.password);
                formData.append("password_confirmation", this.form.password_confirmation);
                formData.append("nid", this.nidImage);
                formData.append("tin", this.tinImage);
                formData.append("bin", this.binImage);

                axios.post('/seller/register-seller', formData)
                .then((result) => {
                    this.$router.push({name: 'sellerLogin'})
                    this.$message({
                        showClose: true,
                        message: 'Congrats, Register successful. Redirecting...',
                        type: 'success'
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors
                    this.$message({
                        showClose: true,
                        message: 'Something gone wrong',
                        type: 'error'
                    });
                });
            },
            getLandingCompanyInfo(){
                this.$store.dispatch('cinfo/getLandingCompanyInfo');
            }
        },
    }
</script>

<style scoped>

</style>
