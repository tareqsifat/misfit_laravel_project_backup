import axios from "axios";

export const product = {
    namespaced: true,
    state:{
        products: [],
        product: [],
        all_attributes: [],
        edit_product: [],
        variations: [],
        related_products: [],
        trending_products: [],
        addon_products: []
    },
    getters:{
        getAllProducts(state){
            return state.products;
        },
        getSingleProduct(state){
            return state.product;
        },
        get_addon_products(state){
            return state.addon_products;
        },
        getRelatedProduct(state){
            return state.related_products;
        },
        getTrendingProduct(state) {
            return state.trending_products;
        },
        all_attributes(state){
            return state.all_attributes;
        },
        editProduct(state){
            return state.edit_product;
        },
        getAllVariations(state){
            return state.variations;
        }
    },
    actions:{
        productList(context, payload){
            axios.get('/seller/product/?page='+payload.page+'&keyword='+payload.keyword)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        AllSellerProductList(context, payload){
            axios.get('/seller/all-products')
            .then((result) => {
                // console.log(result);
                context.commit('productList', result.data.products)
            }).catch((error) => {
                console.log(error);
            });
        },
        productDelete(context, payload){
            axios.delete('/seller/product/'+payload)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        getProducts(context, payload){
            axios.get('/product-list/?page='+payload.page+'&keyword='+payload.keyword+'&sort_value='+payload.sort_value)
                .then((result) => {
                    context.commit('productList', result.data.products)
                }).catch((error) => {

            });
        },
        getCategoryProducts(context, payload){
            axios.get('/category-product-list/?page='+payload.page+'&cat_slug='+payload.cat_slug)
                .then((result) => {
                    context.commit('productList', result.data.products)
                }).catch((error) => {

            });
        },
        getOccasionProducts(context, payload){
            axios.get('/occasion-product-list/?page='+payload.page+'&occasion_slug='+payload.occasion_slug)
                .then((result) => {
                    context.commit('productList', result.data.products)
                }).catch((error) => {

            });
        },
        getBrandProducts(context, payload){
            axios.get('/brand-product-list/?page='+payload.page+'&brand_slug='+payload.brand_slug)
                .then((result) => {
                    context.commit('productList', result.data.products)
                }).catch((error) => {

            });
        },
        getSingleProduct(context, payload){
            axios.get('/single-product/'+payload)
                .then((result) => {
                    context.commit('singleProduct', result.data.product)
                    context.commit('addon_products', result.data.addon_products)
                    context.commit('all_attributes', result.data.all_attributes)
                }).catch((error) => {

            });
        },
        getRelatedProduct(context, payload){
            axios.get('/related-product/'+payload)
                .then((result) => {
                    context.commit('getRelatedProduct', result.data.related_products)
                }).catch((error) => {

            });
        },

        getTrendingProduct(context, payload) {
            axios.get('trending-product')
            .then((result) => {
                context.commit('getTrendingProduct', result.data.trending_products)
            }).catch((error) => {

            });
        },
        editProduct(context, payload){
            axios.get(`/seller/product/${payload}/edit`)
            .then((result) => {
                context.commit('editProduct', result.data.product)
            }).catch((error) => {

            });
        },
        getAllVariations(context){
            axios.get('/get-all-variations')
                .then((result) => {
                    context.commit('getAllVariations', result.data.variations)
                }).catch((error) => {

            });
        },
        filterByVariation(context, payload){
            axios.get('/product-variation-filer/?variation='+payload)
                .then((result) => {
                    context.commit('productList', result.data.products)
                }).catch((error) => {

            });
        },
        searchProduct(context, payload){
            axios.get('/search-product/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                }).catch((error) => {

            });
        },
        searchSellerProduct(context, payload){
            axios.get('/seller/search-product/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                }).catch((error) => {

            });
        },
        productSort(context, payload) {
            axios.get('/sort-product/?page='+payload.page+'&keyword='+payload.keyword+'&sort_value='+payload.sort_value)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        categoryProductSort(context, payload) {
            axios.get('/sort-category-product/?page='+payload.page+'&keyword='+payload.keyword+'&sort_value='+payload.sort_value+'&category_slug='+payload.category_slug)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        occassionProductSort(context, payload) {
            axios.get('/sort-occassion-product/?page='+payload.page+'&keyword='+payload.keyword+'&sort_value='+payload.sort_value+'&occasion_slug='+payload.occasion_slug)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        occassionProductSortByCat(context, payload) {
            axios.post('/occassion-product-filter',
            {'occasion_cat': payload.ocassion_cat,
            'page':payload.page,
            'occasion_slug': payload.occasion_slug
            })
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        productList(state, payload){
            return state.products = payload
        },
        ocassion_categories(state, payload) {
            return state.ocassion_categories = payload
        },
        singleProduct(state, payload){
            return state.product = payload
        },
        addon_products(state, payload){
            return state.addon_products = payload
        },
        getRelatedProduct(state, payload){
            return state.related_products = payload
        },
        getTrendingProduct(state, payload) {
            return state.trending_products = payload
        },
        all_attributes(state, payload){
            return state.all_attributes = payload
        },
        editProduct(state, payload){
            return state.edit_product = payload
        },
        getAllVariations(state, payload){
            return state.variations = payload
        }
    }
}
