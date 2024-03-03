<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Details</h4>
                <div class="btns">
                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <div class="card-body pb-5 ">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center mb-2">
                            <img :src="'/'+this[`get_${store_prefix}`].photo" width="80px" alt="">
                        </div>
                        <table v-if="this[`get_${store_prefix}`]" class="table table-bordered details_table">
                            
                            <tr>
                                <td>id</td>
                                <td>{{ this[`get_${store_prefix}`].id }}</td>
                            </tr>
                            
                            <tr v-if="this[`get_${store_prefix}`]">
                                <td>Name</td>
                                <td>{{ this[`get_${store_prefix}`].first_name }} {{ this[`get_${store_prefix}`].last_name }}</td>
                            </tr>

                            <tr v-if="this[`get_${store_prefix}`]">
                                <td>Branch Code</td>
                                <td>{{ this[`get_${store_prefix}`].branch_code }}</td>
                            </tr>

                            <tr v-if="this[`get_${store_prefix}`]">
                                <td>Mobile Number</td>
                                <td>{{ this[`get_${store_prefix}`].mobile_number }}</td>
                            </tr>

                            <tr v-if="this[`get_${store_prefix}`]">
                                <td>Email</td>
                                <td>{{ this[`get_${store_prefix}`].email }}</td>
                            </tr>

                            <tr v-if="this[`get_${store_prefix}`]">
                                <td>Address</td>
                                <td>{{ this[`get_${store_prefix}`].address }}</td>
                            </tr>
                            
                            <tr>
                                <td>created at </td>
                                <td>
                                    {{ new Date(this[`get_${store_prefix}`].created_at).toDateString() }}, &nbsp;
                                    {{ new Date(this[`get_${store_prefix}`].created_at).toLocaleTimeString()  }}
                                </td>
                            </tr>
                            <tr>
                                <td>updated at </td>
                                <td>
                                    {{ new Date(this[`get_${store_prefix}`].updated_at).toDateString() }}, &nbsp;
                                    {{ new Date(this[`get_${store_prefix}`].updated_at).toLocaleTimeString()  }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <permission-button
                    :permission="'can_edit'"
                    :to="{name:`Edit${route_prefix}`,params:{id:$route.params.id}}"
                    :classList="'btn btn-outline-info'">
                    <i class="fa text-info fa-pencil"></i> &nbsp;
                    Edit
                </permission-button>
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
    },
    computed: {
        ...mapGetters([`get_${store_prefix}`])
    }
}
</script>

<style>

</style>
