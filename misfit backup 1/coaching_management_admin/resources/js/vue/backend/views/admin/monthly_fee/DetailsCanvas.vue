<template>
    <div class="canvas_backdrop" :class="{active:this[`get_${store_prefix}`]}" @click="$event.target.classList.contains('canvas_backdrop') && call_store(`set_${store_prefix}`,null)">
        <div class="content right" v-if="this[`get_${store_prefix}`]">
            <div class="content_header">
                <h3 class="offcanvas-title">Details</h3>
                <i @click="call_store(`set_${store_prefix}`,null)" class="fa fa-times"></i>
            </div>
            <div class="cotent_body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td>:</td>
                            <td>{{ this[`get_${store_prefix}`].id }}</td>
                        </tr>
                        <tr>
                            <td>Student</td>
                            <td>:</td>
                            <td v-if="this[`get_${store_prefix}`].student">{{ this[`get_${store_prefix}`].student.user.first_name }} {{ this[`get_${store_prefix}`].student.user.last_name }}</td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td>:</td>
                            <td>{{ this[`get_${store_prefix}`].amount }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td>{{ this[`get_${store_prefix}`].date }}</td>
                        </tr>
                        
                        <tr>
                            <td>Created at</td>
                            <td>:</td>
                            <td>
                                {{ new Date(this[`get_${store_prefix}`].created_at).toDateString()  }}, &nbsp;
                                {{ new Date(this[`get_${store_prefix}`].created_at).toLocaleTimeString()  }}
                            </td>
                        </tr>

                        <tr>
                            <td>Updated at</td>
                            <td>:</td>
                            <td>
                                {{ new Date(this[`get_${store_prefix}`].updated_at).toDateString()  }}, &nbsp;
                                {{ new Date(this[`get_${store_prefix}`].updated_at).toLocaleTimeString()  }}
                            </td>
                        </tr>
                    
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex'
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
    methods: {
        ...mapMutations([`set_${store_prefix}`]),
        ...mapActions([`order_${store_prefix}`]),
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
