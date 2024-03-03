<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <h4>
                    All
                    <!-- <small v-if="this[`get_${store_prefix}_selected`].length">
                        &nbsp; selected:
                        <b class="text-warning">
                            {{ this[`get_${store_prefix}_selected`].length }}
                        </b>
                        &nbsp;
                        <b @click="call_store(`set_clear_selected_${store_prefix}s`, true)" class="text-danger cursor-pointer">clear</b>
                        &nbsp;
                        <b @click="call_store(`set_${store_prefix}_show_selected`,true)" class="text-success cursor-pointer">show</b>
                    </small> -->
                </h4>

                

                
                <div class="btns d-flex gap-2 align-items-center">
                    <a href="" @click.prevent="$router.back()"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <div class="table-responsive card-body text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <!-- <th><input @click="call_store(`set_select_all_${store_prefix}s`)" type="checkbox" class="form-check-input check_all"></th> -->
                            <table-th :sort="true" :tkey="'id'" :title="'ID'" :ariaLable="'id'"/>
                            <table-th :sort="false" :tkey="'name'" :title="'Name'" />
                            <table-th :sort="false" :tkey="'Present'" :title="'Present'" />
                            <table-th :sort="false" :tkey="'start_time'" :title="'Start time'" />
                            <table-th :sort="false" :tkey="'end_time'" :title="'end_time'" />
                            <table-th :sort="true" :tkey="'created_at'" :title="'Date'" />
                            <!-- <th aria-label="actions">Present</th> -->
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr v-for="(item, index) in get_single_teacher_attendence_by_id" :key="index">
                            
                            <td>{{ index+1 }}</td>
                            
                            <td>
                                <span class="text-warning cursor_pointer">
                                    {{ item.user.first_name }} {{ item.user.last_name }}
                                </span>
                            </td>

                            <td>
                                <span>{{ item.start_time }}</span>
                            </td>

                            <td>
                                <span>{{ item.end_time }}</span>
                            </td>

                            <td>
                                <span class="badge rounded-pill bg-success">Present</span>
                            </td>

                            <td>
                                <span v-if="item.date">
                                    {{ new Date(item.date).toDateString()  }},
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <details-canvas/>
        <selected-canvas/> -->
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import TableTh from './components/TableTh.vue';
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;
export default {
    components: {TableTh },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
        }
    },
    created: function () {
        // this.fetch_single_student_results_by_id({id: this.$route.params.id});
        this.fetch_single_teacher_attendence_by_id({id: this.$route.params.id});
    },
    methods: {
        ...mapActions([
            `fetch_single_teacher_attendence_by_id`,
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
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_exam_students`,
            `get_single_teacher_attendence_by_id`
        ])
    }
};
</script>

<style>
</style>
