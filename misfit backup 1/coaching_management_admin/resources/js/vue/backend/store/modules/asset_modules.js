import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('asset','branch/assets','Asset');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    all_branches: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_all_branches: state => state.all_branches
};

// actions
const actions = {
    ...test_module.actions(),

    /** override store */
    fetch_all_branches: async function(state) {
        axios.get(`/${api_prefix}/get_all_branches`)
            .then((res) => {
                this.commit('set_all_branches', res.data);
            })
            .catch((e) => {
                console.log(e);
            });
    },

    [`fetch_${store_prefix}s`]: async function ({ state }, data) {
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

    
}

// mutators
const mutations = {
    ...test_module.mutations(),
    set_all_branches: function (state, data) {
        state.all_branches = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
