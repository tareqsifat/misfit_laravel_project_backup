export const coupon = {
    namespaced: true,
    state:{
        coupons: [],
    },
    getters:{
        couponList(state){
            return state.coupons;
        }
    },
    actions:{
        couponList(context, payload){
            axios.get('/admin/coupon/?page='+payload)
            .then((result) => {
                context.commit('couponList', result.data.coupons)
            }).catch((error) => {

            });
        },
        searchCoupon(context, payload) {
            axios.get('/admin/search-coupon/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('couponList', response.data.coupons)
                }).catch((error) => {

            });
        },
        couponDelete(context, payload){
            axios.delete('/admin/coupon/'+payload)
            .then((result) => {
                context.commit('couponList', result.data.coupons)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        couponList(state, payload){
            return state.coupons = payload
        },
    }
}
