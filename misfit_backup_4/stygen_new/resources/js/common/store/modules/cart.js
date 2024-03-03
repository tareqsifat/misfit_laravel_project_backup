export const cart = {
    namespaced: true,
    state:{
        products: [],
    },
    getters:{
        productList(state){
            return state.products;
        }
    },
    actions:{
        productList(context){
            axios.get('/cart/product-list')
                .then((result) => {
                    context.commit('productList', result.data)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        productList(state, payload){
            return state.products = payload
        }
    }
}
