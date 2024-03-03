export const material = {
    namespaced: true,
    state:{
        materials: [],
    },
    getters:{
        getAllmaterials(state){
            return state.materials;
        }
    },
    actions:{
        materialList(context, payload){
            axios.get('/seller/material/?page='+payload)
                .then((result) => {
                    context.commit('materialList', result.data.materials)
                }).catch((error) => {

            });
        },
        materialDelete(context, payload){
            axios.delete('/seller/material/'+payload)
                .then((result) => {
                    context.commit('materialList', result.data.materials)
                }).catch((error) => {

            });
        },
        materialsList(context){
            axios.get('/seller/material-list/')
                .then((result) => {
                    context.commit('materialList', result.data.materials)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        materialList(state, payload){
            return state.materials = payload
        }
    }
}
