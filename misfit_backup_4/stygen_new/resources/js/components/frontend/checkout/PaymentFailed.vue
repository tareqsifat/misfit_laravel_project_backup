<template>
    <div id="payment_failed">
        <!--Thank You Area Start-->
		<div class="error-404-area mt-4">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12">
		                <div class="error-wrapper text-center">
		                    <div class="error-text">
		                        <h2>Payment Failed!</h2>
		                        <p>Payment failed but we have received your order. You can pay later.</p>
		                    </div>
		                    <div class="error-button mb-5">
		                        <router-link :to="{name: 'landing'}">Back to Home Page</router-link>
		                        <router-link :to="{name: 'userDashboard'}">My Account</router-link>
		                    </div>
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
        name: 'PaymentFailed',
        props:['order_id'],
        methods:{
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
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Payment Failed | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
