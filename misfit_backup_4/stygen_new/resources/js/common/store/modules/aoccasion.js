export const aoccasion = {
    namespaced: true,
    state:{
        all_occasions: [],
    },
    getters:{
        getAllOccassion(state){
            return state.all_occasions;
        }
    },
    actions:{
        getAllOccassion(context, payload){
            axios.get('/admin/get-all-occasion')
            .then((result) => {
                context.commit('getAllOccassion', result.data.occasions)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        getAllOccassion(state, payload){
            return state.all_occasions = payload
        }
    }
}
