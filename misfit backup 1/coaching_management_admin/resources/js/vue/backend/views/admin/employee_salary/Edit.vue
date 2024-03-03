<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Edit</h4>
                <div class="btns">
                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <form @submit.prevent="call_store(`update_${store_prefix}`,$event.target)" autocomplete="false">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1" v-if="this[`get_${store_prefix}`]">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <label for="">Select User</label>
                                    
                                    <select class="form-select" name="user_id" :value="this[`get_${store_prefix}`]['user_id']" id="user_id">
                                        <option 
                                        v-for="item in get_active_employees" 
                                        :value="item.id"
                                        :key="item.id" 
                                        >{{ item.first_name }} {{ item.last_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Salary amount`"
                                        :name="`salary_amount`"
                                        :value="this[`get_${store_prefix}`]['salary_amount']"
                                    />
                                </div>

                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Date`"
                                        :name="`date`"
                                        :value="this[`get_${store_prefix}`]['date']"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-outline-info" >
                        <i class="fa fa-upload"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import InputField from '../../../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;
export default {
    components: { InputField },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {
        this[`fetch_${store_prefix}`]({id: this.$route.params.id});
        this.fetch_active_employees();
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            `fetch_${store_prefix}`,
            `fetch_active_employees`
        ]),
        ...mapMutations([
            `set_${store_prefix}`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}`,
            `get_active_employees`
        ])
    }
};
</script>

<style>
</style>
