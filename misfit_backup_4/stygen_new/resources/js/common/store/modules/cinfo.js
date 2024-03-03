export const cinfo = {
    namespaced: true,
    state:{
        company_infos: [],
        company_info: [],
        landing_company_info: [],
    },
    getters:{
        companyInfoList(state){
            return state.company_infos;
        },
        editCompanyInfo(state){
            return state.company_info;
        },
        getLandingCompanyInfo(state){
            return state.landing_company_info;
        },
    },
    actions:{
        companyInfoList(context, payload){
            axios.get('/admin/company-info/?page='+payload)
                .then((result) => {
                    context.commit('companyInfoList', result.data.company_infos)
                }).catch((error) => {

            });
        },
        editCompanyInfo(context, payload){
            axios.get(`/admin/company-info/${payload}/edit`)
                .then((result) => {
                    context.commit('editCompanyInfo', result.data.company_info)
                }).catch((error) => {

            });
        },
        companyInfoDelete(context, payload){
            axios.delete('/admin/company-info/'+payload)
                .then((result) => {
                    context.commit('companyInfoList', result.data.company_infos)
                }).catch((error) => {

            });
        },
        getLandingCompanyInfo(context){
            axios.get('/landing-company-info')
                .then((result) => {
                    context.commit('getLandingCompanyInfo', result.data.company_info)
                }).catch((error) => {

            });
        }
    },
    mutations:{
        companyInfoList(state, payload){
            return state.company_infos = payload
        },
        editCompanyInfo(state, payload){
            return state.company_info = payload
        },
        getLandingCompanyInfo(state, payload){
            return state.landing_company_info = payload
        }
    }
}
