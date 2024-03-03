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
            <form v-if="this[`get_${store_prefix}`]" @submit.prevent="call_store(`update_${store_prefix}`,$event.target)" autocomplete="false">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1" v-if="this[`get_${store_prefix}`]['teacher']">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`First Name`"
                                        :name="`user_first_name`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['first_name']"
                                    />
                                </div>
                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Last Name`"
                                        :name="`user_last_name`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['last_name']"
                                    />
                                </div>

                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Mobile Number`"
                                        :name="`mobile_number`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['mobile_number']"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Designation`"
                                        :name="`designation`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['designation']"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Salary`"
                                        :name="`salary`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['salary']"
                                    />
                                </div>

                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Email`"
                                        :name="`user_email`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['email']"
                                    />
                                </div>


                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Address`"
                                        :name="`user_address`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['address']"
                                    />
                                </div>

                                    
                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <input-field
                                        :label="`Education`"
                                        :name="`education`"
                                        :value="this[`get_${store_prefix}`]['teacher']['education']"
                                    />
                                </div>


                                <div class="form-group d-grid align-content-start gap-1 mb-2">
                                    <label for="hire_date" class="text-capitalize d-block">
                                        <span class="mb-2 d-block">
                                            Hire Date
                                        </span> 
                                        <input :value="this[`get_${store_prefix}`]['teacher']['hire_date']" type="date" id="hire_date" name="hire_date" class=" form-control"> 
                                    </label>
                                </div>

                                <div class="form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Total Monthly attendence`"
                                        :name="`total_monthly_attendance`"
                                        :type="`number`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['total_monthly_attendance']"
                                    />
                                </div>
                                
                                <!-- <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Password`"
                                        :name="`user_password`"
                                        :value="this[`get_${store_prefix}`]['teacher']['user']['password']"
                                    />
                                </div> -->

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`photo`"
                                        :name="`photo`"
                                        :type="`file`"
                                        :accept="`image/*`"
                                        :multiple="false"
                                        :preview="true"
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
            route_prefix,
        }
    },
    created: async function () {
        await this[`fetch_${store_prefix}`]({id: this.$route.params.id});
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_${store_prefix}`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([`get_${store_prefix}`])
    }
};
</script>

<style>
</style>
