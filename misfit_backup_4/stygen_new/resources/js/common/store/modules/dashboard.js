export const dashboard = {
    namespaced: true,
    state:{
        sale_by_categories: [],
        sale_by_products: [],
        sale_by_sellers: [],
    },
    getters:{
        adminSaleByCateory(state){
            return state.sale_by_categories;
        },
        adminSaleByProduct(state){
            return state.sale_by_products;
        },
        adminSaleBySeller(state){
            return state.sale_by_sellers;
        },
    },
    actions:{
        adminSaleByCateory(context, payload){
            axios.get('/admin/sale-by-category/?page='+payload)
                .then((result) => {
                    context.commit('adminSaleByCateory', result.data)
                }).catch((error) => {

            });
        },
        adminSaleByProduct(context, payload){
            axios.get('/admin/sale-by-product/?page='+payload)
                .then((result) => {
                    context.commit('adminSaleByProduct', result.data)
                }).catch((error) => {

            });
        },
        adminSaleBySeller(context, payload){
            axios.get('/admin/sale-by-seller/?page='+payload)
                .then((result) => {
                    context.commit('adminSaleBySeller', result.data)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        adminSaleByCateory(state, payload){
            return state.sale_by_categories = payload
        },
        adminSaleByProduct(state, payload){
            return state.sale_by_products = payload
        },
        adminSaleBySeller(state, payload){
            return state.sale_by_sellers = payload
        }
    }
}
