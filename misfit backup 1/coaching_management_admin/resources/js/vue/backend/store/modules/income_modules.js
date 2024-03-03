import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('income','account/income','Income');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    // admin_incomes: {},
    // paginate_income: 10,
    // page_income: 1
};

// get state
const getters = {
    ...test_module.getters(),
    // get_admin_incomes: (state) => state.admin_incomes,
};

// actions
const actions = {
    ...test_module.actions(),
    
    /** fetch all data using data filters */
    // [`fetch_admin_${store_prefix}s`]: async function ({ state }) {
    //     let url = `/${api_prefix}/admin_incomes?page=${state[`page_${store_prefix}`]}&status=${state[`${store_prefix}_show_active_data`]}&paginate=${state[`paginate_${store_prefix}`]}`;
    //     // let url = `/${api_prefix}/admin_incomes?page=${page}&status=${state[`${store_prefix}_show_active_data`]}&paginate=${state[`${store_prefix}_paginate`]}`;
    //     url += `&orderBy=${state.orderByCol}`;
    //     if (state.orderByAsc) {
    //         url += `&orderByType=ASC`;
    //     } else {
    //         url += `&orderByType=DESC`;
    //     }
    //     if (state[`${store_prefix}_search_key`]) {
    //         url += `&search_key=${state[`${store_prefix}_search_key`]}`;
    //     }
    //     await axios.get(url).then((res) => {
    //         this.commit(`set_admin_${store_prefix}s`, res.data);
    //     });
    // },

    /** override store */
    [`store_${store_prefix}`]: function({state, getters, commit}, event){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.income_create_form`);
        // console.log(form_data, form_inputs, form_values);
        const {
                get_account_category_selected: account_category,
            } = getters;

        form_data.append('category',account_category[0].id);

        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert(`new ${store_prefix} has been created`);
                $(`${store_prefix}_create_form input`).val('');
                commit(`set_clear_selected_account_category`,false);
                management_router.push({name:`AllBranch${route_prefix}`})
            })
            .catch(error=>{
                console.log(error);
            })
    },

    fetch_incomes_by_month: async function ({state}, event) {
        // console.log(event.target.value);
        let url = `/filter-income-by-month/${event.target.value}`
        await axios.get(url).then((res) => {
            // console.log(res);
            this.commit(`set_${store_prefix}s`, res.data);
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
    // set_admin_incomes: function(state, data) {
    //     state.admin_incomes = data;
    // },
    // [`set_admin_${store_prefix}_paginate`]: function (state, paginate) {
    //     state[`paginate_income`] = paginate;
    //     this.dispatch(`fetch_admin_${store_prefix}s`);
    // },

    // [`set_admin_${store_prefix}_page`]: function (state, page) {
    //     state[`page_${store_prefix}`] = page;
    //     this.dispatch(`fetch_admin_${store_prefix}s`);
    //     $('table th input[type="checkbox"]').prop("checked", false);
    // }
};

export default {
    state,
    getters,
    actions,
    mutations,
};
