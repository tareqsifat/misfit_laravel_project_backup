<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Edit</h4>
                <div class="btns">
                    <a href="" @click.prevent="handle_print()"  class="btn rounded-pill btn-outline-success me-2">

                        <i class="fa fa-print me-5px"></i>
                        <span >
                            Print
                        </span>
                    </a>
                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row justify-content-center">
                    <section class="student_card">
                        <div class="container">
                            <div class="student_card_content" id="print_section" style="background-image: url(/test/bg.png);">
                                <!-- school_logo start -->
                                <div class="school_logo">
                                    <img :src="site_logo" alt="logo">
                                </div>
                                <!-- school_logo end -->
                                <!-- school_name_area start -->
                                <div class="school_name_area">
                                    <h2 class="school_name_text">{{ site_name }}</h2>
                                </div>
                                <!-- school_name_area end -->

                                <!-- address_area start -->
                                <div class="address_area">
                                    <p class="address_text">{{ site_address }}</p>
                                </div>
                                <!-- address_area end -->

                                <!-- phone_number_area start -->
                                <div class="phone_number_area">
                                    <p class="phone_number_text">Phone : <span>{{ site_mobile_number }}</span></p>
                                </div>
                                <!-- phone_number_area end -->

                                <!-- student_image_area start -->
                                <div class="student_image_area">
                                    <img :src="this[`get_${store_prefix}`].student.user.photo" alt="student img">
                                </div>
                                <!-- student_image_area end-->

                                <!-- student_id_card_title_area start -->
                                <div class="student_id_card_title_area">
                                    <p class="student_id_card_title_text">Student id card</p>
                                </div>
                                <!-- student_id_card_title_area end -->

                                <!-- student_information_area start -->
                                <div class="student_information_area">

                                    <!-- student_information_content start -->
                                    <div class="student_information_content">
                                        <div class="information_title">
                                            <p class="title_text"> <span class="text">Student name</span> <span class="samecolon">:</span></p>
                                        </div>
                                        <div class="information_value">
                                            <p class="value_text">{{ this[`get_${store_prefix}`]['student']['user']['first_name'] }} {{ this[`get_${store_prefix}`]['student']['user']['last_name'] }}</p>
                                        </div>
                                    </div>
                                    <!-- student_information_content end -->
                                    <!-- student_information_content start -->
                                    <div class="student_information_content">
                                        <div class="information_title">
                                            <p class="title_text"> <span class="text">ID NO</span> <span class="samecolon">:</span></p>
                                        </div>
                                        <div class="information_value">
                                            <p class="value_text">{{ this[`get_${store_prefix}`]['student']['user']['branch_code'] }}</p>
                                        </div>
                                    </div>
                                    <!-- student_information_content end -->
                                    <!-- student_information_content start -->
                                    <div class="student_information_content">
                                        <div class="information_title">
                                            <p class="title_text"> <span class="text">Class</span> <span class="samecolon">:</span></p>
                                        </div>
                                        <div class="information_value">
                                            <!-- <ul>
                                                <li style="list">
                                                    
                                                </li>
                                            </ul> -->
                                            <p class="value_text"  v-for="(class_batch_item, index) in this[`get_${store_prefix}`]['student']['institute_class_batches']" :key="index">
                                                <span>{{ class_batch_item.class.title }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- student_information_content end -->
                                    <!-- student_information_content start -->
                                    <div class="student_information_content">
                                        <div class="information_title">
                                            <p class="title_text"> <span class="text">Phone</span> <span class="samecolon">:</span></p>
                                        </div>
                                        <div class="information_value">
                                            <p class="value_text" v-if="this[`get_${store_prefix}`]['student']['user']">{{ this[`get_${store_prefix}`]['student']['user']['mobile_number'] }}</p>
                                        </div>
                                    </div>
                                    <!-- student_information_content end -->
                                    <!-- student_information_content start -->
                                    <div class="student_information_content">
                                        <div class="information_title">
                                            <p class="title_text"> <span class="text">B. Group</span> <span class="samecolon">:</span></p>
                                        </div>
                                        <div class="information_value">
                                            <p class="value_text">B+</p>
                                        </div>
                                    </div>
                                    <!-- student_information_content end -->

                                    <!-- scanning_and_principal_signature_area start -->
                                    <div class="scanning_and_principal_signature_area">
                                        <!-- scanning_area start -->
                                        <div class="scanning_area">
                                        <img src="/test/scane.png" alt="scane">
                                        </div>
                                        <!-- scanning_area end -->
                                        <!-- principal_signature_area start -->
                                        <div class="principal_signature_area">
                                            <p class="principal_signature_area_text">Principal</p>
                                        </div>
                                        <!-- principal_signature_area end -->
                                    </div>
                                    <!-- scanning_and_principal_signature_area end -->
                                </div>
                                <!-- student_information_area end -->

                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import InputField from '../../../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;
export default {
    components: { InputField },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
            site_name: '',
            site_mobile_number: '',
            site_logo: '',
            site_address: ''
        }
    },
    created: function () {
        this[`fetch_${store_prefix}`]({id: this.$route.params.id});
        this.fetch_all_site_settings();
    },
    watch: {
        get_all_site_settings: {
            handler: function (newv, oldv) {
                newv.forEach(element => {
                    if(element.title == 'site_name') {
                        this.site_name = element.value;
                    }
                    if(element.title == 'site_mobile_number') {
                        this.site_mobile_number = element.value;
                    }
                    if(element.title == 'site_logo') {
                        this.site_logo = element.value;
                    }
                    if(element.title == 'invoice_address') {
                        this.site_address = element.value;
                    }
                });
            },
            deep: true,
        },
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            `fetch_${store_prefix}`,
            'fetch_all_site_settings'
        ]),
        handle_print: function() {
            window.print();
        },
        ...mapMutations([
            `set_${store_prefix}`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}`,
            `get_all_site_settings`
        ])
    }
};
</script>

<style>
@import '/frontend/assets/css/student_card.css';
</style>
