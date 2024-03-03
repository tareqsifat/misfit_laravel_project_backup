export const brand = {
    namespaced: true,
    state:{
        brands: [],
        all_landing_brands:[]
    },
    getters:{
        getAllBrands(state){
            return state.brands;
        },
        getAllBrandLanding(state){
            return state.all_landing_brands;
        }
    },
    actions:{
        brandList(context, payload){
            axios.get('/seller/brand/?page='+payload.page+'&keyword='+payload.keyword)
            .then((result) => {
                context.commit('brandList', result.data.brands)
            }).catch((error) => {

            });
        },
        brandDelete(context, payload){
            axios.delete('/seller/brand/'+payload)
            .then((result) => {
                context.commit('brandList', result.data.brands)
            }).catch((error) => {

            });
        },
        brandsList(context){
            axios.get('/seller/brands-list/')
                .then((result) => {
                    context.commit('brandList', result.data.brands)
                }).catch((error) => {

            });
        },
        searchBrand(context, payload){
            axios.get('/seller/search-brand/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('brandList', response.data.brands)
                }).catch((error) => {

            });
        },
        getAllBrandLanding(context, payload){
            axios.get('/get-all-landing-brand')
            .then((result) => {
                context.commit('getAllBrandLanding', result.data.brands)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        brandList(state, payload){
            return state.brands = payload
        },
        getAllBrandLanding(state, payload){
            return state.all_landing_brands = payload
        }
    }
}
