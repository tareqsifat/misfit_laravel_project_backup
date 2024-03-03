export const category = {
    namespaced: true,
    state:{
        categories: [],
        all_categories: [],
        browse_categories: [],
        get_all_categories: [],
        landing_categories: []
    },
    getters:{
        getAllCategories(state){
            return state.categories;
        },
        allCategories(state){
            return state.all_categories;
        },
        browseCategoryList(state){
            return state.browse_categories;
        },
        getAllCategory(state) {
            return state.get_all_categories;
        },
        landingCategory(state) {
            return state.landing_categories;
        }
    },
    actions:{
        categoryList(context, payload){
            axios.get('/seller/category/?page='+payload.page+'&keyword='+payload.keyword)
            .then((result) => {
                context.commit('categoryList', result.data.categories)
            }).catch((error) => {

            });
        },
        categoryDelete(context, payload){
            axios.delete('/seller/category/'+payload)
            .then((result) => {
                context.commit('categoryList', result.data.categories)
            }).catch((error) => {

            });
        },
        categoriesList(context){
            axios.get('/seller/categories-list')
                .then((result) => {
                    context.commit('categoryList', result.data.categories)
                }).catch((error) => {

            });
        },
        allCategoriesList(context){
            axios.get('/seller/categories-list')
                .then((result) => {
                    context.commit('allCategoriesList', result.data.categories)
                }).catch((error) => {

            });
        },
        browseCategoryList(context){
            axios.get('/browse-categories-list')
                .then((result) => {
                    context.commit('browseCategoryList', result.data.categories)
                }).catch((error) => {

            });
        },
        getAllCategory(context) {
            axios.get('/seller/get-all-categories')
                .then((result) => {
                    context.commit('getAllCategory', result.data.get_all_categories)
                }).catch((error) => {

            });
        },
        landingCategory(context) {
            axios.get('/get-landing-categories')
                .then((result) => {
                    context.commit('landingCategory', result.data.landing_categories)
                }).catch((error) => {

            });
        },
        searchCategory(context, payload){
            axios.get('/seller/search-category/?page='+payload.page+'&keyword='+payload.keyword)
                .then((response)=>{
                    context.commit('categoryList', response.data.categories)
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
        browseCategoryList(state, payload){
            return state.browse_categories = payload
        },
        getAllCategory(state, payload){
            return state.get_all_categories = payload
        },
        landingCategory(state, payload){
            return state.landing_categories = payload
        }
    }
}
