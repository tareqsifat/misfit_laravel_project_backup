export const packaging = {
    namespaced: true,
    state:{
        packagings: [],
        packaging_lists: [],
    },
    getters:{
        packagingList(state){
            return state.packagings;
        },
        checkoutPackagingList(state){
            return state.packaging_lists;
        }
    },
    actions:{
        packagingList(context, payload){
            axios.get('/admin/packaging/?page='+payload)
            .then((result) => {
                context.commit('packagingList', result.data.packagings)
            }).catch((error) => {

            });
        },
        checkoutPackagingList(context){
            axios.get('/checkout-packaging')
            .then((result) => {
                context.commit('checkoutPackagingList', result.data.packaging_lists)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        packagingList(state, payload){
            return state.packagings = payload
        },
        checkoutPackagingList(state, payload){
            return state.packaging_lists = payload
        },
    }
}
