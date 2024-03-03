<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <!-- <h4>
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
                </h4> -->
                <div class=" form-group d-grid align-content-start gap-1 mb-2" style="padding-right: 50px;">
                    <label for="batch">Select Date</label>
                    <input class="form-control" @change="get_attendence_employee" type="date" v-model="attendence_date">
                </div>

                <div class="search">
                    <form action="#">
                        <input @keyup="call_store(`set_${store_prefix}_search_key`,$event.target.value)" class="form-control border border-info" placeholder="search..." type="search">
                    </form>
                </div>
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
            <div class="table-responsive card-body text-nowrap mb-5">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <table-th :sort="true" :tkey="'id'" :title="'ID'" :ariaLable="'id'"/>
                            <table-th :sort="true" :tkey="'name'" :title="'Name'" />
                            <table-th :sort="true" :tkey="'phone'" :title="'phone'" />
                            <table-th :sort="true" :tkey="'date'" :title="'date'" />
                            <table-th :sort="true" :tkey="'start_time'" :title="'start time'" />
                            <table-th :sort="true" :tkey="'end_time'" :title="'end time'" />
                            <th aria-label="actions">Present</th>
                            <th aria-label="actions">Reset</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr v-for="(item, index) in this[`get_${store_prefix}s`]" :key="item.id">
                            
                            <td>
                                <span class="text-primary cursor_pointer">
                                    #{{ index+1 }}
                                </span>
                            </td>
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
                                    {{ new Date(item.date).toDateString()  }}
                                </span>
                            </td>

                            <td>
                                <span v-if="item.start_time">{{ item.start_time }}</span>
                                <span v-else>
                                    <input class="form-control" type="time" @change="add_start_time(item, $event)">
                                </span>
                            </td>

                            <td>
                                <span v-if="item.end_time">{{ item.end_time }}</span>
                                <span v-else>
                                    <input class="form-control" type="time" @change="add_end_time(item, $event)">
                                </span>
                            </td>
                    
                            <td>
                                <span class="badge bg-success" v-if="item.present == 1">Present</span>
                                <span class="badge bg-danger" v-else>Absent</span>
                                    <!-- <input class="form-check-input switch_button" v-if="item.present == 1" checked @change="process_attendence(item, $event)" type="checkbox" role="switch" :id="`SwitchPresent${item.id}`">
                                    <input class="form-check-input switch_button" v-else @change="process_attendence(item, $event)" type="checkbox" role="switch" :id="`SwitchPresent${item.id}`">
                                    <label class="form-check-label" :for="`SwitchPresent${item.id}`">Present</label> -->
                            </td>
                            <td>
                                <button class="btn btn-primary" @click="ResetAttendence(item)">Reset</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="card-footer py-1 border-top-0">
                <div class="d-inline-block">
                    <pagination :data="this[`get_${store_prefix}s`]" :limit="5" :size="'small'" :show-disabled="true" :align="'left'"
                        @pagination-change-page="handle_pagination">
                        <span slot="prev-nav"><i class="fa fa-angle-left"></i> Previous</span>
                        <span slot="next-nav">Next <i class="fa fa-angle-right"></i></span>
                    </pagination>
                </div>
                <div class="show-limit d-inline-block">
                    <span>Limit:</span>
                    <select @change.prevent="call_store(`set_${store_prefix}_paginate`,$event.target.value)">
                        <option v-for="i in [10,5,25,50,100]" :key="i" :value="i">
                            {{ i }}
                        </option>
                    </select>
                </div>
                <div class="show-limit d-inline-block">
                    <span>Total:</span>
                    <span>{{ this[`get_${store_prefix}s`].total }}</span>
                </div>
            </div> -->
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
            attendence_date: '',
            start_time: null,
            end_time: null
        }
    },
    created: function(){
        
    },
    methods: {
        ...mapActions([
            `fetch_${store_prefix}s`,
            `soft_delete_${store_prefix}`,
            `delete_${store_prefix}`,
            `restore_${store_prefix}`,
            `export_${store_prefix}_all`,
            `export_selected_${store_prefix}_csv`,
            `employee_attendence_submit`,
            `employee_attendence_update`
        ]),
        ...mapMutations([
            `set_${store_prefix}_paginate`,
            `set_${store_prefix}_page`,
            `set_${store_prefix}_search_key`,
            `set_${store_prefix}_orderByCol`,
            `set_${store_prefix}_show_active_data`,
            `set_${store_prefix}`,
            `set_selected_${store_prefix}s`,
            `set_select_all_${store_prefix}s`,
            `set_clear_selected_${store_prefix}s`,
            `set_${store_prefix}_show_selected`,
        ]),
        add_start_time: function(employee, event) {
            this.start_time = event.target.value;
            this.process_attendence(employee, event);
        },
        add_end_time: function(employee, event) {
            this.end_time = event.target.value;

            let data = {
                employee_id: employee.id,
                end_time: this.end_time,
                attendence_date: this.attendence_date
            }
            if(employee.start_time != null) {
                console.log(employee.start_time);
                event.target.checked = false;
                window.s_alert('Attendence start time is required', 'error');
            }
            this.employee_attendence_update(data)
            this[`fetch_${store_prefix}s`](this.attendence_date);

            this.start_time = null;
            this.end_time = null;
        },

        ResetAttendence: async function(employee) {
            let confirm = await window.s_confirm("Do you want to reset Attendence?");
            if(confirm) {
                if(this.attendence_date == null) {
                    window.s_alert('Attendence date is required', 'error');
                }
                else if(employee.start_time == null && this.start_time == null) {
                    window.s_alert('Attendence start time is required', 'error');
                }
                else {
                    let data = {
                        employee_id: employee.id,
                        attendence_date: this.attendence_date,
                        start_time: this.start_time,
                        end_time: this.end_time,
                        present: 0,
                    }
                    this.employee_attendence_submit(data)
    
                    this[`fetch_${store_prefix}s`](this.attendence_date);
                    this.start_time = null;
                    this.end_time = null;
                
                    // event.target.checked = false;
                }
            }
        },
        process_attendence(employee, event) {
            if(this.attendence_date == null) {
                event.target.checked = false;
                window.s_alert('Attendence date is required', 'error');
            }
            if(employee.start_time == null && this.start_time == null) {
                
                event.target.checked = false;
                window.s_alert('Attendence start time is required', 'error');
            }
            else {
                let data = {
                    employee_id: employee.id,
                    attendence_date: this.attendence_date,
                    start_time: this.start_time,
                    end_time: this.end_time,
                    present: 1,
                }
                this.employee_attendence_submit(data)

                this[`fetch_${store_prefix}s`](this.attendence_date);
                this.start_time = null;
                this.end_time = null;
            
                // event.target.checked = false;
            }
        },
        get_attendence_employee: function() {
            console.log(this.attendence_date);
            this[`fetch_${store_prefix}s`](this.attendence_date);

            [...document.querySelectorAll('.switch_button')].forEach(element => {
                element.checked = false;
            })
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
        ]),
    }
}
</script>

<style>

</style>
