<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header no_print">
                <h4>Details</h4>
                <div class="btns">
                    <!-- <a href="" @click.prevent="$router.push({ name: 'EmailOrder', params:{id: $route.params.id} })"  class="btn rounded-pill btn-outline-success me-2">

                        <i class="fa fa-envelope me-5px"></i>
                        <span >
                            Email invoice
                        </span>
                    </a> -->

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
            <div class="card-body pb-5" v-if="this[`get_${store_prefix}`]" id="print_section">
                <section class="balance_sheet">
                    <div class="balance_sheet_content">

                        <!-- header_area start -->
                        <div class="header_area_full" style="background-image: url(/test/bg1.png);">
                            <div class="container">
                                <div class="header_area">
                                    <div class="page_title">
                                        <h2 class="title_text">INVOICE</h2>
                                    </div>
                                    <div class="logo_area">
                                        <img :src="site_logo" width="100" height="25" alt="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- header_area end -->

                        <!-- customar_name_address_and_invoice_id_date_area start -->
                        <div class="container">
                            <div class="customar_name_address_and_invoice_id_date_area">

                                <!-- customar_name_address_arer start -->
                                <div class="customar_name_address_arer">
                                    <div class="invoice_name">
                                        <h2 class="invoice_text"> Invoice to :</h2>
                                    </div>
                                    <div class="customar_name_address">
                                        <div class="customar_name">
                                            <h3 class="name_text">{{ this[`get_${store_prefix}`].user.first_name }} {{ this[`get_${store_prefix}`].user.last_name }}</h3>
                                        </div>
                                        <div class="customar_address">
                                            <div class="address_text_area">
                                                <p class="address_text">{{ this[`get_${store_prefix}`].user.address }}</p>
                                                <p class="address_text"> Bangladesh</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- customar_name_address_arer end -->

                                <!-- invoice_id_date_area start -->
                                <div class="invoice_id_date_area">

                                    <!-- invoice_id_area start -->
                                    <div class="invoice_id_area">
                                        <div class="invoice_title">
                                            <h3 class="title_text">Invoice: </h3>
                                        </div>
                                        <div class="invoice_id">
                                            <h3 class="id_text">#{{ this[`get_${store_prefix}`]['invoice_id'] }}</h3>
                                        </div>
                                    </div>
                                    <!-- invoice_id_area end -->

                                    <!-- date_area start  -->
                                    <div class="date_area">
                                        <div class="date_title">
                                            <h3 class="title_text">Date: </h3>
                                        </div>
                                        <div class="date_number">
                                            <h3 class="date_text">{{ new Date(this[`get_${store_prefix}`]['created_at']).toDateString() }}</h3>
                                        </div>
                                    </div>
                                    <!-- date_area end -->
                                </div>
                                <!-- invoice_id_date_area end -->
                            </div>
                        </div>
                        <!-- customar_name_address_and_invoice_id_date_area end -->

                        <!-- product_item_area start -->
                        <div class="">
                            <div class="product_item_area">
                                <table v-if="this[`get_${store_prefix}`]">
                                    <thead>
                                        <tr>
                                            <th class="sl">
                                                SL
                                            </th>
                                            <th>
                                                Item Description
                                            </th>
                                            <th class="price">
                                                Price
                                            </th>
                                            <th class="qty">
                                                Qty
                                            </th>
                                            <th class="total">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(order_detail, index) in this[`get_${store_prefix}`].order_details" :key="index">
                                            <td>
                                                {{ index+1 }}
                                            </td>
                                            <td>
                                                {{ order_detail.product.title }}
                                            </td>
                                            <td>
                                                {{ order_detail.price }}
                                            </td>
                                            <td>
                                                {{ order_detail.qty }}
                                            </td>
                                            <td>
                                                {{ order_detail.price * order_detail.qty }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- product_item_area end -->

                        <!-- thank_and_payment_and_total_area start -->
                        <div class="">
                            <div class="thank_and_payment_and_total_area">
                                <!-- left_area start -->
                                <div class="left_area">
                                    <div class="thank_area">
                                        <p class="thank_title">Thank you for your business</p>
                                    </div>
                                    <div class="payment_info_area">

                                        <!-- <div class="payment_info_title_area">
                                            <h3 class="payment_info_title">Payment info:</h3>
                                        </div> -->

                                        <!-- payment_info_content start -->
                                        <!-- <div class="payment_info_content">
                                            <div class="info_title">
                                                <p class="text">Account # :</p>
                                            </div>
                                            <div class="info_value">
                                                <p class="text">123 456 7899</p>
                                            </div>
                                        </div> -->
                                        <!-- payment_info_content end -->
                                        <!-- payment_info_content start -->
                                        <!-- <div class="payment_info_content">
                                            <div class="info_title">
                                                <p class="text">A/C Name :</p>
                                            </div>
                                            <div class="info_value">
                                                <p class="text">lorem ipsome</p>
                                            </div>
                                        </div> -->
                                        <!-- payment_info_content end -->
                                        <!-- payment_info_content start -->
                                        <!-- <div class="payment_info_content">
                                            <div class="info_title">
                                                <p class="text">Bank Details :</p>
                                            </div>
                                            <div class="info_value">
                                                <p class="text">Add your bank details</p>
                                            </div>
                                        </div> -->
                                        <!-- payment_info_content end -->


                                    </div>
                                </div>
                                <!-- left_area end -->

                                <!-- right_area start -->
                                <div class="right_area">
                                    <div class="total_area_start">

                                        <!-- total_content_area start -->
                                        <div class="total_content_area">
                                            <div class="content_title">
                                                <p class="text">Sub Total:</p>
                                            </div>
                                            <div class="content_value">
                                                <p class="text">{{ this[`get_${store_prefix}`].total_amount }}</p>
                                            </div>
                                        </div>
                                        <!-- total_content_area end -->

                                        <!-- total_content_area start -->
                                        <!-- <div class="total_content_area">
                                            <div class="content_title">
                                                <p class="text">Tax:</p>
                                            </div>
                                            <div class="content_value">
                                                <p class="text">0.005</p>
                                            </div>
                                        </div> -->
                                        <!-- total_content_area end -->

                                        <!-- total_amount_area start -->
                                        <div class="total_content_area total_amount_area">
                                            <div class="content_title">
                                                <p class="text">Total:</p>
                                            </div>
                                            <div class="content_value">
                                                <p class="text">{{ this[`get_${store_prefix}`].total_amount }}</p>
                                            </div>
                                        </div>
                                        <!-- total_amount_area end -->

                                    </div>
                                </div>
                                <!-- right_area end -->
                            </div>
                        </div>
                        <!-- thank_and_payment_and_total_area end -->

                        <!-- terms_and_condition_area_and_signeture_area start -->
                        <div class="">
                            <div class="terms_and_condition_area_and_signeture_area">
                                <!-- terms_and_condition_area start -->
                                <!-- <div class="terms_and_condition_area">
                                    <div class="title">
                                        <h3 class="title_text">Terms & Conditions</h3>
                                    </div>
                                    <div class="text_area">
                                        <p class="text">
                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id, cupiditate?
                                        </p>
                                    </div>
                                </div> -->
                                <!-- terms_and_condition_area end -->
                                <!-- signeture_area start -->
                                <div class="signeture_area">
                                    <h3 class="signeture_title">Authorised Sign</h3>
                                </div>
                                <!-- signeture_area end -->
                            </div>
                        </div>
                        <!-- team_and_condition_area_and_signeture_area end -->

                        <!-- bottom_bg_area start -->
                        <div class="bottom_bg_area" style="background-image: url(/test/bg2.png);">

                        </div>
                        <!-- bottom_bg_area end -->
                    </div>
                </section>
            </div>
            
            <!-- <div class="card-footer text-center">
            </div> -->
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import PermissionButton from '../../../components/PermissionButton.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { PermissionButton },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
            to_name: '',
            to_phone_no: '',
            to_mail: '',
            to_address: '',
            site_logo: ''
        }
    },
    created: function () {
        this[`fetch_${store_prefix}`]({id: this.$route.params.id, select_all:1})
        this.fetch_all_site_settings();
        this.fetch_order_payment(this.$route.params.id);
        // setTimeout(() => {
        //     document.querySelector("section").style.background = "transparent"
        //     // if(this[`get_${store_prefix}`].description.includes("bg-white")) {
        //     //     document.querySelector("section").style.background-color = "transparent";
        //     // }
        // }, 1000);

    },
    watch: {
        get_all_site_settings: {
            handler: function (newv, oldv) {
                newv.forEach(element => {
                    if(element.title == 'invoice_name') {
                        this.to_name = element.value;
                    }
                    if(element.title == 'invoice_address') {
                        this.to_address = element.value;
                    }
                    if(element.title == 'invoice_email') {
                        this.to_mail = element.value;
                    }
                    if(element.title == 'invoice_mobile_number') {
                        this.to_phone_no = element.value;
                    }
                    if(element.title == 'site_logo') {
                        this.site_logo = element.value;
                    }
                });
            },
            deep: true,
        },
    },
    methods: {
        ...mapActions([
            `fetch_${store_prefix}`,
            `update_${store_prefix}_payment_status`,
            `print_${store_prefix}_details`,
            `email_${store_prefix}_invoice`,
            'fetch_all_site_settings',
            'fetch_order_payment',
        ]),
        ...mapMutations([
            `set_${store_prefix}`
        ]),
        handle_print: function() {
            if(this.get_order_payment.payment_status == 'accepted') {
                setTimeout(() => {
                    this[`print_${store_prefix}_details`]();
                }, 250  );
            }else {
                window.s_alert("You cannot print the invoice before the payment is approved", 'warning');
            }
        },
        check_payment_submission: function () {
            if(this.get_order_payment.paid_amount == this.get_order_payment.total_amount) {
                window.s_alert("You have already paid!", 'warning');
            }else {
                this[`update_${store_prefix}_payment_status`](this.$route.params.id)
                this.fetch_order_payment(this.$route.params.id);
            }
        },
        call_store: function(name, params=null){
            // import action before using call store() function
            this[name](params)
        },
    },
    computed: {
        ...mapGetters(
            [
                `get_${store_prefix}`,
                'get_auth_information',
                'get_all_site_settings',
                'get_order_payment'
            ]
        )
    }
}
</script>
<style>
@import '/frontend/assets/css/invoice.css';
</style>