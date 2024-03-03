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
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <label for="user">Select user</label>
                                    <select class="form-select" name="users" id="user">
                                        <option v-for="item in get_all_users" :key="item.id" :value="item.id">{{ item.first_name }} {{ item.last_name }}</option>
                                    </select>
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <input-field
                                        :label="`Title`"
                                        :name="`title`"
                                    />
                                </div>

                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="10" rows="3"></textarea>
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
        this.fetch_all_users();
    },
    methods: {
        ...mapActions([
            `store_${store_prefix}`,
            `fetch_all_users`
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}`,
            `get_all_users`
        ])
    }
};
</script>

<style>
</style>
