import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('order','product/order','Order');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    all_orders: {},
    order_payments: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_all_orders: state => state.all_orders,
    get_order_payment: state => state.order_payments
};

// actions
const actions = {
    ...test_module.actions(),
    fetch_all_orders: async function ({ state }) {
        let url = `/product/order/all_order?page=${state[`${store_prefix}_page`]}&status=${state[`${store_prefix}_show_active_data`]}&paginate=${state[`${store_prefix}_paginate`]}`;
        await axios.get(url).then((res) => {
            this.commit(`set_all_orders`, res.data);
        });
    },

    fetch_order_payment: async function ({ state }, event) {
        let url = `/${api_prefix}/order_payments/${event}`;
        await axios.get(url).then((res) => {
            this.commit(`set_order_payments`, res.data);
        });
    },
    [`print_${store_prefix}_details`]: function ({ state, getters, commit }, event) {
        window.print();
    },
    [`set_${store_prefix}_status_update`]: function ({ state, getters, commit }, event) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.status_change_form`);

        form_data.append("id", state[store_prefix].id);

        axios.post(`/${api_prefix}/status_update`, form_data).then((res) => {
            console.log("login store data", state[store_prefix].id);
            let order_id = state[store_prefix].id;
            this.dispatch(`fetch_${store_prefix}`, { id: order_id });
            window.s_alert("data updated");
        });
    },
    update_order_admin: async function(state, data) {
        
        // console.log(data);
        await axios.post(`/${api_prefix}/update-order`, data).then((res) => {
            
            window.s_alert("Order updated successfully");
        });
    },
    [`update_${store_prefix}_payment_status`]: function ({ state, getters, commit }, event) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.order_action_form`);

        form_data.append("id", state[store_prefix].id);

        axios.post(`/${api_prefix}/payment_status_update`, form_data).then((res) => {
            // let order_id = state[store_prefix].id;
            // this.dispatch(`fetch_${store_prefix}`, { id: order_id });
            window.s_alert("Payment is updated!");
        });
    },
}

// mutators
const mutations = {
    ...test_module.mutations(),
    set_all_orders: function (state, data) {
        state.all_orders = data;
    },
    set_order_payments: function (state, data) {
        state.order_payments = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
