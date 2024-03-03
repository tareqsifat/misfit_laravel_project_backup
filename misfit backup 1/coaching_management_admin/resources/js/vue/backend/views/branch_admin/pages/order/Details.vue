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

                    <router-link :to="{name:`InvoiceBranchOrder`,params:{id: this[`get_${store_prefix}`].id}}"  class="btn rounded-pill btn-outline-success me-2">

                        <i class="fa fa-print me-5px"></i>
                        <span >
                            Invoice
                        </span>
                    </router-link>

                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>


                </div>
            </div>
            <div class="card-body pb-5" v-if="this[`get_${store_prefix}`]" id="print_section">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">From:</h5>
                                <h3 class="text-dark mb-1">{{ this[`get_${store_prefix}`].user.first_name }} {{ this[`get_${store_prefix}`].user.last_name }}</h3>
                                <div>Addres: {{ this[`get_${store_prefix}`].user.address }}, </div>
                                <div>Email: {{ this[`get_${store_prefix}`].user.email }}</div>
                                <div>Phone: {{ this[`get_${store_prefix}`].user.mobile_number }}</div>
                            </div>
                            <div class="col-sm-6" v-if="this[`get_${store_prefix}`]">
                                <h5 class="mb-3">To:</h5>
                                <h3 class="text-dark mb-1">
                                    {{ to_name }}
                                </h3>
                                <div>Address: {{ to_address }}</div>
                                <div>Email: {{to_mail}}</div>
                                <div>Phone: {{ to_phone_no }}</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm" v-if="this[`get_${store_prefix}`]">
                            <table class="table table-striped">
                                <thead class="t_heading">
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th class="right">Price</th>
                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <span v-if="this[`get_${store_prefix}`]">
                                        {{ this[`get_${store_prefix}`].order_details }}
                                    </span> -->

                                    <tr v-for="(order_detail, index) in this[`get_${store_prefix}`].order_details" :key="index" class="single_row_table">

                                        <td class="center">{{ index+1 }}</td>
                                        <td class="left strong">{{ order_detail.product.title }}</td>
                                        <td class="right">{{ order_detail.price }}</td>
                                        <td class="center">{{ order_detail.qty }}</td>
                                        <td class="right">{{ order_detail.price * order_detail.qty }}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"></div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">{{ this[`get_${store_prefix}`].total_amount }}</td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="left">
                                                <strong class="text-dark">Paid amount</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">{{ this[`get_${store_prefix}`].paid_amount }}</strong>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div v-if="this[`get_${store_prefix}`].status == 'accepted' || this[`get_${store_prefix}`].status == 'delivered'" class="order_action no_print">
                    <hr>
                    <div class="seo_section full_width mt-5 no_print">
                        <div class="heading mb-4">
                            <h4 class="d-flex justify-content-center">Order action</h4>
                            <h6 class="d-flex justify-content-center">Order payment</h6>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-4 mx-auto">
                                <form class="order_action_form" action="javascript:void(0)" @submit.prevent="check_payment_submission()">
                                    <div class="mb-2">
                                        <label for="account" class="form-label">Account</label>

                                        <input type="text" name="account" id="account" value="cash" class="form-control" disabled>
                                    </div>

                                    <div class="mb-2">
                                        <label for="trx_id" class="form-label">Trx Id</label>

                                        <input type="text" id="trx_id" name="trx_id" class="form-control">
                                    </div>

                                    <div class="mb-2">
                                        <label for="order_amount" class="form-label">Amount</label>

                                        <input type="text" name="order_amount" id="order_amount" :value="this[`get_${store_prefix}`].total_amount" class="form-control" disabled>
                                    </div>

                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4 id="payment_id" class="mt-4">Payment Information</h4>
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Media</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Cash</td>
                                    <td>{{ get_order_payment.paid_amount }}</td>
                                    <td>{{ new Date(get_order_payment.created_at).toDateString()  }}</td>
                                    
                                    <td v-if="get_order_payment.payment_status == 'accepted'">
                                        <span class="badge bg-success">{{ get_order_payment.payment_status }}</span>
                                    </td>
                                    <td v-else>
                                        <span class="badge bg-secondary">{{ get_order_payment.payment_status }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            to_address: ''
        }
    },
    created: function () {
        this[`fetch_${store_prefix}`]({id: this.$route.params.id, select_all:1})
        this.fetch_site_settings();
        this.fetch_order_payment(this.$route.params.id);
        // setTimeout(() => {
        //     document.querySelector("section").style.background = "transparent"
        //     // if(this[`get_${store_prefix}`].description.includes("bg-white")) {
        //     //     document.querySelector("section").style.background-color = "transparent";
        //     // }
        // }, 1000);

    },
    watch: {
        get_site_settings: {
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
            'fetch_site_settings',
            'fetch_order_payment',
        ]),
        ...mapMutations([
            `set_${store_prefix}`
        ]),
        handle_print: function() {
            if(this.get_order_payment.payment_status == 'accepted') {
                this[`print_${store_prefix}_details`]();
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
                'get_site_settings',
                'get_order_payment'
            ]
        )
    }
}
</script>
