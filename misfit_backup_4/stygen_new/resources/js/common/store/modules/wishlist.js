export const wishlist = {
    namespaced: true,
    state:{
        wishlists: []
    },
    getters:{
        getWishlist(state){
            return state.wishlists;
        }
    },
    actions:{
        getWishlist(context, payload){
            axios.get('/user/wishlist/?page='+payload)
                .then((result) => {
                    context.commit('getWishlist', result.data.wishlists)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        getWishlist(state, payload){
            return state.wishlists = payload
        }
    }
}
