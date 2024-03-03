import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('part_66', 'part-66-module-registration', 'Part66Module');
const { store_prefix, api_prefix, route_prefix } = test_module;

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
    [`store_${store_prefix}`]: function ({ state, getters, commit }) {
        const { form_values, form_inputs, form_data } = window.get_form_data('.user_create_form');
        const { get_user_role_selected: role } = getters;
        role.forEach(i => form_data.append('user_role_id[]', i.role_serial));

        axios.post(`/${api_prefix}/store`, form_data)
            .then(res => {
                window.s_alert('new user has been created');
                $('.user_create_form input').val('');
                commit('set_clear_selected_user_roles', false);
                management_router.push({ name: `All${route_prefix}` })
            })
            .catch(error => {

            })
    },

    /** override update */
    [`update_${store_prefix}`]: function ({ state, getters, commit }) {
        const { form_values, form_inputs, form_data } = window.get_form_data('.user_edit_form');
        const { get_user_role_selected: role, get_user: user } = getters;
        role.forEach(i => form_data.append('user_role_id[]', i.role_serial));
        form_data.append('id', user.id);

        axios.post('/user/update', form_data)
            .then(({ data }) => {
                commit('set_user', data.result);
                window.s_alert('user has been updated');
            })
    },

    [`approve_${store_prefix}`]: function ({ state, getters, commit }, { status }) {
        window.s_confirm(status)
            .then(res => {
                if (res) {
                    axios.post(`/${api_prefix}/approve`, {id: state[store_prefix].id, status})
                        .then(({ data }) => {
                            state[store_prefix].application_status = status;
                            window.s_alert('data '+ status);
                        })
                }
            });
        // const { get_user_role_selected: role, get_user: user } = getters;
        // role.forEach(i => form_data.append('user_role_id[]', i.role_serial));
        // form_data.append('id', user.id);


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
