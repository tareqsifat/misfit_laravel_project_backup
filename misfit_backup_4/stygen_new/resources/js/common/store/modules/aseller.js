export const aseller = {
    namespaced: true,
    state:{
        sellers: [],
    },
    getters:{
        getAllSeller(state){
            return state.sellers;
        }
    },
    actions:{
        getAllSeller(context) {
            axios.get('/admin/get-all-seller')
                .then((result) => {
                    context.commit('getAllSeller', result.data.sellers)
                }).catch((error) => {
            });
        }
    },
    mutations:{
        getAllSeller(state, payload){
            return state.sellers = payload
        }
    }
}
