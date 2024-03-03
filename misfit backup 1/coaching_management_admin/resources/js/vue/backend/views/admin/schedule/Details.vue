<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Details</h4>
                <div class="btns">
                    <a href="" @click.prevent="$router.push({ name: `All${route_prefix}s` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <div class="card-body pb-5 ">
                <div class="row justify-content-center">
                    <div class="col-lg-7 ">
                        <table v-if="this[`get_${store_prefix}`]" class="table table-bordered details_table">
                            <tr>
                                <td>id</td>
                                <td>{{ this[`get_${store_prefix}`].id }}</td>
                            </tr>
                            <tr>
                                <td>Batch name</td>
                                <td>{{ this[`get_${store_prefix}`].batch.name }}</td>
                            </tr>
                            <tr>
                                <td>Class</td>
                                <td>{{ this[`get_${store_prefix}`].class.title }}</td>
                            </tr>
                            <tr>
                                <td>Subject</td>
                                <td>{{ this[`get_${store_prefix}`].subject.title }}</td>
                            </tr>
                            <tr>
                                <td>Day</td>
                                <td>{{ this[`get_${store_prefix}`].day }}</td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>{{ this[`get_${store_prefix}`].time }}</td>
                            </tr>
                            <tr>
                                <td>Room no</td>
                                <td>{{ this[`get_${store_prefix}`].room }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="card-footer text-center">
                <permission-button
                    :permission="'can_edit'"
                    :to="{name:`Edit${route_prefix}`,params:{id:$route.params.id}}"
                    :classList="'btn btn-outline-info'">
                    <i class="fa text-info fa-pencil"></i> &nbsp;
                    Edit
                </permission-button>
            </div> -->
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import PermissionButton from '../../components/PermissionButton.vue'
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
    },
    computed: {
        ...mapGetters([`get_${store_prefix}`])
    }
}
</script>

<style>

</style>
