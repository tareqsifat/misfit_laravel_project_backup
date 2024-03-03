<template>
    <div id="user_reset_password">
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
                                                <h3 class="landing-login-title-tag">RESET PASSWORD</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="login-form">
                                    <form action="#" @submit.prevent="userResetPassword()">
                                        <label>Email<span>*</span></label>
                                        <input v-model="form.email" type="text" value="" placeholder="e.g. example@example.com">
                                        <span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span><br>

                                        <label>Password<span>*</span></label>
                                        <input v-model="form.password" type="password" placeholder="e.g. ********">
                                        <span class="text-danger" v-if="errors['password']">{{ errors['password'][0] }}</span><br>

                                        <label>Confirm Password<span>*</span></label>
                                        <input v-model="form.password_confirmation" type="password" placeholder="e.g. ********">
                                        <span class="text-danger" v-if="errors['password_confirmation']">{{ errors['password_confirmation'][0] }}</span>

                                        <div class="button-box">
                                            <button type="submit" class="default-btn user-login-btn">Reset Password</button>
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
        name: "PasswordReset",
        data(){
            return{
                errors:{},
                form: {
                    email: this.$route.query.email
                }
            }
        },
        methods:{
            userResetPassword(){
                axios.post('/password/reset', {'email': this.form.email, 'password': this.form.password, 'password_confirmation': this.form.password_confirmation, 'token': this.$route.params.token})
                .then((result) => {
                    this.$router.push({name: 'userLogin'})
                    this.$message({
                        showClose: true,
                        message: 'Congrats, Password reset successfully.',
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
                    document.title = 'Reset Password | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>

