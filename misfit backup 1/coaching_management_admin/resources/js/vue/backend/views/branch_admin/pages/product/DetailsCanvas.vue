<template>
    <div class="canvas_backdrop" :class="{active:this[`get_${store_prefix}`]}" @click="$event.target.classList.contains('canvas_backdrop') && call_store(`set_${store_prefix}`,null)">
        <div class="content right" v-if="this[`get_${store_prefix}`]">
            <div class="content_header">
                <h3 class="offcanvas-title">Details</h3>
                <i @click="call_store(`set_${store_prefix}`,null)" class="fa fa-times"></i>
            </div>
            <div class="cotent_body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td>:</td>
                            <td>{{ this[`get_${store_prefix}`].id }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ this[`get_${store_prefix}`].title }}</td>
                        </tr>

                        <tr>
                            <td>Image</td>
                            <td>:</td>
                            <td><img :src="`/${this[`get_${store_prefix}`].image}`" style="width: 40px;" alt=""></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>:</td>
                            <td>{{ this[`get_${store_prefix}`].price }}</td>
                        </tr>
                        
                    </tbody>
                </table>

                <div class="order_section full_width mt-2 no_print" style="overflow: hidden;">
                    <div class="heading mb-2">
                        <h4 class="d-flex justify-content-center">Order product</h4>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <form class="order_form_single" action="javascript:void(0)" @submit.prevent="call_store(`order_${store_prefix}`, null)">
                                
                                <!-- <div class="mb-2">
                                    <label for="qty" class="form-label mb-2">Account</label>
                                    <select name="account_id" id="defaultSelect" class="form-select">
                                        <option v-for="(account, index) in get_accounts.data" :key="index" :value="account.id">{{ account.title }}</option>
                                    </select>
                                </div> -->
                                
                                <div class="mb-2">
                                    <label for="qty" class="form-label mb-2">Qty</label>
                                    <input type="number" @change="product_price_total($event.target.value)" id="qty" class="form-control" name="qty" placeholder="ex: 10">
                                </div>

                                <div class="mb-2">
                                    <label for="total_amount" class="form-label mb-2">Total amount</label>
                                    <input type="text" v-model="total_amount" disabled id="total_amount" class="form-control" name="total_amount" placeholder="ex: 10">
                                </div>
                                
                                <!-- <div class="mb-2">
                                    <label for="paid_amount" class="form-label mb-2">Payable amount</label>
                                    <input type="number" id="paid_amount" class="form-control" name="paid_amount" placeholder="ex: 5000">
                                </div> -->

                                
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary">Order</button>  
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;
export default {
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
            total_amount: ''
        }
    },
    methods: {
        ...mapMutations([`set_${store_prefix}`]),
        ...mapActions([
            `order_${store_prefix}`
        ]),
        call_store: function(name, params=null){
            this[name](params)
            console.log(this.get_accounts);
        },
        product_price_total(qty) {
            this.total_amount = this[`get_${store_prefix}`].price * qty;
            console.log(this[`get_${store_prefix}`].price, qty);
            // this[`get_${store_prefix}`].price
        }
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}`,
        ])
    },
    created() {
    }
}
</script>

<style>

</style>
