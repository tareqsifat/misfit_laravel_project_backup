export const recipient = {
    namespaced: true,
    state:{
        recipients: [],
        all_recipients: [],
    },
    getters:{
        recipientList(state){
            return state.recipients;
        },
        getAllRecipient(state){
            return state.all_recipients;
        }
    },
    actions:{
        recipientList(context, payload){
            axios.get('/admin/recipient/?page='+payload)
            .then((result) => {
                context.commit('recipientList', result.data.recipients)
            }).catch((error) => {

            });
        },
        recipientDelete(context, payload){
            axios.delete('/admin/recipient/'+payload)
            .then((result) => {
                context.commit('recipientList', result.data.recipients)
            }).catch((error) => {

            });
        },
        getAllRecipient(context, payload){
            axios.get('/get-all-recipient')
            .then((result) => {
                context.commit('getAllRecipient', result.data.recipients)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        recipientList(state, payload){
            return state.recipients = payload
        },
        getAllRecipient(state, payload){
            return state.all_recipients = payload
        }
    }
}
