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
            <form @submit.prevent="call_store(`update_${store_prefix}`,$event.target)" class="call_history_edit_form" autocomplete="false">
                <div class="card-body" v-if="this[`get_${store_prefix}`]">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <!-- <input-field
                                        :label="`Name`"
                                        :name="`title`"
                                        :value="this[`get_${store_prefix}`]['title']"
                                    /> -->
                                    <label class="mb-2 text-capitalize">
                                        Select customer
                                    </label>
                                    <customer-management-modal :select_qty="1"></customer-management-modal>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <!-- <input-field
                                        :label="`Name`"
                                        :name="`title`"
                                        :value="this[`get_${store_prefix}`]['title']"
                                    /> -->
                                    <label class="mb-2 text-capitalize">
                                        Select topic
                                    </label>
                                    <topic-management-modal :select_qty="1"></topic-management-modal>
                                </div>
                                
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <label for="description">Description</label>
                                    <textarea rows="4" class="form-control" :value="this[`get_${store_prefix}`]['description']" id="description" name="description"></textarea>
                                </div>
                                
                                
                                <!-- <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Password`"
                                        :name="`user_password`"
                                        :value="this[`get_${store_prefix}`]['user']['password']"
                                    />
                                </div> -->
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
            route_prefix,
        }
    },
    created: function () {
        this[`set_clear_selected_topics`](false);
        this[`set_clear_selected_customers`](false);
        this[`fetch_${store_prefix}`]({id: this.$route.params.id});
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_clear_selected_topics`,
            `set_clear_selected_customers`,
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
