import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('notification','notification','Notification');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    all_users: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_all_users: state => state.all_users
};

// actions
const actions = {
    ...test_module.actions(),
    submit_batch_notification: async function({ state, getters, dispatch }) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.batch_notification_create`);
        // console.log(form_data, form_inputs, form_values);

        axios.post(`/${api_prefix}/batch_notification`,form_data)
            .then(res=>{
                window.s_alert(`new ${store_prefix} has been created`);
                $(`batch_notification_create`).val('');
                
                management_router.push({name:`AllBranch${route_prefix}`})
            })
            .catch(error=>{
                console.log(error);
            })
    },
    fetch_all_users: async function (params) {
        axios.get(`/${api_prefix}/all_users`)
            .then((res) => {
                this.commit('set_all_users', res.data);
            })
            .catch((e) => {
                console.log(e);
            });
    },
    update_user_notification_status: async function () {
        axios.get(`/${api_prefix}/update_user_notification_status`)
            .then((res) => {
                console.log(res.data);
            })
            .catch((e) => {
                console.log(e);
            });
    },
    update_single_notification: async function({ state, getters, dispatch },id) {
        console.log(id);
        axios.post(`/${api_prefix}/update_notification_unread`, {id})
            .then((res) => {
                window.s_alert(
                    `Notification status changed to unseen`
                );
            })
            .catch((e) => {
                console.log(e);
            });
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
                    dispatch(`fetch_check_auth`);
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
    set_all_users: function (state, data) {
        state.all_users = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
