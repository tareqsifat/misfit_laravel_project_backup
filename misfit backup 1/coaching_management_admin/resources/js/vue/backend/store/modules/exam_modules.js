import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('exam','institute/class_batch_exam','Exam');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    exam_students: {},
    student_exam_result: {},
    single_student_result: {},
    exam_of_teacher: {},
    start_page: 1,
    paginate: 10
};

// get state
const getters = {
    ...test_module.getters(),
    get_exam_students: (state) => state.exam_students,
    get_student_exam_result: (state) => state.student_exam_result,
    get_single_student_result: (state) => state.single_student_result,
    get_exam_of_teacher: (state) => state.exam_of_teacher
};

// actions
const actions = {
    ...test_module.actions(),

    fetch_exam_students: async function (state, id) {
        let url = `/${api_prefix}_mark/exam-students/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_exam_students', res.data);
            // console.log(res.data.batch.institute_students);
        })
    },

    fetch_exam_of_teacher: async function(state) {
        let paginate = 15; 
        let url = `/${api_prefix}/exam_of_teacher?page=1&paginate=${paginate}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_exam_of_teacher', res.data);
            // console.log(res.data.batch.institute_students);
        })
    },
    
    export_exam_student_all: async function ({state}) {
        
        var export_csv = new window.CsvBuilder(`exam_student_list.csv`).setColumns(['exam_id', 'user_id', 'batch_id','name', 'mark']);
        window.start_loader();
        
            var result_array = [];
            var exam_id = state.exam_students.id
            state.exam_students.batch.institute_students.forEach(element => {
                
                let student_name = element.user.first_name + ' ' +element.user.last_name;
                result_array.push([exam_id, element.user.id, element.pivot.institute_class_batch_id, student_name, element.user.mark]);
            });
            console.log(result_array);
            export_csv.addRows(result_array);

        await export_csv.exportFile();
        window.remove_loader();
    },

    fetch_single_student_results: async function(state) {
        let url = `/${api_prefix}_mark/student-exam-result`
        await axios.get(url)
        .then((res) => {
            this.commit('set_student_exam_result', res.data);
            // console.log(res.data.batch.institute_students);
        })
    },

    fetch_single_student_results_by_id: async function({ state, commit }, { id }) {
        let url = `/${api_prefix}_mark/single-student-exam-result/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_single_student_exam_result', res.data);
            // console.log(res.data.batch.institute_students);
        })
    },
    
    submit_exam_result: async function(state, data) {
        let url = `/${api_prefix}_mark/exam-result-submit`
        await axios.post(url, data)
        .then((res) => {
            window.s_alert(`Result submitted successfully`);
        })
    },
    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            commit(`set_selected_batchs`, res.data.batch);
        });
    },

    [`store_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.exam_create_form`);
        // console.log(form_data, form_inputs, form_values);
        const {get_batch_selected: batch, get_subject_selected: subject} = getters;

        form_data.append('institute_class_batch_id',batch[0].id);
        // form_data.append('subject_id',subject[0].id);

        console.log(form_values);
        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert(`new ${store_prefix} has been created`);
                $(`${store_prefix}_create_form input`).val('');
                commit(`set_clear_selected_subjects`,false);
                commit(`set_clear_selected_class_batchs`,false);
                management_router.push({name:`AllBranch${route_prefix}`})
            })
            .catch(error=>{
                console.log(error);
            })

        
    },

    [`update_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.call_history_edit_form`);
        const {get_batch_selected: batch, get_subject_selected: subject} = getters;

        form_data.append('institute_class_batch_id',batch[0].id);
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
    set_exam_students: function(state, data) {
        state.exam_students = data;
    },
    set_student_exam_result: function(state, data) {
        state.student_exam_result = data;
    },
    set_single_student_exam_result: function(state, data) {
        state.single_student_result = data;
    },
    set_exam_of_teacher: function(state, data) {
        state.exam_of_teacher = data;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};
