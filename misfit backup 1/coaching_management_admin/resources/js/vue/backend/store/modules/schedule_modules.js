import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('schedule','institute/class_batch_time','Schedule');
const {store_prefix, api_prefix, route_prefix} = test_module;


// state list
const state = {
    ...test_module.states(),
    student_routines: {},
    teacher_routines: {},
    teacher_routine_by_id: {},
    all_routines: {},
    all_routines_by_date: {},
    all_branches: []
};

// get state
const getters = {
    ...test_module.getters(),
    get_student_routines: state => state.student_routines,
    get_teacher_routines: state => state.teacher_routines,
    get_all_routines: state => state.all_routines,
    get_all_routines_by_date: state => state.all_routines_by_date,
    get_all_branches: state => state.all_branches,
    get_teacher_routine_by_id: state => state.teacher_routine_by_id
};

// actions
const actions = {
    ...test_module.actions(),

    fetch_all_routines: async function(state) {
        let url = `/${api_prefix}/all_routines`;
        await axios.get(url).then((res) => {
            this.commit(`set_all_routines`, res.data);
        });
    },

    fetch_routines_by_batch: async function(state, data) {
        let url = `/${api_prefix}/branch_wise_routine`;
        await axios.post(url, data).then((res) => {
            this.commit(`set_all_routines`, res.data);
        });
    },

    filter_routines_by_date: async function(state, data) {
        let url = `/${api_prefix}/filter_routines_by_date`;
        await axios.post(url, data).then((res) => {
            this.commit(`set_all_routines_by_date`, res.data);
        });
    },

    fetch_all_branches: async function(state) {
        let url = `/${api_prefix}/all_branches`;
        await axios.get(url).then((res) => {
            this.commit(`set_all_branches`, res.data);
        });
    },

    fetch_student_routines: async function(state) {
        let url = `/${api_prefix}/student_wise_batch_time`;
        await axios.get(url).then((res) => {
            this.commit(`set_student_routines`, res.data);
        });
    },

    fetch_teacher_routines: async function(state) {
        let url = `/${api_prefix}/teacher_wise_batch_time`;
        await axios.get(url).then((res) => {
            this.commit(`set_teacher_routines`, res.data);
        });
    },

    fetch_teacher_routine_by_id: async function({ state, commit }, { id }) {
        let url = `/${api_prefix}/teacher_wise_batch_time_by_id/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_teacher_routine_by_id`, res.data);
        });
    },

    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            commit(`set_selected_class_levels`, res.data.class);
            commit(`set_selected_batchs`, res.data.batch);
            commit(`set_selected_subjects`, res.data.subject);
            if(res.data.teacher) {
                commit(`set_selected_teachers`, res.data.teacher);
            }
        });
    },

    /** override store */
    [`store_${store_prefix}`]: function({state, getters, commit}, event){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.schedule_create_form`);
        // console.log(form_data, form_inputs, form_values);
        const {
                get_class_level_selected: classlevel,
                get_teacher_selected: teacher
            } = getters;

        // event.subjects.find((item) => iitem.start_time);
        // let filtered_subjects = event.subjects.forEach(element => {
        //     console.log(element);
        //     event.subjects.find(({ item }) => item.start_time == element.start_time && item.end_time == element.end_time && item.room_no == element.room_no);
        // });

        // let new_filtered_subjects = event.subjects.filter(function (v, i, self) {
        //     return i == self.indexOf(v);
        // });

        function checkForDuplicates(data) {
            const firstElement = data[0];
        
            for (let i = 1; i < data.length; i++) {
                const currentElement = data[i];
        
                if (
                    currentElement.start_time === firstElement.start_time &&
                    currentElement.end_time === firstElement.end_time &&
                    currentElement.room_no === firstElement.room_no &&
                    arraysEqual(currentElement.days, firstElement.days)
                ) {
                    return true;
                }
            }
        
            return false;
        }
        
        function arraysEqual(arr1, arr2) {
            if (arr1.length !== arr2.length) {
                return false;
            }
        
            for (let i = 0; i < arr1.length; i++) {
                if (arr1[i] !== arr2[i]) {
                    return false;
                }
            }
        
            return true;
        }
        
        if (checkForDuplicates(event.subjects)) {
            console.log("Warning: Same values found across elements.");
            window.s_alert("Warning: start time, end time and room no. cannot be same", `warning`);
        } else {
            let subjects = JSON.stringify(event.subjects);
        
            form_data.append('institute_class_id',classlevel[0].id);
            form_data.append('institute_class_teacher_id',teacher[0].id);
            form_data.append('subjects',subjects);
            
            axios.post(`/${api_prefix}/store`,form_data)
                .then(res=>{
                    // console.log(res.data);
                    if(res.data.type == 'warning') {
                        window.s_alert(res.data.message, `warning`);
                    }else {
                        window.s_alert(`new ${store_prefix} has been created`);
                        $(`${store_prefix}_create_form input`).val('');
                        commit(`set_clear_selected_class_levels`,false);
                        management_router.push({name:`AllBranch${route_prefix}`})
                    }
                })
                .catch(error=>{
                    console.log(error);
                })
        }
    },

    

    /** override update */
    [`update_${store_prefix}`]: function({state, getters, commit}, event){
        const {form_values, form_inputs, form_data} = window.get_form_data('.schedule_edit_form');
        const {
            get_class_level_selected: classlevel, 
            get_teacher_selected: teacher,
            get_subject_selected: subject,
            get_batch_selected: batch,
        } = getters;

        // role.forEach(i=>form_data.append('user_role_id[]',i.role_serial));
        form_data.append("id", state[store_prefix].id);
        form_data.append('institute_class_id',classlevel[0].id);
        form_data.append('institute_class_teacher_id',teacher[0].id);
        form_data.append('institute_class_subject_id',subject[0].id);
        form_data.append('institute_class_batch_id',batch[0].id);
        // form_data.append('subjects',subjects);

        axios.post(`/${api_prefix}/update`,form_data)
            .then(({data})=>{
                commit('set_schedule',data);
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
    set_student_routines: function (state, data) {
        state.student_routines = data;
    },
    set_teacher_routines: function (state, data) {
        state.teacher_routines = data;
    },
    set_teacher_routine_by_id: function (state, data) {
        state.teacher_routine_by_id = data;
    },
    set_all_routines: function (state, data) {
        state.all_routines = data;
    },
    set_all_branches: function (state, data) {
        state.all_branches = data;
    },
    set_all_routines_by_date: function(state, data) {
        state.all_routines_by_date = data;
    }

};

export default {
    state,
    getters,
    actions,
    mutations,
};
