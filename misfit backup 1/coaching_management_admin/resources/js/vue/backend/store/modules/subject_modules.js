import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('subject','institute/class_subject','Subject');
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

    [`store_${store_prefix}`]: function({state, getters, commit}, event){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.add_subject_form`);
        let subjects = JSON.stringify(event.subjects);
        let batch_id = event.batch_id;
        form_data.append('batch_id',batch_id);
        form_data.append('subjects',subjects);
        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert(`${store_prefix}s has been updated`);
                $(`add_subject_form input`).val('');
                // management_router.push({name:`AllBranch${route_prefix}`})
            })
            .catch(error=>{
                console.log(error);
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
