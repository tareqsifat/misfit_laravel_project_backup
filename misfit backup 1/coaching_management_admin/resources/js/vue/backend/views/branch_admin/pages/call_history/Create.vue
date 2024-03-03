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
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" class="call_history_create_form" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select customer
                                        </label>
                                        <customer-management-modal :select_qty="1"></customer-management-modal>
                                    </div>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select topic
                                        </label>
                                        <topic-management-modal :select_qty="1"></topic-management-modal>
                                    </div>
                                </div>
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Feedback`"
                                        :name="`feedback`"
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
import { mapActions, mapMutations } from 'vuex'
import InputField from '../../../components/InputField.vue'
import TopicManagementModal from "../topic/components/ManagementModal.vue"
import CustomerManagementModal from "../customer/components/ManagementModal.vue"
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField, TopicManagementModal, CustomerManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {
        this[`set_clear_selected_topics`](false);
        this[`set_clear_selected_customers`](false);
    },
    methods: {
        ...mapActions([`store_${store_prefix}`]),
        ...mapMutations([
            `set_clear_selected_topics`,
            `set_clear_selected_customers`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
};
</script>

<style>
</style>
