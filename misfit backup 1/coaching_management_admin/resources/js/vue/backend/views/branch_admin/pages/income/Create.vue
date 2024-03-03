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
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" class="income_create_form" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select Account Category
                                        </label>
                                        <account-category-management-modal :select_qty="1"></account-category-management-modal>
                                    </div>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <input-field
                                        :label="`Amount`"
                                        :name="`amount`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <input-field
                                        :label="`Date`"
                                        :name="`date`"
                                        :type="`date`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
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
import { mapActions, mapGetters } from 'vuex'
import InputField from '../../../components/InputField.vue'
import AccountCategoryManagementModal from "../account_category/components/ManagementModal.vue"

/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField, AccountCategoryManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {
        this.fetch_all_account_categories()
    },
    methods: {
        ...mapActions([
            `store_${store_prefix}`,
            'fetch_all_account_categories'
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_all_account_categories`,
        ]),
    }
};
</script>

<style>
</style>
