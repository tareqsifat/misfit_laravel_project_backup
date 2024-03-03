import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('account','institute/branch-accounts','Account');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    all_accounts: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_all_accounts: state => state.all_accounts,
};

// actions
const actions = {
    ...test_module.actions(),
    
    fetch_all_accounts: async function() {
        let url = `/${api_prefix}/all_accounts`
        await axios.get(url)
        .then((res) => {
            this.commit(`set_all_accounts`, res.data);
        })
    },

    // [`fetch_admin_${store_prefix}s`]: async function ({ state }) {
    //     console.log('here');
    //     let url = `/${api_prefix}/admin_accounts?page=${state[`${store_prefix}_page`]}&status=${state[`${store_prefix}_show_active_data`]}&paginate=${state[`${store_prefix}_paginate`]}`;
    //     url += `&orderBy=${state.orderByCol}`;
    //     if (state.orderByAsc) {
    //         url += `&orderByType=ASC`;
    //     } else {
    //         url += `&orderByType=DESC`;
    //     }
    //     if (state[`${store_prefix}_search_key`]) {
    //         url += `&search_key=${state[`${store_prefix}_search_key`]}`;
    //     }
    //     await axios.get(url).then((res) => {
    //         this.commit(`set_admin_${store_prefix}s`, res.data);
    //     });
    // },

    account_balance_transfer: async function(state, data) {
        let url = `/${api_prefix}/transfer-balance`
        await axios.post(url, data)
        .then((res) => {
            console.log(res);
            if(res.data?.condition == 'failed') {
                window.s_alert(res.data.message, 'warning');
            }else {
                window.s_alert(
                    `Balance transfered successfully`
                );
            }
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
    set_all_accounts: function (state, data) {
        state.all_accounts = data;
        // console.log(state.class_subjects);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
