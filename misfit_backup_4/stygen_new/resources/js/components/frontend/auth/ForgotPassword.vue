<template>
    <div id="user_forgot_password">
        <!--Login Area Strat-->
        <div class="login-area">
           <div class="container login-page-main">
                <div class="row">
                    <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                        <div class="login">
                            <div class="login-form-container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-8 ml-auto mr-auto">
                                            <div class="row text-center">
                                                <h3 class="landing-login-title-tag">FORGOT PASSWORD</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="login-form">
                                    <form action="#" @submit.prevent="userForgotPassword()">
                                        <label>Email<span>*</span></label>
                                        <input v-model="form.email" type="text" placeholder="e.g. example@example.com">
                                        <span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span>

                                        <div class="button-box">
                                            <button type="submit" class="default-btn user-login-btn">Send Password Reset Link</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Login Area End-->
    </div>
</template>

<script>
    export default {
        name: "ForgotPassword",
        data(){
            return{
                errors:{},
                form: {

                }
            }
        },
        methods:{
            userForgotPassword(){
                axios.post('/password/email', this.form)
                .then((result) => {
                    this.$message({
                        showClose: true,
                        message: 'Congrats, Password reset link successfully send to your email.',
                        type: 'success'
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            }
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Forgot Password | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>

