import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('admin_schedule','institute/admin-class-batch-time','Schedule');
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

    [`fetch_${store_prefix}s`]: async function ({ state }, data) {
        console.log(data);
        let url = `/${api_prefix}/all?page=${state[`${store_prefix}_page`]}&status=${state[`${store_prefix}_show_active_data`]}&paginate=${state[`${store_prefix}_paginate`]}`;

        if(data && data.branch_id != '') {
            url = `/${api_prefix}/all?page=${state[`${store_prefix}_page`]}&status=${state[`${store_prefix}_show_active_data`]}&paginate=${state[`${store_prefix}_paginate`]}&branch_id=${data.branch_id}`;
        }
        url += `&orderBy=${state.orderByCol}`;
        if (state.orderByAsc) {
            url += `&orderByType=ASC`;
        } else {
            url += `&orderByType=DESC`;
        }
        if (state[`${store_prefix}_search_key`]) {
            url += `&search_key=${state[`${store_prefix}_search_key`]}`;
        }
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}s`, res.data);
        });
    },

    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            commit(`set_selected_class_levels`, res.data.class);
            commit(`set_selected_batchs`, res.data.batch);
            commit(`set_selected_subjects`, res.data.subject);
            if(res.data.teacher) {
                commit(`set_selected_teachers`, res.data.teacher);
            }
        });
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
