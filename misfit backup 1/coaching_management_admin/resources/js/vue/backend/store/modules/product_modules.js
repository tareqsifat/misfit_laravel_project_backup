import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('product','product','Product');
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
    
    [`order_${store_prefix}`]: function ({ state, getters, commit }, event) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.order_form_single`);
        // console.log(form_values, form_inputs.qty);
        let qty = parseInt(form_inputs.qty, 10);
        let total_price = state[store_prefix].price * qty

        // console.log(total_price, state[store_prefix].price, qty);
        form_data.append("product_id", state[store_prefix].id);
        form_data.append("price", state[store_prefix].price);
        form_data.append("total_price", total_price);

        axios.post(`/${api_prefix}/order/store`, form_data).then((res) => {
            console.log("login store data", state[store_prefix].id);
            let product_id = state[store_prefix].id;
            this.dispatch(`fetch_${store_prefix}`, { id: product_id });
            window.s_alert("Order placed successfully");
        });
    },

    [`update_stock_${store_prefix}`]: function ({ state, getters, commit }, product_id) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.stock_update_form`);
        // console.log(product_id);
        // let qty = parseInt(form_inputs.qty, 10);
        // let total_price = state[store_prefix].price * qty

        // // console.log(total_price, state[store_prefix].price, qty);
        form_data.append("product_id", product_id);

        axios.post(`/${api_prefix}/stock-update`, form_data).then((res) => {
            $(`.stock_update_form`).val('');
            window.s_alert(res.data.message);
            management_router.push({name:`All${route_prefix}`})
        });
    },



    order_branch_product: async function(state, data) {
        
        
        await axios.post(`/${api_prefix}/order/store`, data).then((res) => {
            
            window.s_alert("Order placed successfully");
        });
    }

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
