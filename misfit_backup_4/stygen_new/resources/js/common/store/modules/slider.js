export const slider = {
    namespaced: true,
    state:{
        sliders: [],
        all_sliders: [],
        single_sliders: [],
    },
    getters:{
        sliderList(state){
            return state.sliders;
        },
        getAllSlider(state){
            return state.all_sliders;
        },
        getSingleProductSlider(state){
            return state.single_sliders;
        }
    },
    actions:{
        sliderList(context, payload){
            axios.get('/admin/slider/?page='+payload)
            .then((result) => {
                context.commit('sliderList', result.data.sliders)
            }).catch((error) => {

            });
        },
        sliderDelete(context, payload){
            axios.delete('/admin/slider/'+payload)
            .then((result) => {
                context.commit('sliderList', result.data.sliders)
            }).catch((error) => {

            });
        },
        getAllSlider(context, payload){
            axios.get('/admin/get-all-slider')
            .then((result) => {
                context.commit('getAllSlider', result.data.sliders)
            }).catch((error) => {

            });
        },
        getSingleProductSlider(context, payload){
            axios.get('/admin/get-single-slider/?occasion_slug='+payload.occasion_slug)
            .then((result) => {
                context.commit('getSingleProductSlider', result.data.sliders)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        sliderList(state, payload){
            return state.sliders = payload
        },
        getAllSlider(state, payload){
            return state.all_sliders = payload
        },
        getSingleProductSlider(state, payload){
            return state.single_sliders = payload
        }
    }
}
