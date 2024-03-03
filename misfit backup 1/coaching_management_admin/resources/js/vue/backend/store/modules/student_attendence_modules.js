import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('student_attendence','attendence/student','Student-attendence');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    class_wise_batches: {},
    batch_wise_students: {},
    single_student_attendence: {},
    single_student_attendence_by_id: {},
    student_monthly_attendence: {},
    batch_subjects: {}
};

// get state
const getters = {
    ...test_module.getters(),
    get_class_wise_batches: state => state.class_wise_batches,
    get_batch_wise_students: state => state.batch_wise_students,
    get_single_student_attendence: state => state.single_student_attendence,
    get_single_student_attendence_by_id: state => state.single_student_attendence_by_id,
    get_batch_subjects: state => state.batch_subjects,
    get_student_monthly_attendence: state => state.student_monthly_attendence
};

// actions
const actions = {
    ...test_module.actions(),
    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            var image = `
                <img src="/${res.data.user.photo}"/>
            `;
                
            setTimeout(() => {
                var file_previews = document.querySelector('.file_preview');
                file_previews.innerHTML = image || ''
            }, 1000);

        });
    },

    class_wise_batch: async function (state, event) {
        // console.log(event.target.value);
        let class_id = event.target.value;
        let url = `/${api_prefix}/class-wise-batch`
        await axios.post(url, {class_id: class_id})
        .then((res) => {
            this.commit('set_class_wise_batches', res.data.batch);
            let student_reset = {};
            this.commit('set_batch_wise_students', student_reset);
        })
    },

    batch_wise_students: async function(state, event) {
        
        let batch_id = event?.target?.value;
        let url = `/${api_prefix}/batch-wise-students`
        await axios.post(url, event)
        .then((res) => {
            this.commit('set_batch_wise_students', res.data);
        })
    },

    fetch_batch_subjects: async function(state, event) {
        let batch_id = event?.target?.value;
        console.log(batch_id);
        let url = `/${api_prefix}/get_subjects`
        await axios.post(url, {batch_id: batch_id})
        .then((res) => {
            this.commit('set_batch_subjects', res.data);
            let student_reset = {};
            this.commit('set_batch_wise_students', student_reset);
        })
    },

    fetch_single_student_attendence: async function(state) {
        // let class_id = event.target.value;
        let url = `/${api_prefix}/single_student_attendence`
        await axios.get(url)
        .then((res) => {
            this.commit('set_single_student_attendence', res.data);
        })
    },

    fetch_single_student_attendence_by_id: async function({ state, commit }, { id }) {
        let url = `/${api_prefix}/single-student-attendence/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_single_student_attendence_by_id', res.data);
            // console.log(res.data.batch.institute_students);
        })
    },

    fetch_student_monthly_attendence: async function(state, date) {
        // let class_id = event.target.value;
        let url = `/${api_prefix}/student_monthly_attendence`
        await axios.post(url, date)
        .then((res) => {
            this.commit('set_student_monthly_attendence', res.data);
        })
    },

    student_attendence: async function(state, data) {
        
        let url = `/${api_prefix}/student-attendence`
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
    set_class_wise_batches: function (state, data) {
      state.class_wise_batches = data;
    },
    set_batch_wise_students: function (state, data) {
      state.batch_wise_students = data;
    },
    set_single_student_attendence: function(state, data) {
      state.single_student_attendence = data;
    },
    set_single_student_attendence_by_id: function(state, data) {
      state.single_student_attendence_by_id = data;
    },
    set_student_monthly_attendence: function(state, data) {
      state.student_monthly_attendence = data;
    },
    set_batch_subjects: function(state, data) {
      state.batch_subjects = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};