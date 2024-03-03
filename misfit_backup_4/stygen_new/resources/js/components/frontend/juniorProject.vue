<template>
    <div class="contact_us">
        <!--Breadcrumb Area Start-->
            <div class="container container-slider">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="">
                            <carousel :autoplay="true" :loop="false" :center="true" :nav="false" :items="1" :margin="5" :autoplayHoverPause="true">
                                <img src="/assets/uploads/junior.jpg">
                            </carousel>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center my-2">
                            <p class="first_text">
                                প্রতি শীতে শিশুর জন্য নতুন নতুন পোশাক কেনা হলেও পুরনো পোশাকগুলো ফেলা হয় না। কীভাবে হবে? প্রতিটি পোশাকে যে মিশে থাকে অসংখ্য স্মৃতি। কিন্তু একটু লক্ষ্য করলেই দেখা যাবে আমাদের চারপাশে রয়েছে হাজারো সুবিধাবঞ্চিত শিশু। যারা শীতকালে পর্যাপ্ত পোশাকের অভাবে নিদারুণ কষ্টে ভোগে।
                                এসব সুবিধাবঞ্চিত শিশুদের জন্য আমাদের একটি ছোট উদ্যোগ “দি জুনিয়র প্রজেক্ট”। আমরা চাই আপনার শিশুর অব্যহৃত শীতপোশাকটি হয়ে উঠুক আরেকটি শিশুর প্রয়োজনীয় শীতবস্ত্র।
                            </p>
                            <p class="second-text">
                                আপনার শিশুর অব্যবহৃত শীতবস্ত্র (০-৭ বছর বয়সী শিশুর পরিধানযোগ্য) ডোনেট করতে নিচের ফর্মটি পূরণ করুণ,
                                আমাদের টিম পৌঁছে যাবে আপনার কাছে। আমাদের সকলের সম্মিলিত প্রচেষ্টাই পারে প্রতিটি শিশুর মুখে উষ্ণতার হাসি ফোটাতে।
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <!--Breadcrumb Area End-->
        <!--Contact Us Area Start-->
		<div class="contact-us-area mt-4">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12 col-md-12">
		                <div class="content-wrapper">
		                    <div class="page-content">
		                        <div class="contact-form">
                                    <div class="contact-form-title text-center text-capitalize my-2">
                                        <h3>Junior Project 2021</h3>
                                    </div>
		                            <!-- <form id="contact-form" action="http://preview.hasthemes.com/picaboo-v1/mail.php" method="post">
		                                <div class="row">

		                                </div>
		                            </form> -->

                                    <form>
                                        <div class="form-group">
                                                <label for="name">Name</label>
                                                <input v-model="form.name" type="text" class="form-control" id="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" v-model="form.phone_number" class="form-control" id="phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" v-model="form.address" class="form-control" id="address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="remarks">Remarks</label>
                                                <textarea class="form-control" v-model="form.remarks" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button @click.prevent="addJunior" class="default-btn" type="submit"><span>Submit</span></button>
                                            </div>
                                    </form>
		                            <p class="form-messege"></p>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>


        <div class="modal fade" id="open-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="thank-you-pop">
							<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
							<h1>ধন্যবাদ</h1>
							<p>আপনার তথ্যটি শেয়ার করার জন্য। খুব শীঘ্রই আমাদের টিম আপনার সাথে যোগাযোগ করে কাপড়্গুলো সংগ্রহ করবে।</p>
 						</div>
                    </div>
                </div>
            </div>
        </div>
		<!--Contact Us Area End-->
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    import $ from 'jquery';
    export default {
        name: 'JuniorProject',
        data() {
            return {
                form: {
                    name: '',
                    phone_number: '',
                    address: '',
                    remarks: ''
                }
            }
        },
        components: {
            carousel
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'JuniorProject | Stygen'
                },
                immediate: true
            }
        },
        methods: {
            openModal(){
                $("#open-modal").modal('show');
            },
            addJunior(){
                axios.post('/admin/junior-form-submit', {'name': this.form.name, 'phone_number': this.form.phone_number, 'address': this.form.address, 'remarks': this.form.remarks})
                .then((result) => {
                    this.openModal();
                    }).catch((error) => {
                        console.log(error)
                    });
            },

        },
    }
</script>

<style scoped>
.first_text {
    font-size: 16px;
}
.second-text {
    font-weight: 600;
    font-size: 15px;
}
.thank-you-pop{
	width:100%;
 	padding:20px;
	text-align:center;
}
.thank-you-pop img{
	width:76px;
	height:auto;
	margin:0 auto;
	display:block;
	margin-bottom:25px;
}

.thank-you-pop h1{
	font-size: 42px;
    margin-bottom: 25px;
	color:#5C5C5C;
}
.thank-you-pop p{
	font-size: 20px;
    margin-bottom: 27px;
 	color:#5C5C5C;
}
.thank-you-pop a{
	display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
	margin-right:5px;
	color:#fff;
}
#ignismyModal .modal-header{
    border:0px;
}
</style>
