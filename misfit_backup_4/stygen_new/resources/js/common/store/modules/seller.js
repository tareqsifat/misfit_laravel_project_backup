export const seller = {
    namespaced: true,
    state:{
        seller: {},
        sellers: []
    },
    getters:{
        getSellerDetails(state){
            return state.seller;
        },
        adminSellerList(state){
            return state.sellers;
        }
    },
    actions:{
        getSeller(context){
            axios.get('/seller/seller-details')
                .then((result) => {
                    context.commit('getSeller', result.data.seller)
                }).catch((error) => {

            });
        },
        adminSellerList(context, payload){
            axios.get('/admin/seller-lists/?page='+payload)
            .then((result) => {
                context.commit('adminSellerList', result.data.sellers)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        getSeller(state, payload){
            return state.seller = payload
        },
        adminSellerList(state, payload){
            return state.sellers = payload
        }
    }
}
