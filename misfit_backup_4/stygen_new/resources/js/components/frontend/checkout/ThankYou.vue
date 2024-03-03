<template>
    <div id="thank_you" class="mt-5">
        <!--Thank You Area Start-->
		<div class="error-404-area mt-4">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12">
		                <div class="error-wrapper text-center mb-5">
		                    <div class="error-text">
		                        <h2>Thank You!</h2>
		                        <p>We have received your order. You will get an Email containing the details of the purchase.</p>
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Rate your shopping experince</h3>
                                        <h5 class="card-text mb-2">Provide us a review of your shopping</h5>
                                        <a href="https://g.page/r/CUAAp1F64rPOEAg/review" class="btn btn-primary review-btn">Write a review</a>
                                    </div>
                                </div>
		                    </div>
		                    <!-- <div class="error-button mb-5">
		                        <router-link :to="{name: 'landing'}">Back to Home Page</router-link>
		                        <router-link :to="{name: 'userDashboard'}">My Account</router-link>
		                    </div> -->
		                </div>

		            </div>
		        </div>
		    </div>
		</div>
		<!--Thank You Area End-->
    </div>
</template>
<script>
    export default {
        name: 'ThankYou',
        props:['order_id'],
        methods:{
            googlePurchaseEvent() {

                var orderId = this.$route.query.order_id;
                axios.post('get-purchase-record', {'order_id': orderId})
                    .then((result) => {
                        var total_amount = result.data.total_amount;
                        var product_skus = result.data.skus;
                        const productdata = result.data.productInfos;

                        gtag('event', 'conversion', {
                            'send_to': 'AW-10829188403/EXp_CKrVo6IDELOa4aso',
                            'transaction_id': orderId,
                            'value': total_amount,
                            'currency': 'BDT',
                        });

                        // for (let i = 0; i < productdata.length; i++) {
                        //     product_data = productdata[i];
                            console.log(productdata);
                            dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
                            dataLayer.push({
                            'event':'transaction',
                            'ecommerce': {
                                'purchase': {
                                'actionField': {
                                    'id': orderId,                         // Transaction ID. Required for purchases and refunds.
                                    'affiliation': 'Online Store',
                                    "currency": "BDT",
                                    'revenue': total_amount,                     // Total transaction value (incl. tax and shipping),
                                },
                                'products': [{                            // List of productFieldObjects.
                                    'name': productdata.product_name,     // Name or ID is required.
                                    'id': productdata.id,
                                    'price': productdata.regular_price                           // Optional fields may be omitted or set to empty string.
                                }],

                                }
                            }
                        });

                        // }
                        // productdata.forEach(element => console.log(element));

                    }).catch((error) => {
                });
                console.log(orderId);
            },
            facebookPurchaseEvent(){
                var orderId = this.$route.query.order_id;
                axios.post('get-purchase-record', {'order_id': orderId})
                    .then((result) => {
                        var total_amount = result.data.total_amount;
                        var product_skus = result.data.skus;
                        fbq('track', 'Purchase',{
                            value: total_amount,
                            currency: 'BDT',
                            content_ids: product_skus,
                            content_type: 'product'
                        });
                    }).catch((error) => {
                });
            }
        },
        created() {
            this.facebookPurchaseEvent();
            this.googlePurchaseEvent();
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Thank You | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>
.error-text h2 {
    font-size: 25px;
    font-weight: 600;
}
.error-text p {
    font-size: 18px;
    font-weight: 500;
}
.card-img-top {
    height: 150px;
    width: 150px;
}
.review-btn {
    background-color: #5e2e87;
    border-radius: 25px;
}
.center-block {
    display: block;
    margin-left: auto;
    margin-right: auto;
 }
</style>
