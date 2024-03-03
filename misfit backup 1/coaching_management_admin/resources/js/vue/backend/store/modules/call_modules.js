import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('call','customer/call_history','Call');
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

    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            commit(`set_selected_topics`, res.data.topic);
            commit(`set_selected_customers`, res.data.customer);
        });
    },

    [`store_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.call_history_create_form`);
        // console.log(form_data, form_inputs, form_values);
        const {get_customer_selected: customer, get_topic_selected: topic} = getters;

        form_data.append('topic_id',topic[0].id);
        form_data.append('customer_id',customer[0].id);

        
        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert(`new ${store_prefix} has been created`);
                $(`${store_prefix}_create_form input`).val('');
                commit(`set_clear_selected_topics`,false);
                commit(`set_clear_selected_customers`,false);
                management_router.push({name:`AllBranch${route_prefix}`})
            })
            .catch(error=>{
                console.log(error);
            })

        
    },

    [`update_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.call_history_edit_form`);
        const {get_customer_selected: customer, get_topic_selected: topic} = getters;
        // role.forEach(i=>form_data.append('user_role_id[]',i.role_serial));
        
        form_data.append('topic_id',topic[0].id);
        form_data.append('customer_id',customer[0].id);
        form_data.append("id", state[store_prefix].id);

        axios.post(`/${api_prefix}/update`,form_data)
            .then(({data})=>{
                commit(`set_${store_prefix}`,data);
                window.s_alert(`${store_prefix} has been updated`);
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
};

export default {
    state,
    getters,
    actions,
    mutations,
};
