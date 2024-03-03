export const attribute = {
    namespaced: true,
    state:{
        attributes: [],
        all_attributes: [],
    },
    getters:{
        getAllAttributes(state){
            return state.attributes;
        },
        getAttributes(state){
            return state.all_attributes;
        }
    },
    actions:{
        attributeList(context, payload){
            axios.get('/admin/attribute/?page='+payload.page+'&keyword='+payload.keyword)
                .then((result) => {
                    context.commit('attributeList', result.data.attributes)
                }).catch((error) => {

            });
        },
        attributeDelete(context, payload){
            axios.delete('/admin/attribute/'+payload)
            .then((result) => {
                context.commit('attributeList', result.data.attributes)
            }).catch((error) => {

            });
        },
        getAttributes(context, payload){
            axios.get('/seller/get-product-attributes')
                .then((result) => {
                    context.commit('getAttributes', result.data)
                }).catch((error) => {

            });
        },
        searchAttribute(context, payload){
            axios.get('/seller/search-attribute/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('attributeList', response.data.attributes)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        attributeList(state, payload){
            return state.attributes = payload
        },
        getAttributes(state, payload){
            return state.all_attributes = payload
        }
    }
}
