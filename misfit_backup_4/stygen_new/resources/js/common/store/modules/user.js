export const user = {
    namespaced: true,
    state:{
        user: {},
    },
    getters:{
        getUserDetails(state){
            return state.user;
        },
    },
    actions:{
        getUser(context){
            axios.get('/user/user-details')
            .then((result) => {
                context.commit('getUser', result.data.user)
            }).catch((error) => {

            });
        },
        userLogout(context){
            axios.post('/logout')
            .then((result) => {
                context.commit('getUser', result.data)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        getUser(state, payload){
            return state.user = payload
        }
    }
}
