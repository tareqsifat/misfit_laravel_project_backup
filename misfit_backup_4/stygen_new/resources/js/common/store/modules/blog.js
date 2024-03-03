export const blog = {
    namespaced: true,
    state:{
        blogs: [],
        blog: [],
        all_blogs: [],
        singleBlog: []
    },
    getters:{
        blogList(state){
            return state.blogs;
        },
        editBlog(state){
            return state.blog;
        },
        getAllBlog(state){
            return state.all_blogs;
        },
        getSingleBlog(state){
            return state.singleBlog;
        }
    },
    actions:{
        blogList(context, payload){
            axios.get('/admin/blog/?page='+payload)
                .then((result) => {
                    context.commit('blogList', result.data.blogs)
                }).catch((error) => {

            });
        },
        editBlog(context, payload){
            axios.get(`/admin/blog/${payload}/edit`)
                .then((result) => {
                    context.commit('editBlog', result.data.blog)
                }).catch((error) => {

            });
        },
        blogDelete(context, payload){
            axios.delete('/admin/blog/'+payload)
                .then((result) => {
                    context.commit('blogList', result.data.blogs)
                }).catch((error) => {

            });
        },
        getAllBlog(context, payload){
            axios.get('/get-all-blog/?page='+payload)
                .then((result) => {
                    context.commit('getAllBlog', result.data.all_blogs)
                }).catch((error) => {

            });
        },
        getSingleBlog(context, payload){
            axios.get('/single-blog/'+payload)
                .then((result) => {
                    context.commit('getSingleBlog', result.data.blog)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        blogList(state, payload){
            return state.blogs = payload
        },
        editBlog(state, payload){
            return state.blog = payload
        },
        getAllBlog(state, payload){
            return state.all_blogs = payload
        },
        getSingleBlog(state, payload){
            return state.singleBlog = payload
        }
    }
}
