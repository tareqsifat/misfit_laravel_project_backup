<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Create</h4>
                <div class="btns">
                    <router-link :to="{ name: `All${route_prefix}` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" class="monthly_fee_form" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <label for="institute_student_id">Select Student</label>
                                    <select class="form-select" @change="get_student_ids($event)" name="institute_student_id" id="institute_student_id">
                                        <option value="">Select a user</option>
                                        <option v-for="item in get_all_students" :data-selected_id="item.user.id" :key="item.id" :value="item.id">{{ item.user.first_name }} {{ item.user.last_name }}</option>
                                    </select>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <input-field
                                        :label="`Amount`"
                                        :name="`amount`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <label for="">Date</label>
                                    <input class="form-control" type="month" name="date" id="date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-outline-info" >
                        <i class="fa fa-upload"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import InputField from '../../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
            student_id: '',
            user_id: '',
        }
    },
    created: function () {
        this.fetch_all_students()
    },
    methods: {
        get_student_ids: function(event) {
            this.student_id = event.target.value;
            this.user_id = event.target.selectedOptions[0].dataset.selected_id;
        },
        ...mapActions([
            `store_${store_prefix}`,
            'fetch_all_students'
        ]),
        call_store: function(name, params=null){
            let student_ids = {
                student_id: this.student_id,
                user_id: this.user_id
            }
            params = student_ids
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_all_students`,
        ]),
    }
};
</script>

<style>
</style>
