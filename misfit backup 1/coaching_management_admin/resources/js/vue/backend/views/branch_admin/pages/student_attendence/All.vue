<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <h4>
                    All
                    <small v-if="this[`get_${store_prefix}_selected`].length">
                        &nbsp; selected:
                        <b class="text-warning">
                            {{ this[`get_${store_prefix}_selected`].length }}
                        </b>
                        &nbsp;
                        <b @click="call_store(`set_clear_selected_${store_prefix}s`, true)" class="text-danger cursor-pointer">clear</b>
                        &nbsp;
                        <b @click="call_store(`set_${store_prefix}_show_selected`,true)" class="text-success cursor-pointer">show</b>
                    </small>
                </h4>

                <div class=" form-group d-grid align-content-start gap-1 mb-2" style="padding-right: 50px;">
                    <label for="batch">Select class</label>
                    <select v-model="class_id" @change="class_wise_batch($event)" class="form-select" name="class_id" id="class_id">
                        <option value="">Select class</option>
                        <option v-for="(item, index) in get_class_levels.data" :key="index" :value="item.id">{{ item.title }}</option>
                    </select>
                </div>

                <div class=" form-group d-grid align-content-start gap-1 mb-2" style="padding-right: 50px;">
                    <label for="batch">Select batch</label>
                    <select class="form-select" v-model="batch_id" @change="fetch_batch_subjects($event)" name="batch_id" id="batch">
                        <option v-for="(item, index) in get_class_wise_batches" :key="index" :value="item.id">{{ item.name }}</option>
                    </select>
                </div>

                <div class=" form-group d-grid align-content-start gap-1 mb-2" style="padding-right: 50px;">
                    <label for="subject_id">Select Subject</label>
                    <select class="form-select" v-model="subject_id" name="subject_id" id="subject_id">
                        <option v-for="(item, index) in get_batch_subjects" :key="index" :value="item.id">{{ item.title }}</option>
                    </select>
                </div>

                <div class=" form-group d-grid align-content-start gap-1 mb-2" style="padding-right: 50px;">
                    <label for="batch">Select Date</label>
                    <input @change="call_batch_wise_students($event)" class="form-control" type="date" v-model="attendence_date">
                </div>

                <!-- <div class="search">
                    <form action="#">
                        <input @keyup="call_store(`set_${store_prefix}_search_key`,$event.target.value)" class="form-control border border-info" placeholder="search..." type="search">
                    </form>
                </div> -->
                <div class="btns d-flex gap-2 align-items-center">
                    <!-- <permission-button
                        :permission="'can_create'"
                        :to="{name: `Create${route_prefix}`}"
                        :classList="'btn rounded-pill btn-outline-info'">
                        <i class="fa fa-pencil me-5px"></i>
                        Create
                    </permission-button> -->
                    <div class="table_actions">
                        <a href="#" @click.prevent="()=>''" class="btn px-1 btn-outline-secondary">
                            <i class="fa fa-list"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="" @click.prevent="call_store(`export_${store_prefix}_all`)">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Export All
                                </a>
                            </li>
                            <li v-if="this[`get_${store_prefix}_selected`].length">
                                <a href="" @click.prevent="call_store(`export_selected_${store_prefix}_csv`)">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Export Selected
                                </a>
                            </li>
                            <li>
                                <router-link :to="{name:`Import${route_prefix}`}">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Import
                                </router-link>
                            </li>
                            <li>
                                <a href="#" v-if="this[`get_${store_prefix}_show_active_data`]" title="display data that has been deactivated" @click.prevent="call_store(`set_${store_prefix}_show_active_data`,0)" class="d-flex">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Deactivated data
                                </a>
                                <a href="#" v-else title="display data that are active" @click.prevent="call_store(`set_${store_prefix}_show_active_data`,1)" class="d-flex">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Active data
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive card-body text-nowrap" v-if="get_batch_wise_students.length>0">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="javascript:void(0)" @click="PresentAll()" class="btn btn-sm rounded-pill btn-outline-primary">Present all</a>
                                <!-- <a @click="PresentAll()"  class="btn btn-primary-outline check_all">Present all</a> -->
                            </th>
                            <table-th :sort="true" :tkey="'id'" :title="'ID'" :ariaLable="'id'"/>
                            <table-th :sort="true" :tkey="'name'" :title="'Name'" />
                            <table-th :sort="true" :tkey="'phone'" :title="'phone'" />
                            <table-th :sort="true" :tkey="'created_at'" :title="'Date'" />
                            <th aria-label="actions">Present</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" v-if="get_batch_wise_students">
                        <tr v-for="(item, index) in get_batch_wise_students" :key="index">
                            <td>

                                <input v-if="item.present == 1" checked type="checkbox" class="form-check-input" disabled>
                                <input v-else type="checkbox" class="form-check-input" disabled>
                                <!-- <input type="checkbox" class="form-check-input"> -->
                            </td>
                            <td>{{ index+1 }}</td>
                            
                            <td>
                                <span class="text-warning cursor_pointer" @click.prevent="call_store(`set_${store_prefix}`,item)">
                                    {{ item.first_name }} {{ item.last_name }}
                                </span>
                            </td>

                            <td>
                                <span>
                                    {{ item.mobile_number }}
                                </span>
                            </td>

                            <td>
                                <span v-if="item.date">
                                    {{ new Date(item.date).toDateString()  }},
                                </span>
                            </td>
                    
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" v-if="item.present == 1" checked @change="process_attendence(item.id, $event)" type="checkbox" role="switch" :id="`SwitchPresent${item.id}`">
                                    <input class="form-check-input" v-else @change="process_attendence(item.id, $event)" type="checkbox" role="switch" :id="`SwitchPresent${item.id}`">
                                    <label class="form-check-label" :for="`SwitchPresent${item.id}`">Present</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mb-5" v-else>
                <h5 class="text-center">Select class batch and subject to get started</h5>
            </div>
        </div>

        <details-canvas/>
        <selected-canvas/>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';
