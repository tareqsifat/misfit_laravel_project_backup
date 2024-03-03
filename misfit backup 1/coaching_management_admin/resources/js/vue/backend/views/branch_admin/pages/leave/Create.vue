<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Create</h4>
                <div class="btns">
                    <router-link :to="{ name: `All${route_prefix}` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" class="leave_creation_form" autocomplete="false" enctype="multipart/form-data">
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
                                        <textarea name="reason" id="reason" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`From date`"
                                        :name="`from_date`"
                                        :type="`date`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`To date`"
                                        :name="`to_date`"
                                        :type="`date`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Duration`"
                                        :name="`duration`"
                                        :type="`number`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Status
                                        </label>
                                        <select name="status" class="form-select" id="form-select">
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
import { mapActions } from 'vuex'
import InputField from '../../../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
import EmployeeManagementModal from "../employee/components/ManagementModal.vue"
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField, EmployeeManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {},
    methods: {
        ...mapActions([`store_${store_prefix}`]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
};
</script>

<style>
</style>
