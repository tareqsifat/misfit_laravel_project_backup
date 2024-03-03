export const abrand = {
    namespaced: true,
    state:{
        brands: [],
    },
    getters:{
        getAllBrands(state){
            return state.brands;
        },
        getAllBrand(state){
            return state.brands;
        }
    },
    actions:{
        brandList(context, payload){
            axios.get('/admin/brand/?page='+payload)
            .then((result) => {
                context.commit('brandList', result.data.brands)
            }).catch((error) => {

            });
        },
        brandsList(context){
            axios.get('/admin/brands-list/')
                .then((result) => {
                    context.commit('brandList', result.data.brands)
                }).catch((error) => {

            });
        },
    },
    mutations:{
        brandList(state, payload){
            return state.brands = payload
        }
    }
}
