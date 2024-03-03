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
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" class="exam_create_form" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select Class and Batch
                                        </label>
                                        <batch-management-modal :select_qty="1"></batch-management-modal>
                                    </div>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select subject
                                        </label>
                                        <select name="subject_id" id="defaultSelect" class="form-select">
                                            <option value="">Select a subject</option>
                                            <option
                                            v-for="(item, index) in get_batch_subjects.subjects"
                                            :key="index"
                                            :value="item.id"
                                            >{{ item.title }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <input-field
                                        :label="`Exam title`"
                                        :name="`exam_title`"
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
import { mapActions, mapMutations, mapGetters } from 'vuex'
import InputField from '../../../components/InputField.vue'
import BatchManagementModal from "../batch/components/ManagementModal.vue"
import SubjectManagementModal from "../subject/components/ManagementModal.vue"
import ClassManagementModal from "../class/components/ManagementModal.vue"
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField, BatchManagementModal, ClassManagementModal, SubjectManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {
        this[`set_clear_selected_batchs`](false);
    },
    methods: {
        ...mapActions([`store_${store_prefix}`]),
        ...mapMutations([
            `set_clear_selected_class_levels`,
            `set_clear_selected_batchs`,
            `set_clear_selected_subjects`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([`get_batch_subjects`])
    }
};
</script>

<style>
</style>
