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
            <form @submit.prevent="call_store(`update_${store_prefix}`,$event.target)" class="edit_leave_form" autocomplete="false">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select User
                                        </label>
                                        <employee-management-modal :select_qty="1"></employee-management-modal>
                                    </div>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <!-- <input-field
                                        :label="`Reason`"
                                        :name="`reason`"
                                    /> -->
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Reason
                                        </label>
                                        <textarea name="reason" id="reason" class="form-control" :value="this[`get_${store_prefix}`]['reason']"></textarea>
                                    </div>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`From date`"
                                        :name="`from_date`"
                                        :type="`date`"
                                        :value="this[`get_${store_prefix}`]['from_date']"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`To date`"
                                        :name="`to_date`"
                                        :type="`date`"
                                        :value="this[`get_${store_prefix}`]['to_date']"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Duration`"
                                        :name="`duration`"
                                        :type="`number`"
                                        :value="this[`get_${store_prefix}`]['duration']"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Status
                                        </label>
                                        <select name="status" class="form-select" :value="this[`get_${store_prefix}`]['status']" id="form-select">
                                            <option value="pending">Pending</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                    </div>
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
import EmployeeManagementModal from "../employee/components/ManagementModal.vue"
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;
export default {
    components: { InputField, EmployeeManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
        }
    },
    created: async function () {
        await this[`set_clear_selected_employees`](false);
        this[`fetch_${store_prefix}`]({id: this.$route.params.id});
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_${store_prefix}`,
            `set_clear_selected_employees`
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
