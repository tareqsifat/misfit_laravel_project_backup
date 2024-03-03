import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('subscriber','subscriber','Subscriber');
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
    send_mail: async function (event) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.mail_form`);
        window.s_alert(
            `Mail has been sent to Subscribers!`
        );
        // axios.post(`/${api_prefix}/send_mail`, form_data).then((res) => {
        //     event.reset();
        //     if (res.data) {
        //         window.s_alert(
        //             `Mail has been sent to Subscribers!`
        //         );
        //     }
        // })
        // .catch((e) => {
        //     if(e.response.status == 400) {
        //         window.s_alert('error '+e.response.status+': '+e.response.data.error,'error')
        //     }
        // });
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

};

export default {
    state,
    getters,
    actions,
    mutations,
};
