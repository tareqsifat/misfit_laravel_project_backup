<template>
    <div id="user_register">
        <!--Breadcrumb Area Start-->
        <!-- <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{ name: 'landing' }">Home</router-link></li>
                                <li class="active">Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Breadcrumb Area End-->
        <!--Register Area Strat-->
        <div class="register-area">
            <div class="container register-page-main">
                <div class="row">
                    <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                        <div class="login">
                            <div class="login-form-container">
                                <div class="container login-container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="row text-center">
                                                <h3 class="landing-register-title-tag">REGISTER TO STYGEN</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="login-form">
                                    <form action="#" @submit.prevent="userRegister()">
                                        <label>Name<span>*</span></label>
                                        <input v-model="form.name" placeholder="e.g. Rahim" type="text">
                                        <span class="text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span><br>

                                        <label>Phone<span>*</span></label>
                                        <input v-model="form.phone" type="text" placeholder="e.g. 01xxxxxxxxx">
                                        <span class="text-danger" v-if="errors['phone']">{{ errors['phone'][0] }}</span><br>

                                        <input type="hidden" v-model="form.is_coupon" value="1">

                                        <label>Email<span>*</span></label>
                                        <input v-model="form.email" type="email" placeholder="e.g. example@example.com">
                                        <span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span><br>

                                        <label>Address<span>*</span></label>
                                        <input v-model="form.address" type="text" placeholder="e.g. House#1, Road#1, Flat#1A">
                                        <span class="text-danger" v-if="errors['address']">{{ errors['address'][0] }}</span><br>

                                        <label>Password<span>*</span></label>
                                        <input v-model="form.password" type="password" placeholder="e.g. ********">
                                        <span class="text-danger" v-if="errors['password']">{{ errors['password'][0] }}</span><br>

                                        <label>Confirm Password<span>*</span></label>
                                        <input v-model="form.password_confirmation" type="password" placeholder="e.g. ********">
                                        <span class="text-danger" v-if="errors['password_confirmation']">{{ errors['password_confirmation'][0] }}</span>

                                        <div class="button-box">
                                            <button type="submit" class="default-btn user-register-btn">Register</button>
                                        </div>
                                        <p>Already have an account? <router-link :to="{ name: 'userLogin' }">Log in instead!</router-link></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Register Area End-->
    </div>
</template>

<script>
    export default {
        name: "GiftLogin",
        data(){
            return {

                errors:{},
                form:{
                    is_coupon: 1
                }
            }
        },
        methods:{
            userRegister(){
                // console.log(this.form);
                axios.post('/custom_register', this.form)
                .then((result) => {
                    localStorage.setItem('userLoggedIn', true)
                    this.$router.push({name: 'userDashboard'})
                    this.$message({
                        showClose: true,
                        message: 'Thank you for Registration. Check your mail for the discount coupon',
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
                    document.title = 'Register | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
