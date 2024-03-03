export const occasion = {
    namespaced: true,
    state:{
        occasions: [],
        all_occasions: [],
        all_landing_occasions: []
    },
    getters:{
        occasionList(state){
            return state.occasions;
        },
        getAllOccasion(state){
            return state.all_occasions;
        },
        getAllOccasionLanding(state){
            return state.all_landing_occasions;
        }
    },
    actions:{
        occasionList(context, payload){
            axios.get('/admin/occasion/?page='+payload)
            .then((result) => {
                context.commit('occasionList', result.data.occasions)
            }).catch((error) => {

            });
        },
        occasionDelete(context, payload){
            axios.delete('/admin/occasion/'+payload)
            .then((result) => {
                context.commit('occasionList', result.data.occasions)
            }).catch((error) => {

            });
        },
        getAllOccasion(context, payload){
            axios.get('/get-all-occasion')
            .then((result) => {
                context.commit('getAllOccasion', result.data.occasions)
            }).catch((error) => {

            });
        },
        getAllOccasionLanding(context, payload){
            axios.get('/get-all-landing-occasion')
            .then((result) => {
                context.commit('getAllOccasionLanding', result.data.occasions)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        occasionList(state, payload){
            return state.occasions = payload
        },
        getAllOccasion(state, payload){
            return state.all_occasions = payload
        },
        getAllOccasionLanding(state, payload){
            return state.all_landing_occasions = payload
        }
    }
}
