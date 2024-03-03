export const customer = {
    namespaced: true,
    state:{
        customers: [],
    },
    getters:{
        getAllCustomers(state){
            return state.customers;
        }
    },
    actions:{
        customerList(context, payload){
            axios.get('/seller/customer/?page='+payload)
            .then((result) => {
                context.commit('customerList', result.data.customers)
            }).catch((error) => {

            });
        },
        customerDelete(context, payload){
            axios.delete('/seller/customer/'+payload)
            .then((result) => {
                context.commit('customerList', result.data.customers)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        customerList(state, payload){
            return state.customers = payload
        }
    }
}
