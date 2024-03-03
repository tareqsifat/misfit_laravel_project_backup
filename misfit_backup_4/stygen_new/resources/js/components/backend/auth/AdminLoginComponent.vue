<template>
    <div id="admin_login" class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo mb-2 mt-0">
                <a href="/">
                    <img src="/assets/frontend/img/logo/logo.png" width="100px" alt="STYGEN">
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <h3 class="text-center text-uppercase">Admin Login</h3>
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="/" method="post" @submit.prevent="adminLogin()">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" v-model="form.email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" v-model="form.password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger" v-if="errors['password']">{{ errors['password'][0] }}</span>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <!-- <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div> -->
                    <!-- /.social-auth-links -->

                    <!-- <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p> -->
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
</template>

<script>
    export default {
        name: "AdminLoginComponent",
        data(){
            return{
                errors:{},
                form: {

                }
            }
        },
        methods:{
            adminLogin(){
                axios.post('/admin/login', this.form)
                .then((result) => {
                    localStorage.setItem('adminLoggedInInfo', JSON.stringify(result.data))
                    this.$router.push({name: 'adminDashboard'})
                    this.$message({
                        showClose: true,
                        message: 'Congrats, Login successful. Redirecting...',
                        type: 'success'
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>

<style scoped>

</style>
