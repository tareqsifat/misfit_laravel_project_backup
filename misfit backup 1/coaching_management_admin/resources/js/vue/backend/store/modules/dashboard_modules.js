import axios from "axios";
import management_router from "../../router/router";


// state list
const state = {
    dashboard_stats: {},
    // total_customers: null,
    // total_income: null,
    // total_expense: null,
    // total_orders: null,
    // total_batch: null,
    // total_running_class: null,
    // total_students: null,
    // total_teachers: null
};

// get state
const getters = {
    get_dashboard_stats: state => state.dashboard_stats,
};

// actions
const actions = {
    fetch_dashboard_stats: async function () {
        await axios.get(`/dashboard_stats`).then((res) => {
            // console.log(res);
            this.commit('set_dashboard_stats', res.data);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    fetch_branch_dashboard_stats: async function () {
        await axios.get(`/branch_dashboard_stats`).then((res) => {
            // console.log(res);
            this.commit('set_dashboard_stats', res.data);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    fetch_branch_dashboard_stats_by_month: async function ({state}, event) {
        // console.log(event.target.value);
        let url = `/branch_dashboard_stats_by_month/${event.target.value}`
        await axios.get(url).then((res) => {
            // console.log(res);
            this.commit('set_dashboard_stats', res.data);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    fetch_dashboard_stats_by_month: async function ({state}, event) {
        // console.log(event.target.value);
        let url = `/dashboard_stats_by_month/${event.target.value}`
        await axios.get(url).then((res) => {
            // console.log(res);
            this.commit('set_dashboard_stats', res.data);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    fetch_student_dashboard_stats: async function () {
        await axios.get(`/student_dashboard_stats`).then((res) => {
            // console.log(res);
            this.commit('set_dashboard_stats', res.data);
        })
        .catch((e) => {
            console.log(e);
        });
    },

    fetch_teacher_dashboard_stats: async function () {
        await axios.get(`/teacher_dashboard_stats`).then((res) => {
            // console.log(res);
            this.commit('set_dashboard_stats', res.data);
        })
        .catch((e) => {
            console.log(e);
        });
    }
    
}

// mutators
const mutations = {
    set_dashboard_stats: function (state, data) {
        state.dashboard_stats = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
