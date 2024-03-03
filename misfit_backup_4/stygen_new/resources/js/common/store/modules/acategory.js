export const acategory = {
    namespaced: true,
    state:{
        categories: [],
        all_categories: [],
        get_all_categories: [],
    },
    getters:{
        getAllCategories(state){
            return state.categories;
        },
        allCategories(state){
            return state.all_categories;
        },
        getAllCategory(state) {
            return state.get_all_categories;
        }
    },
    actions:{
        categoryList(context, payload){
            axios.get('/admin/category/?page='+payload)
            .then((result) => {
                context.commit('categoryList', result.data.categories)
            }).catch((error) => {

            });
        },
        categoryDelete(context, payload){
            axios.delete('/admin/category/'+payload)
            .then((result) => {
                context.commit('categoryList', result.data.categories)
            }).catch((error) => {

            });
        },
        categoriesList(context){
            axios.get('/admin/categories-list')
                .then((result) => {
                    context.commit('categoryList', result.data.categories)
                }).catch((error) => {

            });
        },
        allCategoriesList(context){
            axios.get('/admin/categories-list')
                .then((result) => {
                    console.log(result)
                    context.commit('allCategoriesList', result.data.categories)
                }).catch((error) => {

            });
        },
        getAllCategory(context) {
            axios.get('/admin/get-all-categories')
                .then((result) => {
                    context.commit('getAllCategory', result.data.get_all_categories)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        categoryList(state, payload){
            return state.categories = payload
        },
        allCategoriesList(state, payload){
            return state.all_categories = payload
        },
        getAllCategory(state, payload){
            return state.get_all_categories = payload
        }
    }
}
