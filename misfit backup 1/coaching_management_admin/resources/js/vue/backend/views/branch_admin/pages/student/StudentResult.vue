<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <h3>
                    Results
                </h3>
                
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
                            <table-th :sort="false" :tkey="'batch_id'" :title="'Batch'" />
                            <table-th :sort="false" :tkey="'institute_class_batch_exam_id'" :title="'Exam'" />
                            <table-th :sort="false" :tkey="'subject'" :title="'Subject'" />
                            <table-th :sort="false" :tkey="'mark'" :title="'Result'" />
                        </tr>
                    </thead>
                    <!-- {{ get_exam_students.data }} -->
                    <tbody class="table-border-bottom-0">
                        <tr v-for="(item, index) in get_single_student_result" :key="index">
                            <td>
                                {{ item.exam_batch.name }}
                            </td>
                            <td>
                                {{ item.exam.exam_title }}
                            </td>
                            <td>
                                <span class="text-warning cursor_pointer">
                                    {{ item.exam.subject.title }}
                                </span>
                            </td>

                            <td>
                                {{ item.mark }}
                                <!-- <input type="number" :value="item.user.mark" id="mark" @keydown="submit_result($event, item)" class="form-control"> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
        this.fetch_single_student_results_by_id({id: this.$route.params.id});
    },
    methods: {
        ...mapActions([
            `fetch_single_student_results_by_id`,
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
            `get_single_student_result`
        ])
    }
};
</script>

<style>
</style>
