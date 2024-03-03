<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
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

    <script>
        document.addEventListener("DOMContentLoaded", function(){

            var total_amount = {!! $total_amount !!};
            var product_skus = @json($skus);
            // console.log(product_skus, total_amount);
            fbq('track', 'Purchase',{
                value: total_amount,
                currency: 'BDT',
                content_ids: product_skus,
                content_type: 'product'
            });
        });
    </script>
</div>
