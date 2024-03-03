<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Create</h4>
                <div class="btns">
                    <router-link :to="{ name: `All${route_prefix}` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="storeOrder($event.target)" class="product_order" autocomplete="false">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="d-flex gap-2">
                                <input type="search" placeholder="search" class="form-control">
                                <button class="btn btn-outline-adn"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="row py-3">
                                <div class="col-lg-3" v-for="item in products.data" :key="item.id">
                                    <div class="card h-100 d-flex flex-column justify-between" >
                                        <img :src="item.image" class="img-fluid" alt=""/>
                                        <h6 style="flex:1" class="mt-2 mb-0">{{ item.title }}</h6>
                                        <button @click.prevent="add_to_cart(item)" class="btn mb-2 btn-sm btn-outline-info">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="border border-1 position-sticky top-0 borde-info p-1 rounded-sm mb-2">
                                <table class="table ">
                                    <thead class="position-static">
                                        <tr>
                                            <th>Title</th>
                                            <th style="width: 130px;">Qty</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in cart" :key="index">
                                            <td class="text-start">
                                                {{ item.title }}
                                                <br>
                                                <a href="javascript:void(0)" @click="remove_from_cart(index)" class="text-danger">delete</a>
                                            </td>
                                            <td class="text-center">
                                                <input  
                                                @change="update_cart_qty(item, $event.target.value)"
                                                @keyup="update_cart_qty(item, $event.target.value)"
                                                type="number" 
                                                :value="item.qty"
                                                min="1"
                                                class="form-control">
                                            </td>
                                            <td class="text-end">
                                                {{ item.price * item.qty }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-end">Total: </th>
                                            <th class="text-end">{{ total_balance }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- <form action="" class="mt-3"> -->
                                    <div class="form-group mb-2">
                                        
                                    </div>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <!-- <button type="submit" class="btn btn-outline-info" >
                                            <i class="fa fa-upload"></i>
                                            Create Order
                                        </button> -->
                                        <!-- <button type="submit" class="btn btn-outline-adn" >
                                            <i class="fa fa-print"></i>
                                            Print Draft
                                        </button>
                                        <button type="submit" class="btn btn-outline-secondary" >
                                            <i class="fa fa-print"></i>
                                            Send Email
                                        </button> -->
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="fa fa-paper-plane"></i>
                                            Create Order
                                        </button>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <!--  -->
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import InputField from '../../../components/InputField.vue'
// import UserManagementModal from '../../../users/components/UserManagementModal.vue';
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
            cart: [
            
            ],
            total_price: 0
        }
    },
    created: function () {
        this.fetch_products();
    },
    methods: {
        ...mapActions([
            `store_${store_prefix}`,`fetch_products`,
            'order_branch_product'
        ]),
        add_to_cart: function(item) {
            let product_check = this.cart.find((single_item) => single_item.id === item.id);

            if(product_check) {
                product_check.qty++;
            }else {
                let single_product = {
                    id: item.id,
                    title: item.title,
                    price: item.price,
                    qty: 1
                }
                this.cart.push(single_product);
            }

        },
        storeOrder: function(event) {
            
            
            
            let data = {
                products: JSON.stringify(this.cart),
                total_price: this.total_balance
            }

            this.order_branch_product(data);
            this.cart = [];

        },
        update_cart_qty: function(product, qty) {
            let product_check = this.cart.find((single_item) => single_item.id === product.id);
            product_check.qty = qty;
        },
        remove_from_cart: function(item) {
            this.cart.splice(item, 1);
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
        ...mapGetters({
            'products': "get_products",
        })
    }
};
</script>

<style>
</style>
