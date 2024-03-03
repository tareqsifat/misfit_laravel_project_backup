import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('branch','branch','Branch');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
};

// get state
const getters = {
    ...test_module.getters(),
};

// actions
const actions = {
    ...test_module.actions(),

    /** override store */
    [`store_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data('.branch_create_form');
        // const {get_user_role_selected: role} = getters;
        // role.forEach(i=>form_data.append('user_role_id[]',i.role_serial));

        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert('new branch has been created');
                $('.branch_create_form input').val('');
                // commit('set_clear_selected_user_roles',false);
                management_router.push({name:`All${route_prefix}`})
            })
            .catch(error=>{

            })
    },

    [`create_${store_prefix}_admin`]: function({state, getters, commit}, branch_id){
        const {form_values, form_inputs, form_data} = window.get_form_data('.create_branch_admin');
        // const {get_user_role_selected: role} = getters;
        // role.forEach(i=>form_data.append('user_role_id[]',i.role_serial));

        form_data.append('branch_id', branch_id);
        axios.post(`/${api_prefix}/create-branch-admin`,form_data)
            .then(res=>{
                window.s_alert('new branch admin has been created');
                $('.create_branch_admin input').val('');
                // commit('set_clear_selected_user_roles',false);
                management_router.push({name:`All${route_prefix}`})
            })
            .catch(error=>{

            })
    },

    /** override update */
    [`update_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data('.branch_edit_form');
        // const {get_user_role_selected: role, get_user: user} = getters;
        // role.forEach(i=>form_data.append('user_role_id[]',i.role_serial));
        form_data.append('id',user.id);

        axios.post('/user/update',form_data)
            .then(({data})=>{
                // commit('set_user',data.result);
                window.s_alert('branch has been updated');
            })
    },
}

// mutators
const mutations = {
    ...test_module.mutations(),

};

export default {
    state,
    getters,
    actions,
    mutations,
};
