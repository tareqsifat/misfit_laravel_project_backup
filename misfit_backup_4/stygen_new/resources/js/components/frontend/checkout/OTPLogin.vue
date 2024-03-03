<template>
    <div id="otp_login">
        <div class="login-area">
            <div class="container login-page-main">
                <div class="row">
                    <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                        <div class="login">
                            <div class="login-form-container">
                                <div class="container login-container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="row text-center">
                                                <h3 class="landing-login-title-tag">Login with Mobile OTP</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="login-form" v-if="!user.id">
                                    <form action="#" @submit.prevent="sendOtpLogin()">
                                        <label>Phone Number<span>*</span></label>
                                        <input v-model="form.phone" type="text" placeholder="e.g. 01xxxxxxxxx">
                                        <span class="text-danger" v-if="errors['phone']">{{ errors['phone'][0] }}</span>

                                        <div class="button-box">
                                            <button type="submit" class="default-btn user-login-btn">SEND PIN</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="login-form" v-else>
                                    <form action="#" @submit.prevent="sendOtpLogin()">
                                        <label>Phone Number<span>*</span></label>
                                        <input v-model="form.phone" type="text" placeholder="e.g. 01xxxxxxxxx">
                                        <span class="text-danger" v-if="errors['phone']">{{ errors['phone'][0] }}</span>

                                        <div class="button-box">
                                            <button type="submit" class="default-btn user-login-btn">RESEND PIN</button>
                                        </div>
                                    </form>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        We've sent a 4-digit one-time PIN in your phone# {{ user.phone }}, Please type PIN
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="#" @submit.prevent="submitPin()">
                                        <label>OTP Code<span>*</span></label>
                                        <input v-model="form.pin" type="text" placeholder="e.g. 2356">
                                        <span class="text-danger" v-if="errors['pin']">{{ errors['pin'][0] }}</span>
                                        <span v-if="errorMsg" class="text-danger">Your PIN code is invalid or expired.</span>
                                        <div class="button-box">
                                            <button type="submit" class="default-btn user-login-btn">SUBMIT PIN</button>
                                        </div>
                                    </form>
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
    export default {
        name: "OTPLogin",
        data(){
            return{
                errors:{},
                form: {

                },
                errorMsg: false
            }
        },
        methods:{
            sendOtpLogin(){
                axios.post('/login-otp', this.form)
                    .then((result) => {
                        this.getUser();
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            getUser(){
                this.$store.dispatch('user/getUser');
            },
            submitPin(){
                axios.post('/login-otp-confirm', this.form)
                    .then((result) => {
                        if(result.data == 'success'){
                            this.errorMsg = false
                            window.location = '/checkout'
                        }
                        if(result.data == 'error'){
                            this.errorMsg = true
                        }
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUserDetails']
            }
        },
        created() {
            this.getUser();
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Login | Stygen'
                },
                immediate: true
            },
            user(){
                this.form.phone = this.user.phone
            }
        }
    }
</script>

<style scoped>

</style>
