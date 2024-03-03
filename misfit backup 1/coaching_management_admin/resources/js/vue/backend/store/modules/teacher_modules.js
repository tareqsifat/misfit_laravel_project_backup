import axios from "axios";
import management_router from "../../router/router";
import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('teacher','institute/teacher','Teacher');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    single_teacher_attendence_by_id: {},
};

// get state
const getters = {
    ...test_module.getters(),
    get_single_teacher_attendence_by_id: state => state.single_teacher_attendence_by_id,
};

// actions
const actions = {
    ...test_module.actions(),

    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            var image = `
                <img src="/${res.data.teacher.user.photo}"/>
            `;
                
            setTimeout(() => {
                var file_previews = document.querySelector('.file_preview');
                file_previews.innerHTML = image || ''
            }, 1000);

        });
    },

    [`update_${store_prefix}`]: function ({ state }, event) {
        let form_data = new FormData(event);
        // console.log(state[store_prefix]);
        form_data.append("id", state[store_prefix].teacher.id);
        axios.post(`/${api_prefix}/update`, form_data).then((res) => {
            /** reset loaded user_role after data update */
            // this.commit(`set_${store_prefix}`, null);
            window.s_alert("data updated");
        });
    },


    fetch_single_teacher_attendence_by_id: async function({ state, commit }, { id }) {
        let url = `/${api_prefix}/single-teacher-attendence/${id}`
        await axios.get(url)
        .then((res) => {
            this.commit('set_single_teacher_attendence_by_id', res.data);
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
    set_single_teacher_attendence_by_id: function(state, data) {
        state.single_teacher_attendence_by_id = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
