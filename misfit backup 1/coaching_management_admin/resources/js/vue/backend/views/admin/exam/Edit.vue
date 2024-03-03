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
                                        Select class
                                    </label>
                                    <class-management-modal :select_qty="1"></class-management-modal>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <!-- <input-field
                                        :label="`Name`"
                                        :name="`title`"
                                        :value="this[`get_${store_prefix}`]['title']"
                                    /> -->
                                    <label class="mb-2 text-capitalize">
                                        Select batch
                                    </label>
                                    <batch-management-modal :select_qty="1"></batch-management-modal>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    
                                    <label class="mb-2 text-capitalize">
                                        Select subject
                                    </label>
                                    <subject-management-modal :select_qty="1"></subject-management-modal>
                                </div>
                                
                                <input-field
                                    :label="`Exam title`"
                                    :name="`exam_title`"
                                    :value="this[`get_${store_prefix}`]['exam_title']"
                                />
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
                        update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import InputField from '../../../components/InputField.vue'
import ClassManagementModal from "../class/components/ManagementModal.vue"
import BatchManagementModal from "../batch/components/ManagementModal.vue"
import SubjectManagementModal from "../subject/components/ManagementModal.vue"
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;
export default {
    components: { InputField, ClassManagementModal, SubjectManagementModal, BatchManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
        }
    },
    created: function () {
        this[`set_clear_selected_class_levels`](false);
        this[`set_clear_selected_batchs`](false);
        this[`set_clear_selected_subjects`](false);
        this[`fetch_${store_prefix}`]({id: this.$route.params.id});
    },
    methods: {
        ...mapActions([
            `update_${store_prefix}`,
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_clear_selected_class_levels`,
            `set_clear_selected_batchs`,
            `set_clear_selected_subjects`,
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
