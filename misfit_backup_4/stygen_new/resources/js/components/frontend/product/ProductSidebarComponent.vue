<template>
    <div id="product_sidebar">
        <!--Shop Product Categorie Start-->
        <div class="shop-product-cate mb-20">
            <template v-if="mobileCatDiv">
                <h3 @click.prevent="mobileViewSidebarCat" class="sidebarCategory">
                    <div class="row">
                        <div class="col-10">Categories</div>
                        <div class="col-2"><i class="fas fa-chevron-down fa-sm"></i></div>
                    </div>
                </h3>

                <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style" v-show="mobileViewCatCollapse">
                    <ul class="category-sub-menu">
                        <li v-for="category in categories" :key="category.id" :class="category.subcategory.length > 0 ? 'has-sub' : ''">
                            <router-link :to="{name: 'subCategoryProduct', params: {catSlug:category.cat_slug}}">{{ category.category_name }}</router-link>
                            <ul :class="category.subcategory.length > 0 ? 'category-sub':''" v-if="category.subcategory">
                                <li v-for="subcategory in category.subcategory" :key="subcategory.id" :class="subcategory.subcategory.length > 0 ? 'has-sub' : ''">
                                    <router-link :to="{name: 'subCategoryProduct', params: {catSlug:subcategory.cat_slug}}">{{ subcategory.category_name }}</router-link>
                                    <product-sub-category-sidebar :subcategories="subcategory.subcategory"></product-sub-category-sidebar>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </template>

            <template v-else>
                <h3 class="sidebarCategory">Categories</h3>

                <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
                    <ul class="category-sub-menu">
                        <li v-for="category in categories" :key="category.id" :class="category.subcategory.length > 0 ? 'has-sub' : ''">
                            <router-link :to="{name: 'subCategoryProduct', params: {catSlug:category.cat_slug}}">{{ category.category_name }}</router-link>
                            <ul :class="category.subcategory.length > 0 ? 'category-sub':''" v-if="category.subcategory">
                                <li v-for="subcategory in category.subcategory" :key="subcategory.id" :class="subcategory.subcategory.length > 0 ? 'has-sub' : ''">
                                    <router-link :to="{name: 'subCategoryProduct', params: {catSlug:subcategory.cat_slug}}">{{ subcategory.category_name }}</router-link>
                                    <product-sub-category-sidebar :subcategories="subcategory.subcategory"></product-sub-category-sidebar>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </template>
        </div>

        <!--Shop Product Categorie End-->
        <!--Brand Categorie Widget Start-->
        <!--<div class="shop-sidebar mb-20">
            <h3>Brand</h3>
            <div class="shop-checkbox">
                <ul>
                    <li><input name="product-categori" type="checkbox"><a href="#">Graphic Corner (5)</a></li>
                    <li><input name="product-categori" type="checkbox"><a href="#">Studio Design (8)</a></li>
                </ul>
            </div>
        </div>-->
        <!--Brand Categorie Widget End-->
        <!--Price Categorie Widget Start-->
        <!--<div class="shop-sidebar mb-20">
            <h3>Price</h3>
            <div class="shop-checkbox">
                <ul>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$18.00 - $21.00 (1)</a></li>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$30.00 - $37.00 (1)</a></li>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$54.00 - $62.00 (1)</a></li>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$72.00 - $83.00 (1)</a></li>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$90.00 - $94.00 (1)</a></li>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$96.00 - $125.00 (1)</a></li>
                    <li><input name="price-filter" checked="" type="radio"><a href="#">$176.00 - $364.00 (7)</a></li>
                </ul>
            </div>
        </div>-->
        <!--Price Categorie Widget End-->
        <!--Color Categorie Widget Start-->
        <!-- <div class="shop-sidebar mb-20">
            <h3>Color</h3>
            <div class="shop-checkbox">
                <ul>
                    <li v-for="variation in variations" :key="variation.id">
                        <a href="#" v-if="variation.attribute_name == 'Color'" @click="filterByVariation(variation.attribute_value)"><span :style="'background: '+variation.attribute_value" class="color"></span>{{ variation.attribute_value }}</a>
                    </li>
                </ul>
            </div>
        </div> -->
        <!--Color Categorie Widget End-->

        <!--Size Categorie Widget Strat-->
        <!-- <div class="shop-sidebar mb-20">
            <h3>Size</h3>
            <div class="shop-checkbox">
                <ul>
                    <li v-for="variation in variations" :key="variation.id">
                        <a href="#" v-if="variation.attribute_name == 'Size'" @click="filterByVariation(variation.attribute_value)">{{ variation.attribute_value }}</a>
                    </li>
                </ul>
            </div>
        </div> -->
        <!--Size Categorie Widget End-->

        <!--Weight Categorie Widget Strat-->
        <!-- <div class="shop-sidebar mb-20">
            <h3>Weight</h3>
            <div class="shop-checkbox">
                <ul>
                    <li v-for="variation in variations" :key="variation.id">
                        <a href="#" v-if="variation.attribute_name == 'Weight'" @click="filterByVariation(variation.attribute_value)">{{ variation.attribute_value }}</a>
                    </li>
                </ul>
            </div>
        </div> -->
        <!--Weight Categorie Widget End-->

        <!--Dimension Categorie Widget Start-->
        <!--<div class="shop-sidebar mb-20">
            <h3>Dimension</h3>
            <div class="shop-checkbox">
                <ul>
                    <li><input name="product-categori" type="checkbox"><a href="#">40x60cm (3)</a></li>
                    <li><input name="product-categori" type="checkbox"><a href="#">60x90cm (3)</a></li>
                    <li><input name="product-categori" type="checkbox"><a href="#">80x120cm (3)</a></li>
                </ul>
            </div>
        </div>-->
        <!--Dimension Categorie Widget End-->
    </div>
</template>

<script>
    import ProductSubCategorySidebar from './ProductSubCategorySidebar';
    import $ from 'jquery'
    export default {
        name: "ProductSidebarComponent",
        components: {
            ProductSubCategorySidebar
        },
        data(){
            return{
                mobileCatDiv : false,
                mobileViewCatCollapse : false
            }
        },

        methods: {
            getAllVariations(){
                this.$store.dispatch('product/getAllVariations');
            },
            browseCategoryList(){
                this.$store.dispatch('category/browseCategoryList');
            },
            // filterByVariation(variation){
            //     this.$store.dispatch('product/filterByVariation', variation);
            // },
            mobileViewSidebarCat() {
                if(this.mobileViewCatCollapse == true) {
                    this.mobileViewCatCollapse = false
                }else {
                    this.mobileViewCatCollapse = true
                }
            },
            isMobile() {
                if (screen.width <= 768) {
                    this.mobileCatDiv = true
                } else {
                    this.mobileCatDiv = false
                }
            }
        },

        computed: {
            variations(){
                return this.$store.getters['product/getAllVariations']
            },
            categories(){
                return this.$store.getters['category/browseCategoryList'];
            }
        },

        created() {
            this.getAllVariations();
            this.browseCategoryList();
            this.isMobile();
        }
    }
</script>

<style scoped>

</style>
