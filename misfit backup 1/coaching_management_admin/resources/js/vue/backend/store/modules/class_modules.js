import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('class_level','institute/class','Class');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    class_subjects: {},
    class_batchs: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_class_subjects: state => state.class_subjects,
    get_class_batchs: state => state.class_batchs

};

// actions
const actions = {
    ...test_module.actions(),

    delete_class_subject: async function(state, id) {
        let url = `/${api_prefix}/delete_subject`
        await axios.post(url, { id })
        .then((res) => {
            window.s_alert(
                `Class has been deleted`
            );
            // this.commit('set_class_subjects', res.data);
        })
    },


    // fetch class batch
    fetch_class_batchs: async function(state, id) {
        let url = `/${api_prefix}/batchs/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_class_batchs', res.data);
        })
    },

    // class management modal selected property is handled by this:
    setSelectedClassLevels: function ({ commit, dispatch }, data) {
        commit(`set_selected_${store_prefix}s`, data);
        dispatch('fetch_class_batchs', data.id);
        // dispatch('fetch_class_subjects', data.id);
    },

    // delete action
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
    
    // dont get confused, its just here to simplify the process, its the same function in schema
    [`set_selected_${store_prefix}s`]: function (state, data) {
        console.log(data);
        let temp_selected = state[`${store_prefix}_selected`];
        let check_index = temp_selected.findIndex((i) => i.id == data.id);
        if (check_index >= 0) {
            let el = document.querySelector(`input[data-id="${data.id}"]`)
            if(el)el.checked = false;
            el = document.querySelector(`input.check_all`)
            if(el)el.checked = false;
            temp_selected.splice(check_index, 1);
        } else {
            temp_selected.push(data);
        }
        state[`${store_prefix}_selected`] = temp_selected;

        if(state[`${store_prefix}_show_management_modal_qty`] == 1 && temp_selected.length){
            state[`${store_prefix}_selected`] = [{...temp_selected[temp_selected.length - 1]}];
            [...document.querySelectorAll(`input[type="checkbox"]`)].forEach(el=>el.checked=false);
            event.target.checked = true;
        }
    },
    set_class_batchs: function (state, data) {
        state.class_batchs = data;
        console.log(state.class_batchs);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
