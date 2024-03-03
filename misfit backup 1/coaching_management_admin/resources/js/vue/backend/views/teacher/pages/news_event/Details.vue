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
                    <div class="col-lg-7 ">
                        <table v-if="this[`get_${store_prefix}`]" class="table table-bordered details_table">
                            <tr>
                                <td colspan="2" class="text-center">
                                    <img :src="this[`get_${store_prefix}`].image" height="200" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>id</td>
                                <td>{{ this[`get_${store_prefix}`].id }}</td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ this[`get_${store_prefix}`].title }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ this[`get_${store_prefix}`].description }}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>
                                    {{ new Date(this[`get_${store_prefix}`].created_at).toDateString()  }}, &nbsp;
                                    {{ new Date(this[`get_${store_prefix}`].created_at).toLocaleTimeString()  }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
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
