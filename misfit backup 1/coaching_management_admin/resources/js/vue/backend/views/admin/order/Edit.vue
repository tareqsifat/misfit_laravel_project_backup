<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Edit</h4>
                <div class="btns">
                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <form @submit.prevent="update_order_handler($event.target)" autocomplete="false">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="row mb-4">
                                    <div class="col-sm-6 col-6 col-lg-6 col-md-6" v-if="this[`get_${store_prefix}`]">
                                        <h5 class="mb-3">From:</h5>
                                        <h3 class="text-dark mb-1">{{ this[`get_${store_prefix}`].user.first_name }} {{ this[`get_${store_prefix}`].user.last_name }}</h3>
                                        <div>Addres: {{ this[`get_${store_prefix}`].user.address }}, </div>
                                        <div>Email: {{ this[`get_${store_prefix}`].user.email }}</div>
                                        <div>Phone: {{ this[`get_${store_prefix}`].user.mobile_number }}</div>
                                    </div>
                                    <div class="col-sm-6 col-6 col-lg-6 col-md-6" v-if="get_auth_information">
                                        <h5 class="mb-3">To:</h5>
                                        <h3 class="text-dark mb-1">
                                            {{ get_auth_information.first_name }} {{ get_auth_information.last_name }}
                                        </h3>
                                        <div>Address: {{ get_auth_information.address }}</div>
                                        <div>Email: {{ get_auth_information.email }}</div>
                                        <div>Phone: {{ get_auth_information.mobile_number }}</div>
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
                                        <tbody v-if="cart.length > 0">
                                            <!-- <span v-if="this[`get_${store_prefix}`]">
                                                {{ this[`get_${store_prefix}`].order_details }}
                                            </span> -->

                                            <tr v-for="(order_detail, index) in cart" :key="index" class="single_row_table">

                                                <td class="center">{{ index+1 }}</td>
                                                <td class="left strong" v-if="order_detail.product">{{ order_detail.product.title }}</td>
                                                <td class="left strong" v-else><span class="text-danger">Product not found</span></td>
                                                <td class="right">
                                                    <input type="text" class="form-control" @keyup="update_cart_price(order_detail, $event.target.value)" name="order_detail_price" :value="order_detail.price">
                                                    <!-- {{ order_detail.price }} -->
                                                </td>
                                                <td class="center">
                                                    <input type="text" class="form-control" @keyup="update_cart_qty(order_detail, $event.target.value)" name="order_detail_qty" :value="order_detail.qty">
                                                    <!-- {{ order_detail.qty }} -->
                                                </td>
                                                <td class="right">
                                                    {{ order_detail.price * order_detail.qty }}
                                                </td>
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
                                                    <td class="right">{{ total_balance }}</td>
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
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-outline-info" >
                        <i class="fa fa-upload"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import InputField from '../../components/InputField.vue'
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
            order_details: null,
            cart: [
            
            ],
            total_price: 0
        }
    },
    watch : {
        order_details: function(val) {
            val.forEach(element => {
                this.cart.push(element);
            });
            console.log(this.cart);
        }, 
    },
    created: async function () {
        await this[`fetch_${store_prefix}`]({id: this.$route.params.id});
        setTimeout(() => {
            this.order_details = this.get_order.order_details;
        }, 500);
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            'update_order_admin',
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_${store_prefix}`,
        ]),
        update_cart_qty: function(product, qty) {
            let product_check = this.cart.find((single_item) => single_item.id === product.id);
            product_check.qty = qty;
            product_check.total = product.qty * product.price;
            console.log(this.cart);
        },
        update_cart_price: function(product, price) {
            let product_check = this.cart.find((single_item) => single_item.id === product.id);
            product_check.price = price;
            product_check.total = product.qty * product.price;
            console.log(this.cart);
        },
        update_order_handler: function (params) {
            let data = {
                products: JSON.stringify(this.cart),
                total_price: this.total_balance,
                order_id: this.$route.params.id
            }

            this.update_order_admin(data);
        },
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        total_balance() {
            return this.cart.reduce((acc, item) => {
                return acc + (item.price * item.qty)
            }, 0);
        },
        ...mapGetters([`get_${store_prefix}`, 'get_auth_information'])
    }
};
</script>

<style>
</style>
