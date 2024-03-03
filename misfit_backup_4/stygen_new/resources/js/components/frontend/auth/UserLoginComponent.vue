<template>
    <div id="user_login">
        <!--Breadcrumb Area Start-->
        <!-- <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{ name: 'landing' }">Home</router-link></li>
                                <li class="active">Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Breadcrumb Area End-->
        <!--Login Area Strat-->
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
                                                <h3 class="landing-login-title-tag">LOGIN TO STYGEN</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="login-form">
                                    <form action="#" @submit.prevent="userLogin()">
                                        <label>Email<span>*</span></label>
                                        <input v-model="form.email" type="text" placeholder="e.g. example@example.com">
                                        <span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span>
                                        <br>
                                        <label>Password<span>*</span></label>
                                        <input v-model="form.password" type="password" placeholder="e.g. ********">
                                        <span class="text-danger" v-if="errors['password']">{{ errors['password'][0] }}</span>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Remember me</label>
                                                <router-link :to="{name: 'userForgotPassword'}">Forgot Password?</router-link>
                                            </div>
                                            <button type="submit" class="default-btn user-login-btn">Login</button>
                                        </div>
                                    </form>
                                    <div class="no-account">
                                        <router-link :to="{ name: 'userRegister' }" class="default-btn user-login-btn">No account? Create one here</router-link>
                                    </div>
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
        name: "UserLoginComponent",
        data(){
            return{
                errors:{},
                form: {

                }
            }
        },
        methods:{
            userLogin(){
                axios.post('/login', this.form)
                .then((result) => {
                    localStorage.setItem('userLoggedIn', true)
                    this.$router.push({name: 'userDashboard'})
                    this.$message({
                        showClose: true,
                        message: 'Congrats, Login successful. Redirecting...',
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
                    document.title = 'Login | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
