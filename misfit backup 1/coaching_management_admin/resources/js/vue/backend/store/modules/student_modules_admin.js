import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('admin_student','institute/admin-student','Student');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    class_batchs: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_branch_batches: state => state.branch_batches
};

// actions
const actions = {
    ...test_module.actions(),
    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            var image = `
                <img src="/${res.data.user.photo}"/>
            `;
                
            setTimeout(() => {
                var file_previews = document.querySelector('.file_preview');
                file_previews.innerHTML = image || ''
            }, 1000);

        });
    },
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
    fetch_branch_batches: async function(state, id) {
        let url = `/branch/branch-batches/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_branch_batches', res.data);
        })
    },
    SelectBranchAction: async function({ commit, dispatch }, data) {
        this.commit(`set_selected_${store_prefix}s`, data);
        console.log(data);
        dispatch(`fetch_branch_batches`, data.id);
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
    set_branch_batches: function (state, data) {
        state.branch_batches = data;
        console.log(state.class_batchs);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
