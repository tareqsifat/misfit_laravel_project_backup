export const ashipping = {
    namespaced: true,
    state:{
        shipping_charges: [],
        shippings: [],
    },
    getters:{
        shippingChargeList(state){
            return state.shipping_charges;
        },
        sellerShippingList(state){
            return state.shippings;
        }
    },
    actions:{
        shippingChargeList(context, payload){
            axios.get('/admin/shippings-charge/?page='+payload)
            .then((result) => {
                context.commit('shippingChargeList', result.data.shipping_charges)
            }).catch((error) => {

            });
        },
        sellerShippingList(context){
            axios.get('/admin/seller-shippings-charge')
            .then((result) => {
                context.commit('sellerShippingList', result.data.shippings)
            }).catch((error) => {

            });
        },
        checkoutShippingList(context){
            axios.get('shippings-charge-checkout')
            .then((result) => {
                context.commit('sellerShippingList', result.data.shippings)
            }).catch((error) => {

            });
        },
        shippingChargeDelete(context, payload){
            axios.delete('/admin/shippings-charge/'+payload)
            .then((result) => {
                context.commit('shippingChargeList', result.data.shipping_charges)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        shippingChargeList(state, payload){
            return state.shipping_charges = payload
        },
        sellerShippingList(state, payload){
            return state.shippings = payload
        }
    }
}
