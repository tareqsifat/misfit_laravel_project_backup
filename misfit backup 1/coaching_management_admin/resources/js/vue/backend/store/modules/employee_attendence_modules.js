import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('employee_attendence','attendence/employee','Employee-attendence');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    single_teacher_attendence: {},
    teacher_monthly_attendence: {},
};

// get state
const getters = {
    ...test_module.getters(),
    get_employee_attendences: state => state.employee_attendences,
    get_single_teacher_attendence: state => state.single_teacher_attendence
};

// actions
const actions = {
    ...test_module.actions(),

    // class_wise_batch: async function (state, event) {
    //     // console.log(event.target.value);
    //     let class_id = event.target.value;
    //     let url = `/${api_prefix}/class-wise-batch`
    //     await axios.post(url, {class_id: class_id})
    //     .then((res) => {
    //         this.commit('set_class_wise_batches', res.data.batch);
    //     })
    // },

    // batch_wise_students: async function(state, event) {
    //     // console.log(event.target.value);
    //     let batch_id = event?.target?.value;
    //     let url = `/${api_prefix}/batch-wise-students`
    //     await axios.post(url, {batch_id: batch_id})
    //     .then((res) => {
    //         this.commit('set_batch_wise_students', res.data);
    //     })
    // },

    [`fetch_${store_prefix}s`]: async function ({state}, date) {
        
        let url = `/${api_prefix}/all?page=${state[`${store_prefix}_page`]}&attendence_date=${date}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}s`, res.data);
        });
    },

    all_employee_attendence: async function(state) {
        let url = `/${api_prefix}/all_attendence`
        await axios.get(url)
        .then((res) => {
            this.commit('set_employee_attendence', res.data);
        })
    },

    employee_attendence_update: async function(state, data) {
        let url = `/${api_prefix}/employee-attendence-update`
        await axios.post(url, data)
        .then((res) => {
            window.s_alert(
                `Attendence updated!`
            );
        })
    },

    fetch_single_teacher_attendence: async function(state) {
        // let class_id = event.target.value;
        let url = `/${api_prefix}/single_teacher_attendence`
        await axios.get(url)
        .then((res) => {
            this.commit('set_single_teacher_attendence', res.data);
        })
    },

    fetch_teacher_monthly_attendence: async function(state, date) {
        // let class_id = event.target.value;
        let url = `/${api_prefix}/teacher_monthly_attendence`
        await axios.post(url, date)
        .then((res) => {
            this.commit('set_teacher_monthly_attendence', res.data);
        })
    },

    employee_attendence_submit: async function(state, data) {
        let url = `/${api_prefix}/employee-attendence`
        await axios.post(url, data)
        .then((res) => {
            window.s_alert(
                `Attendence updated!`
            );
        })
    },

    [`delete_${store_prefix}`]: async function (
        { state, getters, dispatch },
        id
    ) {
        let confirm = await window.s_confirm("Delete");
        if (confirm) {
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
    set_employee_attendence: function (state, data) {
        state.employee_attendences = data;
    },
    set_single_teacher_attendence: function(state, data) {
        state.single_teacher_attendence = data;
    },
    set_teacher_monthly_attendence: function(state, data) {
        state.teacher_monthly_attendence = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
