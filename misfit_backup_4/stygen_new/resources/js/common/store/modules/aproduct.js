export const aproduct = {
    namespaced: true,
    state:{
        products: [],
        all_products:[],
        product_ids: [],
        edit_product: [],
        addon_productlist: [],
        lowstockproducts: []
    },
    getters:{
        getAllProducts(state){
            return state.products;
        },
        getAllProductIDS(state){
            return state.product_ids;
        },
        editProduct(state){
            return state.edit_product;
        },
        getAddonProducts(state) {
            return state.addon_productlist
        },
        getlowstockproducts(state) {
            return state.lowstockproducts
        }
    },
    actions:{
        productList(context, payload){
            axios.get('/admin/product/?page='+payload.page+'&keyword='+payload.keyword+'&category_id='+payload.category_id+'&seller_id='+payload.seller_id+'&stock='+payload.stock)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        productDelete(context, payload){
            axios.delete('/admin/product/'+payload)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        editProduct(context, payload){
            axios.get(`/admin/product/${payload}/edit`)
            .then((result) => {
                context.commit('editProduct', result.data.product)
            }).catch((error) => {

            });
        },
        searchSellerProduct(context, payload){
            axios.get('/admin/search-product/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                }).catch((error) => {

            });
        },
        proCatFilter(context, payload){
            axios.get('/admin/category-product/?page='+payload.page+'&category_id='+payload.category_id+'&seller_id='+payload.seller_id+'&stock='+payload.stock)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                }).catch((error) => {

            });
        },
        proSellerFilter(context, payload){
            axios.get('/admin/seller-product-filter/?page='+payload.page+'&category_id='+payload.category_id+'&seller_id='+payload.seller_id+'&stock='+payload.stock)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                }).catch((error) => {

            });
        },
        proStockFilter(context, payload){
            axios.get('/admin/product-stock-filter/?page='+payload.page+'&category_id='+payload.category_id+'&seller_id='+payload.seller_id+'&stock='+payload.stock)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                    context.commit('productQty', response.data.productQty)
                }).catch((error) => {

            });
        },
        occassionProduct(context, payload){
            axios.get('/admin/occassion-products/?page='+payload.page+'&occasion_id='+payload.occasion_id+'&keyword='+payload.keyword)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        occassionProductList(context, payload){
            axios.get('/admin/occassion-product-list/?page='+payload.page+'&keyword='+payload.keyword+'&occasion_id='+payload.occasion_id)
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        searchOccasionProduct(context, payload){
            axios.get('/admin/search-occassion-product/?page='+payload.page+'&occasion_id='+payload.occasion_id+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('productList', response.data.products)
                }).catch((error) => {

            });
        },
        searchAddonProduct(context, payload){
            axios.get('/admin/search-addon-product/?keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('getAllProducts', response.data.products)
                }).catch((error) => {

            });
        },
        getProducts(context, payload){
            axios.get('/admin/category-wise-product/?page='+payload.page+'&category_id='+payload.category_id+'&occasion_id='+payload.occasion_id)   
            .then((result) => {
                context.commit('productList', result.data.products)
            }).catch((error) => {

            });
        },
        getProductIDs(context, payload){
            axios.get('/admin/category-wise-productids/?page='+payload.page+'&category_id='+payload.category_id+'&occasion_id='+payload.occasion_id)
            .then((result) => {
                context.commit('getAllProductIDS', result.data.product_ids)
            }).catch((error) => {

            });
        },
        getAllProducts(context, payload){
            axios.get('/admin/get-all-products')
            .then((result) => {
                context.commit('getAllProducts', result.data.products)
            }).catch((error) => {

            });
        },
        getAddonProducts(context, payload){
            axios.get('/admin/get-addon-products/')
            .then((result) => {
                let addon_products = Object.values(result.data.products)
                // this.addon_productList = addon_products
                context.commit('getAddonProducts', addon_products)
            }).catch((error) => {

            });
        },
        getlowstockproducts(context, payload){
            axios.get('/admin/low-stock-products/')
            .then((result) => {
                let lowstock = Object.values(result.data.lowstock)
                console.log(lowstock);
                // this.addon_productList = addon_products
                context.commit('getlowstockproducts', lowstock)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        productList(state, payload){
            return state.products = payload
        },
        getAllProducts(state, payload){
            return state.products = payload
        },
        editProduct(state, payload){
            return state.edit_product = payload
        },
        getAddonProducts(state, payload) {
            return state.addon_productlist = payload
        },
        getlowstockproducts(context, payload){
            return state.lowstockproducts = payload
        }

    }
}
