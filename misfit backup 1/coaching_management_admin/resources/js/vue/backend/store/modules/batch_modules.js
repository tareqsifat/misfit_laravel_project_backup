import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('batch','institute/class_batch','Batch');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    batch_subjects: {},
};

// get state
const getters = {
    ...test_module.getters(),
    get_batch_subjects: state => state.batch_subjects,
};

// actions
const actions = {
    ...test_module.actions(),

    fetch_class_batch_subjects: async function(state, id) {
        console.log(id);
        let url = `/${api_prefix}/subjects/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_batch_subjects', res.data);
        })
    },

    setSelectedBatchs: function ({ commit, dispatch }, data) {
        commit(`set_selected_${store_prefix}s`, data);
        dispatch('fetch_class_batch_subjects', data.id);
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
    set_batch_subjects: function (state, data) {
        state.batch_subjects = data;
        // console.log(state.class_subjects);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
