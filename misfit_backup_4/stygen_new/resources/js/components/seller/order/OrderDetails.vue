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
                                    <div class="text-right">
                                        <button @click.prevent="printInvoice('printableArea')" class="btn btn-danger btn-sm">Print</button>
                                    </div>

                                    <div id="printableArea">
                                        <div class="company-section mt-4">
                                            <div class="row">
                                                <div class="col-md-6 text-left pl-0">
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
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    <p v-if="order_details.customer_name">Name: {{ order_details.customer_name }}</p>
                                                    <p v-if="order_details.customer_phone">Phone: {{ order_details.customer_phone }}</p>
                                                    <p v-if="order_details.customer_email">Email: {{ order_details.customer_email }}</p>
                                                    <p v-if="order_details.customer_address">Address: {{ order_details.customer_address }}</p>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <p>Invoice Number: {{ order_details.invoice_no }}</p>
                                                    <p>Order Date: {{ order_details.invoice_date | timeFormat }}</p>
                                                    <p v-if="order_details.delivery_date">Delivery Date: {{ order_details.delivery_date | timeFormat }}</p>
                                                    <p v-if="order_details.payment_type == 1">Payment Method: Cash on Delivery</p>
                                                    <p v-else>Payment Method: Online Payment</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-section mt-4">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="5%">SL.</th>
                                                    <th width="25%">Product</th>
                                                    <th v-if="order_details.order && order_details.order.order_attributes.length > 0" width="15%">Attributes</th>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Quantity</th>
                                                    <th width="15%">Price</th>
                                                    <th width="20%">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(order_detail, index) in order_details.order_details" :key="order_detail.id">
                                                        <td>{{ index + 1 }}</td>
                                                        <td>{{ order_detail.product.product_name }}</td>
                                                        <td v-if="order_details.order && order_details.order.order_attributes" v-for="attribute in order_details.order.order_attributes" :key="attribute.id">
                                                            <span v-if="attribute.product_id == order_detail.product.id">
                                                                <span v-if="attribute.color"><b>Color:</b> {{ attribute.color }}</span>
                                                                <span v-if="attribute.color && attribute.size">,</span>
                                                                <span v-if="attribute.size"><b>Size:</b> {{ attribute.size }}</span>
                                                                <span v-if="attribute.size && attribute.weight">,</span>
                                                                <span v-if="attribute.weight"><b>Weight:</b> {{ attribute.weight }}</span>
                                                            </span>
                                                        </td>
                                                        <td>{{ order_detail.product.product_sku }}</td>
                                                        <td>{{ order_detail.quantity }}</td>
                                                        <td>{{ order_detail.price }}</td>
                                                        <td>{{ order_detail.total_amount }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="calculation-section mt-4">
                                            <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6 text-right">
                                                    <div class="row">
                                                        <div class="col-md-6 text-left">
                                                            <p>Sub Total: </p>
                                                            <p>Discount: </p>
                                                            <p>Total: </p>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <p v-for="total in order_details.total_amount">{{ total.total }}</p>
                                                            <p>
                                                                <span v-if="order_details.discount_amount">{{ order_details.discount_amount }}</span>
                                                                <span v-else>0</span>
                                                            </p>
                                                            <p>
                                                                <span v-if="order_details.net_receivable">{{ order_details.net_receivable }}</span>
                                                                <span v-else>0</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderDetails",
        data() {
            return {

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
                this.$store.dispatch('order/getOrderDetails', this.$route.params.id)
            }
        },
        computed:{
            order_details(){
                return this.$store.getters['order/getOrderDetails'];
            }
        },
        created() {
            this.getOrderDetails();
        }
    }
</script>

<style scoped>

</style>
