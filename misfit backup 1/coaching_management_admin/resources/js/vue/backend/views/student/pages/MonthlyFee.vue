<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <h3>
                    Results
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
                            <!-- <li>
                                <router-link :to="{name:`Import${route_prefix}`}">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Import
                                </router-link>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive card-body text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Student</th>
                            <th>Month</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <!-- {{ get_exam_students.data }} -->
                    <tbody class="table-border-bottom-0">
                        <tr v-for="(item, index) in get_single_student_monthly_fees" :key="index">
                            <td>
                                <span class="text-warning cursor_pointer">
                                    {{ item.student.user.first_name }} {{ item.student.user.last_name }}
                                </span>
                            </td>
                            
                            <td>
                                {{ get_month_name(item.date) }}
                            </td>
                            
                            <td>
                                {{ item.amount }}
                            </td>
                            <td>
                                {{ item.date }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';
// import DetailsCanvas from './DetailsCanvas.vue';
// import SelectedCanvas from './SelectedCanvas.vue';



export default {
    components: { },
    data: function(){
        return {
            mark: ''
        }
    },
    created: function(){
        // console.log(this.$store);
        this.fetch_single_student_monthly_fees();
    },
    methods: {
        ...mapActions([
            `fetch_single_student_monthly_fees`,
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
        get_month_name: function(date) {
            const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            const d = new Date(date);
            return month[d.getMonth()];
        }
        // submit_result :debounce(function($event, student) {
        //     let event = $event;

        //     let params = {
        //         exam_id: this.$route.params.id,
        //         mark: event.target.valueAsNumber,
        //         user_id: student.user.id
        //     }

        //     this.submit_exam_result(params)

        // }, 500),
        
       
    },
    computed: {
        ...mapGetters([
            `get_single_student_monthly_fees`,
        ]),
    }
}
</script>

<style>

</style>

