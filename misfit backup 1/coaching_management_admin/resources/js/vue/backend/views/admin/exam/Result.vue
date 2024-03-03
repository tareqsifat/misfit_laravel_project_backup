<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <h3>
                    Result of {{ get_exam_students.exam_title }}
                </h3>
                
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
                                <a href="" @click.prevent="export_exam_student_all()">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Export All
                                </a>
                            </li>
                            <!-- <li v-if="this[`get_${store_prefix}_selected`].length">
                                <a href="" @click.prevent="call_store(`export_selected_${store_prefix}_csv`)">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Export Selected
                                </a>
                            </li> -->
                            <li>
                                <router-link :to="{name:`Import${route_prefix}`}">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Import
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive card-body text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <!-- <th><input @click="call_store(`set_select_all_${store_prefix}s`)" type="checkbox" class="form-check-input check_all"></th> -->
                            <table-th :sort="true" :tkey="'student'" :title="'Student'" />
                            <table-th :sort="true" :tkey="'result'" :title="'Result'" />
                        </tr>
                    </thead>
                    <!-- {{ get_exam_students.data }} -->
                    <tbody class="table-border-bottom-0" v-if="get_exam_students.batch && get_exam_students.batch.institute_students">
                        <tr v-for="(item, index) in get_exam_students.batch.institute_students" :key="index">

                            <!-- <td>
                                <input v-if="check_if_data_is_selected(item)" :data-id="item.id" checked @change="call_store(`set_selected_${store_prefix}s`,item)" type="checkbox" class="form-check-input">
                                <input v-else @change="call_store(`set_selected_${store_prefix}s`,item)" type="checkbox" class="form-check-input">
                            </td> -->
                            
                            <td>
                                <span class="text-warning cursor_pointer">
                                    {{ item.user.first_name }} {{ item.user.last_name }}
                                </span>
                            </td>

                            <td>
                                <input type="number" :value="item.user.mark" id="mark" @keydown="submit_result($event, item)" class="form-control">
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

function debounce(fn, wait){
    let timer;
    return function(...args){
        if(timer) {
            clearTimeout(timer); // clear any pre-existing timer
        }
        const context = this; // get the current context
        timer = setTimeout(()=>{
            fn.apply(context, args); // call the function if time expires
        }, wait);
    }
}
export default {
    components: { PermissionButton, TableTh, DetailsCanvas, SelectedCanvas },
    data: function(){
        return {
            store_prefix,
            route_prefix,
            mark: ''
        }
    },
    created: function(){
        this.fetch_exam_students(this.$route.params.id);
    },
    methods: {
        ...mapActions([
            `fetch_exam_students`,
            `export_${store_prefix}_all`,
            `export_selected_${store_prefix}_csv`,
            `submit_exam_result`,
            `export_exam_student_all`
        ]),
        ...mapMutations([
            // `set_${store_prefix}_paginate`,
            // `set_${store_prefix}_page`,
            // `set_${store_prefix}_search_key`,
            // `set_${store_prefix}_orderByCol`,
            // `set_${store_prefix}_show_active_data`,
            // `set_${store_prefix}`,
            // `set_selected_${store_prefix}s`,
            // `set_select_all_${store_prefix}s`,
            // `set_clear_selected_${store_prefix}s`,
        ]),

        submit_result :debounce(function($event, student) {
            let event = $event;

            let params = {
                exam_id: this.$route.params.id,
                mark: event.target.valueAsNumber,
                user_id: student.user.id
            }

            this.submit_exam_result(params)

        }, 500),
        
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
            `get_exam_students`
        ]),
    }
}
</script>

<style>

</style>

