<template>
    <div id="order_details">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-right printText">
                                        <router-link :to="{name: 'orderList'}" class="btn btn-secondary btn-sm">Back</router-link>
                                        <button @click.prevent="printInvoice('printableArea')" class="btn btn-danger btn-sm">Print</button>
                                        <!-- <button v-if="payment_method_type == 'Bkash'" @click.prevent="refund()" class="btn btn-danger btn-sm">Refund</button>
                                        <button v-if="payment_method_type == 'Bkash'" @click.prevent="refund_status()" class="btn btn-danger btn-sm">Check Refund Status</button> -->
                                    </div>

                                    <div id="printableArea">
                                        <div class="company-section mt-4">
                                            <div class="row">
                                                <div class="col-md-6 text-left pl-2">
                                                    <img src="/assets/frontend/img/logo/logo.png" width="120px" alt="">
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <p v-if="order_details.company_name">{{ order_details.company_name }}</p>
                                                    <p v-if="order_details.company_phone">{{ order_details.company_phone }}</p>
                                                    <p v-if="order_details.company_address">{{ order_details.company_address }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-left mb-4">
                                            <h3>INVOICE</h3>
                                        </div>

                                        <div class="invoice-section">
                                            <div class="row" v-if="order_details.ship_to_gift == 1">
                                                <div class="col-md-4 text-left">
                                                    <p v-if="order_details.customer_name">Name: {{ order_details.customer_name }}</p>
                                                    <p v-if="order_details.customer_phone">Phone: {{ order_details.customer_phone }}</p>
                                                    <p v-if="order_details.customer_email">Email: {{ order_details.customer_email }}</p>
                                                    <p class="invoice_address" v-if="order_details.customer_address">Address: {{ order_details.customer_address }}</p>
                                                </div>
                                                <div class="col-md-4 text-left">
                                                    <h5>Shipping Details:</h5>
                                                    <p class="mt-2" v-if="order_details.shipping_name">Name: {{ order_details.shipping_name }}</p>
                                                    <p v-if="order_details.shipping_phone">Phone: {{ order_details.shipping_phone }}</p>
                                                    <p v-if="order_details.shipping_email">Email: {{ order_details.shipping_email }}</p>
                                                    <p class="invoice_address" v-if="order_details.shipping_address">Address: {{ order_details.shipping_address }}</p>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <p>Invoice Number: {{ order_details.invoice_no }}</p>
                                                    <p>Order Date: {{ order_details.invoice_date | timeFormat }}</p>
                                                    <p v-if="order_details.delivery_date">Delivery Date: {{ order_details.delivery_date | timeFormat }}</p>
                                                    <p v-if="order_details.payment_type == 1">Payment Method: Cash on Delivery</p>
                                                    <p v-else>Payment Method: Online Payment</p>
                                                    <p v-if="order_details.card_name">Greetings Card: {{ order_details.card_name }}</p>
                                                    <p v-if="order_details.pacakging_name">Packaging: {{ order_details.pacakging_name }}</p>
                                                </div>
                                            </div>

                                            <div class="row" v-else>
                                                <div class="col-md-6 text-left">
                                                    <p v-if="order_details.customer_name">Name: {{ order_details.customer_name }}</p>
                                                    <p v-if="order_details.customer_phone">Phone: {{ order_details.customer_phone }}</p>
                                                    <p v-if="order_details.customer_email">Email: {{ order_details.customer_email }}</p>
                                                    <p class="invoice_address" v-if="order_details.customer_address">Address: {{ order_details.customer_address }}</p>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <p>Invoice Number: {{ order_details.invoice_no }}</p>
                                                    <p>Order Date: {{ order_details.invoice_date | timeFormat }}</p>
                                                    <p v-if="order_details.delivery_date">Delivery Date: {{ order_details.delivery_date | timeFormat }}</p>

                                                    <p>Payment Method: {{ this.payment_method_type }}</p>
                                                    <!-- <p v-else-if="order_details.payment_type != 1">Payment Method: Online Payment</p> -->
                                                    <!-- <p v-show="this.order_details.bkash_check === 5 && this.order_details.payment_type === 1" >Payment Method: Bkash</p>
                                                    <p v-show="this.order_details.bkash_check != 5 && this.order_details.payment_type != 1" >Payment Method: Online Payment</p>
                                                    <p v-show="this.order_details.bkash_check != '' && this.order_details.payment_type === 1 && this.order_details.bkash_check != 5"> Payment Method: Cash on Delivery</p> -->

                                                    <p v-if="order_details.card_name">Greetings Card: {{ order_details.card_name }}</p>
                                                    <p v-if="order_details.pacakging_name">Packaging: {{ order_details.pacakging_name }}</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="table-section mt-4">
                                            <el-table ref="multipleTable" :data="order_details.order_details" style="width: 100%">
                                                <el-table-column type="index" label="SL." width="50"></el-table-column>
                                                <el-table-column v-if="order_details.order && order_details.order.order_attributes.length > 0" label="Product" width="220">
                                                    <template slot-scope="scope">
                                                        {{ scope.row.product.product_name}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column v-else label="Product" width="350">
                                                    <template slot-scope="scope">
                                                        {{ scope.row.product.product_name}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="SKU" width="120">
                                                    <template slot-scope="scope">
                                                        {{ scope.row.product.product_sku}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="Attributes" width="160" v-if="order_details.order && order_details.order.order_attributes.length > 0">
                                                    <template slot-scope="scope">
                                                        <span v-for="attribute in order_details.order.order_attributes" :key="attribute.id">
                                                            <span v-if="attribute.product_id == scope.row.product.id">
                                                                <span v-if="attribute.color"><b>Color:</b> {{ attribute.color }}</span>
                                                                <span v-if="attribute.color && attribute.size">,</span>
                                                                <span v-if="attribute.size"><b>Size:</b> {{ attribute.size }}</span>
                                                                <span v-if="attribute.size && attribute.weight">,</span>
                                                                <span v-if="attribute.weight"><b>Weight:</b> {{ attribute.weight }}</span>
                                                            </span>
                                                        </span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="Quantity" width="120">
                                                    <template slot-scope="scope">
                                                        {{ scope.row.quantity}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="Price(৳)" width="120">
                                                    <template slot-scope="scope">
                                                        {{ scope.row.price}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="Total(৳)" width="220">
                                                    <template slot-scope="scope">
                                                        {{ scope.row.total_amount}}
                                                    </template>
                                                </el-table-column>

                                                <!--<el-table-column label="Status" width="200">
                                                    <template slot-scope="scope">
                                                            <el-select @change="changeStatus(scope.row.status, scope.row.id)" :ref="'status'+ scope.$index" v-model="scope.row.status" placeholder="Select Status" filterable >
                                                                <el-option
                                                                    v-for="status in shipping_statuses"
                                                                    :key="status.id"
                                                                    :label="status.name"
                                                                    :value="status.name">
                                                                </el-option>
                                                            </el-select>
                                                    </template>
                                                </el-table-column>-->
                                            </el-table>
                                        </div>

                                        <div class="calculation-section mt-4">
                                            <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6 text-right">
                                                    <div class="row">
                                                        <div class="col-md-6 text-left">
                                                            <p>Sub Total: </p>
                                                            <!-- <p>VAT: </p> -->
                                                            <p>Shipping Charge: </p>
                                                            <p>Greetings Card: </p>
                                                            <p>Packaging: </p>
                                                            <!-- <p>Discount: </p> -->
                                                            <p>Total: </p>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <p v-for="total in order_details.total_amount">{{ total.total }}</p>
                                                            <!-- <p>
                                                                <span v-if="order_details.order.total_vat">{{ order_details.order.total_vat }}</span>
                                                                <span v-else>0.00</span>
                                                            </p> -->
                                                            <p>
                                                                <span v-if="order_details.shipping_charge">{{ order_details.shipping_charge }}</span>
                                                                <span v-else>0.00</span>
                                                            </p>
                                                            <p>
                                                                <span v-if="order_details.card_price">{{ order_details.card_price }}</span>
                                                                <span v-else>0</span>
                                                            </p>
                                                            <p>
                                                                <span v-if="order_details.packaging_price">{{ order_details.packaging_price }}</span>
                                                                <span v-else>0</span>
                                                            </p>
                                                            <!-- <p>
                                                                <span v-if="order_details.discount_amount">{{ order_details.discount_amount }}</span>
                                                                <span v-else>0.00</span>
                                                            </p> -->
                                                            <p>
                                                                <span v-if="order_details.net_receiveable_amount">{{ order_details.net_receiveable_amount }}</span>
                                                                <span v-else>0.00</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start Footer Section-->
                                    <!--<div class="signTitle">
                                        <table class="table signature" border="0">
                                            <tr>
                                                <td><span class="line fontSize">Received by</span></td>
                                                <td>
                                                    <span class="fontSize"><img src="/assets/frontend/img/invoice/facebook.png" width="18" height="18" alt="Facebook">/charismaticbd</span><br>
                                                    <span class="fontSize"><img src="/assets/frontend/img/invoice/instagram.png" width="18" height="18" alt="Instagram">/charismatic.bd</span>
                                                </td>
                                                <td><span class="line fontSize">Authorized by</span></td>
                                            </tr>
                                        </table>
                                    </div>-->
                                    <!--<div class="footer">
                                        <p class="footer-text">Powered by Stygen</p>
                                    </div>-->
                                    <!--End Footer Section-->
                                </div>
                            </div>

                            <div class="card" v-if="order_details.personal_notes">
                                <div class="card-body">
                                    <p><b>Personal Note: </b>{{ order_details.personal_notes }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { log } from 'util';
    export default {
        name: "OrderDetails",
        data() {
            return {
                status: '',
                payment_method_type: ''
            }
        },
        methods: {
            printInvoice(printableArea){
                //window.print()
                var printContents = document.getElementById(printableArea).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            },
            getOrderDetails(){
                this.$store.dispatch('aorder/getOrderDetails', this.$route.params.id)
            },
            shippingStatus(){
                this.$store.dispatch('aorder/shippingStatus')
            },
            payment_method() {
                if(this.order_details.payment_type == 1 && this.order_details.bkash_check == '') {
                    this.payment_method_type = "Cash on Delivery"
                }
                else if(this.order_details.bkash_check === 5 && this.order_details.payment_type === 1) {
                    console.log(this.order_details.bkash_check);
                    this.payment_method_type = "Bkash"
                }
                else {
                    this.payment_method_type = "Online payment"
                }
            },
            refund() {
                axios.post('/bkash_refund', this.order_details)
                .then(response => {
                    let data = JSON.parse(response.data);
                    if(data.errorCode) {
                        this.$message({
                            showClose: true,
                            message: data.errorMessage,
                            type: 'error'
                        });
                    }
                    this.$message({
                        showClose: true,
                        message: 'refund request sent',
                        type: 'success'
                    });
                }).catch(e => {
                    console.log(e);
                })
            },
            refund_status() {
                axios.post('/bkash_refund_status', this.order_details)
                .then(response => {
                    let data = JSON.parse(response.data);
                    if(data.errorCode) {
                        this.$message({
                            showClose: true,
                            message: data.errorMessage,
                            type: 'error'
                        });
                    }
                    this.$message({
                        showClose: true,
                        message: response.data,
                        type: 'success'
                    });
                    console.log(response.data);
                }).catch(e => {
                    console.log(e);
                })
            }
            // changeStatus(status, order_details_id){
            //     this.$confirm('Are you sure want to change this status. Continue?', 'Warning', {
            //         confirmButtonText: 'OK',
            //         cancelButtonText: 'Cancel',
            //         type: 'warning'
            //         }).then(() => {
            //             axios.post('/admin/order-status-update', {'status': status, 'order_details_id':order_details_id})
            //             .then((result) => {
            //                 this.getOrderDetails();
            //                 this.$message({
            //                     showClose: true,
            //                     message: 'Status successful changed.',
            //                     type: 'success'
            //                 });
            //                 }).catch((error) => {

            //             });
            //         }).catch(() => {
            //             this.$message({
            //                 type: 'info',
            //                 message: 'Status Change canceled'
            //             });
            //     });
            // }
        },
        computed:{
            order_details(){
                return this.$store.getters['aorder/getOrderDetails'];
            },
            shipping_statuses(){
                return this.$store.getters['aorder/shippingStatus'];
            },


        },

        created() {
            this.getOrderDetails();
            this.shippingStatus();
            setTimeout(() => {
                this.payment_method();
            }, 1000);
        }
    }
</script>

<style scoped>
    @media print {
        @page {
            margin-left: 0.5in;
            margin-right: 0.5in;
            margin-top: 0;
            margin-bottom: 0;
        }
    }
</style>
