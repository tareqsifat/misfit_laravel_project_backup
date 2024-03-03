<template>
    <div class="card h-100">
        <h2>blog component test</h2>
        <!-- Product image-->
        <!-- <img class="card-img-top" src="/assets/uploads/product/{{$blogproduct->featured_image}}" alt="..."> -->
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">new pro</h5>
                <!-- Product price-->
                <!-- ৳{{ $blogproduct.regular_price }} -->
                $120
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

            <!-- <div class="text-center"><a class="btn btn-dark mt-auto" href="#" @click.prevent="addToCart($blogproduct)">Add to cart</a></div> -->
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            blogproduct: '',
            descriptions: '',
            description_split: '',
            blog_slug: ''
        }
    },
}
</script>
