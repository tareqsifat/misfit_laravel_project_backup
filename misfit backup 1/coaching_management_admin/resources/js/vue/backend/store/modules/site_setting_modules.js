import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('site_setting','settings','Setting');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    site_logo: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_site_logo: (state) => state.site_logo
};

// actions
const actions = {
    ...test_module.actions(),
    [`fetch_site_logo`]: async function ({ state, commit }) {
        let url = `/${api_prefix}/get_site_logo`;
        await axios.get(url).then((res) => {
            this.commit(`set_site_logo`, res.data);

            var image = `
                <img src="/${res.data.value}"/>
            `;
                
            setTimeout(() => {
                var file_previews = document.querySelector('.file_preview');
                file_previews.innerHTML = image || ''
            }, 500);

        });
    },

    update_site_logo: async function(state) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.logo_update`);
        // console.log(form_values, form_inputs.qty);
        axios.post(`/${api_prefix}/update_logo`, form_data).then((res) => {
        
            window.s_alert("Logo updated successfully");
        });
    }
}

// mutators
const mutations = {
    ...test_module.mutations(),
    set_site_logo: function (state, data) {
        state.site_logo = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
