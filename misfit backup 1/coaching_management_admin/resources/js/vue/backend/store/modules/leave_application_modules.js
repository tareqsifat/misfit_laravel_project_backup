import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('leave_application','leave-application','LeaveApplication');
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

            commit(`set_selected_employees`, res.data.user);
        });
    },

    [`store_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.leave_creation_form`);
        // console.log(form_data, form_inputs, form_values);
        const {get_employee_selected: user_id} = getters;

        form_data.append('user_id',user_id[0].id);

        console.log(form_values);
        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert(`new ${store_prefix} has been created`);
                $(`${store_prefix}_creation_form input`).val('');
                commit(`set_clear_selected_employees`,false);
                management_router.push({name:`AllBranch${route_prefix}`})
            })
            .catch(error=>{
                console.log(error);
            })
    },

    [`update_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.edit_leave_form`);
        const {get_employee_selected: user_id} = getters;

        form_data.append('user_id',user_id[0].id);
        // form_data.append('subject_id',subject[0].id);
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
