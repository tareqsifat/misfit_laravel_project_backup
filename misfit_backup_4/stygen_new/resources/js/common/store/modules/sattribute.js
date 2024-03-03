export const sattribute = {
    namespaced: true,
    state:{
        attributes: [],
        all_attributes: [],
        attribute_names: []
    },
    getters:{
        getAllAttributes(state){
            return state.attributes;
        },
        getAttributes(state){
            return state.all_attributes;
        },
        attributeNameList(state){
            return state.attribute_names;
        }
    },
    actions:{
        attributeList(context, payload){
            axios.get('/seller/attribute/?page='+payload)
                .then((result) => {
                    context.commit('attributeList', result.data.attributes)
                }).catch((error) => {

            });
        },
        attributeNameList(context){
            axios.get('/seller/attribute-name-list')
                .then((result) => {
                    context.commit('attributeNameList', result.data.attribute_names)
                }).catch((error) => {

            });
        },
        attributeDelete(context, payload){
            axios.delete('/seller/attribute/'+payload)
            .then((result) => {
                context.commit('attributeList', result.data.attributes)
            }).catch((error) => {

            });
        },
        getAttributes(context, payload){
            axios.get('/seller/get-product-attributes')
                .then((result) => {
                    context.commit('getAttributes', result.data.attributes)
                }).catch((error) => {

            });
        },
    },
    mutations:{
        attributeList(state, payload){
            return state.attributes = payload
        },
        getAttributes(state, payload){
            return state.all_attributes = payload
        },
        attributeNameList(state, payload){
            return state.attribute_names = payload
        }
    }
}
