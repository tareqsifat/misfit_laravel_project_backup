<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header no_print">
                <h4>Details</h4>
                <div class="btns">
                    <a href="javascript:void(0)" @click.prevent="print_monthly_payment()"  class="btn rounded-pill btn-outline-success me-2">

                        <i class="fa fa-print ms-5px"></i>
                        <span >
                            Print
                        </span>
                    </a>
                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                        
                    </a>
                    
                </div>
            </div>
            <div class="card-body pb-5" id="print_section">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">From:</h5>
                                <h3 class="text-dark mb-1" v-if="this[`get_${store_prefix}`].student">{{ this[`get_${store_prefix}`].student.user.first_name }} {{ this[`get_${store_prefix}`].student.user.last_name }}</h3>
                                <div v-if="this[`get_${store_prefix}`].student">Addres: {{ this[`get_${store_prefix}`].student.user.address }}, </div>
                                <div v-if="this[`get_${store_prefix}`].student">Email: {{ this[`get_${store_prefix}`].student.user.email }}</div>
                                <div v-if="this[`get_${store_prefix}`].student">Phone: {{ this[`get_${store_prefix}`].student.user.mobile_number }}</div>
                            </div>
                            <div class="col-sm-6" v-if="this[`get_${store_prefix}`]">
                                <h5 class="mb-3">To:</h5>
                                <h3 class="text-dark mb-1">
                                    {{ get_auth_information.first_name }} {{ get_auth_information.last_name }}
                                </h3>
                                <div>Address: {{ get_auth_information.address }}</div>
                                <div>Email: {{ get_auth_information.email }}</div>
                                <div>Phone: {{ get_auth_information.mobile_number }}</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm" v-if="this[`get_${store_prefix}`]">
                            <table class="table table-striped">
                                <thead class="t_heading">
                                    <tr>
                                        <th class="center">#</th>
                                        <th>item</th>
                                        <th class="right">Amount</th>
                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="single_row_table">

                                        <td class="center">#</td>
                                        <td class="left strong" v-if="this[`get_${store_prefix}`].account_log">{{ this[`get_${store_prefix}`].account_log.category.title }}</td>
                                        <td class="right">{{ this[`get_${store_prefix}`].amount }}</td>
                                        <td class="center">1</td>
                                        <td class="right">{{ this[`get_${store_prefix}`].amount }}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-4 col-sm-5"></div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">{{ this[`get_${store_prefix}`].amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <!-- <permission-button
                    :permission="'can_edit'"
                    :to="{name:`Edit${route_prefix}`,params:{id:$route.params.id}}"
                    :classList="'btn btn-outline-info'">
                    <i class="fa text-info fa-pencil"></i> &nbsp;
                    Edit
                </permission-button> -->
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import PermissionButton from '../../../components/PermissionButton.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { PermissionButton },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
        }
    },
    created: function () {
        this[`fetch_${store_prefix}`]({id: this.$route.params.id, select_all:1})
    },
    methods: {
        ...mapActions([
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_${store_prefix}`
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
        print_monthly_payment() {
            window.print();
        }
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}`,
            'get_auth_information'
        ])
    }
}
</script>

<style>

</style>
