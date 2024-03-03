export const admin = {
    namespaced: true,
    state:{
        admin: {},
        subscribes: []
    },
    getters:{
        getAdminDetails(state){
            return state.admin;
        },
        subscribeList(state){
            return state.subscribes;
        }
    },
    actions:{
        getAdmin(context){
            axios.get('/admin/admin-details')
                .then((result) => {
                    context.commit('getAdmin', result.data.admin)
                }).catch((error) => {

            });
        },
        subscribeList(context, payload){
            axios.get('/admin/subscribe-list/?page='+payload)
            .then((result) => {
                context.commit('subscribeList', result.data.subscribes)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        getAdmin(state, payload){
            return state.admin = payload
        },
        subscribeList(state, payload){
            return state.subscribes = payload
        }
    }
}
