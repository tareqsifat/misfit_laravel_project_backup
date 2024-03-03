export const order = {
    namespaced: true,
    state:{
        user_orders: [],
        orders: [],
        order_details: {},
        shipping_statuses: []
    },
    getters:{
        user_orders(state){
            return state.user_orders;
        },
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
        user_orders(context, payload){
            axios.get('/orders-list/?page='+payload)
                .then((result) => {
                    context.commit('user_orders', result.data.user_orders)
                }).catch((error) => {

            });
        },
        orderList(context, payload){
            axios.get('/seller/order-list/?page='+payload.page+'&keyword='+payload.keyword)
                .then((result) => {
                    context.commit('orderList', result.data.orders)
                }).catch((error) => {

            });
        },
        getOrderDetails(context, payload){
            axios.get('/seller/order-details/'+payload)
                .then((result) => {
                    context.commit('getOrderDetails', result.data)
                }).catch((error) => {

            });
        },
        shippingStatus(context){
            axios.get('/seller/get-shipping-status')
                .then((result) => {
                    context.commit('shippingStatus', result.data.shipping_statuses)
                }).catch((error) => {

            });
        },
        searchSellerOrder(context, payload){
            axios.get('/seller/search-order/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('orderList', response.data.orders)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        user_orders(state, payload){
            return state.user_orders = payload
        },
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
