export const adattribute = {
    namespaced: true,
    state:{
        all_attributes: [],
    },
    getters:{
        getAttributes(state){
            return state.all_attributes;
        }
    },
    actions:{
        getAttributes(context, payload){
            axios.get('/admin/get-product-attributes')
                .then((result) => {
                    context.commit('getAttributes', result.data)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        getAttributes(state, payload){
            return state.all_attributes = payload
        }
    }
}