import PermissionButton from '../../../components/PermissionButton.vue';
import TableTh from './components/TableTh.vue';
import DetailsCanvas from './DetailsCanvas.vue';
import SelectedCanvas from './SelectedCanvas.vue';

/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { PermissionButton, TableTh, DetailsCanvas, SelectedCanvas },
    data: function(){
        return {
            store_prefix,
            route_prefix,
            class_id: '',
            batch_id: '',
            attendence_date: '',
            subject_id: ''
        }
    },
    created: function(){
        this.fetch_class_levels();
        this.fetch_batchs();
    },
    watch : {
        get_class_wise_batches: function(val) {
            if(val.length>0) {
                this.class_id = val[0].id
            }
        }, 
    },
    methods: {
        ...mapActions([
            `soft_delete_${store_prefix}`,
            `delete_${store_prefix}`,
            `restore_${store_prefix}`,
            `export_${store_prefix}_all`,
            `export_selected_${store_prefix}_csv`,
            `fetch_class_levels`,
            `fetch_batchs`,
            `class_wise_batch`,
            `batch_wise_students`,
            `fetch_batch_subjects`,
            `student_attendence`
        ]),
        PresentAll: function() {
            var users_ids = [];
            this.get_batch_wise_students.forEach(item => {
                users_ids.push(item.id);
            });
            console.log(this.attendence_date);
            if(this.attendence_date == null || this.attendence_date == '') {
                window.s_alert('Attendence date is required', 'error');
            }else {
                let data = {
                    student_id: users_ids,
                    attendence_date: this.attendence_date,
                    class_id: this.class_id,
                    batch_id: this.batch_id,
                    subject_id: this.subject_id,
                    present: 1,
                    multiple: 1
                }
                this.student_attendence(data);

                let batch_data = {
                    batch_id: this.batch_id,
                    class_id: this.class_id,
                    subject_id: this.subject_id,
                    date: this.attendence_date
                }
                this.batch_wise_students(batch_data);
            }
        },
        call_batch_wise_students: function() {
            let data = {
                batch_id: this.batch_id,
                class_id: this.class_id,
                subject_id: this.subject_id,
                date: this.attendence_date
            }

            this.batch_wise_students(data);
        },
        call_batch_subjects: function(event) {
            console.log(event.target.value);
        },
        process_attendence(student_id, event) {
            console.log(this.attendence_date);
            if(this.attendence_date == null || this.attendence_date == '') {
                window.s_alert('Attendence date is required', 'error');
            }else {
                let data = {
                    student_id: student_id,
                    attendence_date: this.attendence_date,
                    class_id: this.class_id,
                    batch_id: this.batch_id,
                    subject_id: this.subject_id,
                    present: event.target.checked,
                    multiple: 0
                }
                this.student_attendence(data);

                let batch_data = {
                    batch_id: this.batch_id,
                    class_id: this.class_id,
                    subject_id: this.subject_id,
                    date: this.attendence_date
                }
                this.batch_wise_students(batch_data);
            }
        },
        call_store: function(name, params=null){
            this[name](params)
        },

        handle_pagination: function(page=1){
            return this[`set_${store_prefix}_page`](page);
        },

        check_if_data_is_selected: function(user){
            let check_index = this[`get_${store_prefix}_selected`].findIndex((i) => i.id == user.id);
            if(check_index >= 0){
                return true;
            }else{
                return false;
            }
        },
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}s`,
            `get_${store_prefix}_selected`,
            `get_${store_prefix}_show_active_data`,
            `get_class_levels`,
            `get_batchs`,
            `get_class_wise_batches`,
            `get_batch_wise_students`,
            'get_batch_subjects'
        ]),
    }
}
</script>

<style>

</style>

