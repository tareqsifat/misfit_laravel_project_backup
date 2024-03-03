import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('account_category','institute/branch-account/category','AccountCategory');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    all_account_categories: {}
};

// get state
const getters = {
    ...test_module.getters(),
    // 'get_all_categories'
    get_all_account_categories: (state) => state.all_account_categories
};

// actions
const actions = {
    ...test_module.actions(),

    category_visibility_update: async function(state, data) {
        let url = `/${api_prefix}/visibility_update`
        await axios.post(url, data)
        .then((res) => {
            window.s_alert(
                `Category visibility updated!`
            );
        })
    },

    fetch_all_account_categories: async function() {
        let url = `/${api_prefix}/get_all_categories`
        await axios.get(url)
        .then((res) => {
            this.commit(`set_all_account_categories`, res.data);
            
        })
    },

    [`delete_${store_prefix}`]: async function (
        { state, getters, dispatch },
        id
    ) {
        let cconfirm = await window.s_confirm("Delete");
        if (cconfirm) {
            axios
                .post(`/${api_prefix}/destroy`, { id })
                .then(({ data }) => {
                    dispatch(`fetch_${store_prefix}s`);
                    window.s_alert(
                        `${store_prefix} has been deleted`
                    );
                })
                .catch((e) => {
                    if(e.response.status == 400) {
                        window.s_alert('error '+e.response.status+': '+e.response.data.error,'error')
                    }
                });
        }
    },
}

// mutators
const mutations = {
    ...test_module.mutations(),
    set_all_account_categories: function(state, data) {
        state.all_account_categories = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
