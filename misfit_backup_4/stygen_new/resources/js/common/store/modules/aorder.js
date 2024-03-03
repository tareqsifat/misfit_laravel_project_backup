export const aorder = {
    namespaced: true,
    state:{
        orders: [],
        order_details: {},
        shipping_statuses: []
    },
    getters:{
        getAllOrders(state){
            return state.orders;
        },
        getOrderDetails(state){
            return state.order_details;
        },
        shippingStatus(state){
            return state.shipping_statuses;
        }
    },
    actions:{
        orderList(context, payload){
            axios.get('/admin/order-list/?page='+payload.page+'&keyword='+payload.keyword)
                .then((result) => {
                    context.commit('orderList', result.data.orders)
                }).catch((error) => {

            });
        },
        getOrderDetails(context, payload){
            axios.get('/admin/order-details/'+payload)
                .then((result) => {
                    context.commit('getOrderDetails', result.data)
                }).catch((error) => {

            });
        },
        shippingStatus(context){
            axios.get('/admin/get-shipping-status')
                .then((result) => {
                    // context.commit('shippingStatus', result.data.shipping_statuses)
                    context.commit('shippingStatus', result.data)
                }).catch((error) => {

            });
        },
        searchAdminOrder(context, payload){
            axios.get('/admin/search-order/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('orderList', response.data.orders)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        orderList(state, payload){
            return state.orders = payload
        },
        getOrderDetails(state, payload){
            return state.order_details = payload
        },
        shippingStatus(state, payload){
            return state.shipping_statuses = payload
        }
    }
}
