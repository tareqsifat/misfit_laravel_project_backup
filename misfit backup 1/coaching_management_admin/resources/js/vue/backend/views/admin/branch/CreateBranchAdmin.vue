<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Create Branch Admin</h4>
                <div class="btns">
                    <router-link :to="{ name: `${route_prefix}Admin` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="submit_branch_admin($event.target)" autocomplete="false" class="create_branch_admin" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`First Name`"
                                        :name="`first_name`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Last Name`"
                                        :name="`last_name`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Mobile Number`"
                                        :name="`mobile_number`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Email`"
                                        :name="`email`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Address`"
                                        :name="`address`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Password`"
                                        :name="`password`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Confirm Password`"
                                        :name="`password_confirmation`"
                                    />
                                </div>

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
import { mapActions, mapGetters } from 'vuex'
import InputField from '../../components/InputField.vue'
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
        // this.fetch_batchs();
    },
    methods: {
        ...mapActions([
            `create_${store_prefix}_admin`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
        submit_branch_admin: function(event) {
            let branch_id = this.$route.params.id;
            this[`create_${store_prefix}_admin`](branch_id);
        }
    },
    computed: {
        ...mapGetters([
        ])
    }
};
</script>

<style>
</style>
