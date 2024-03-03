<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Site logo</h4>
                <div class="btns">
                    <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span >
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <form @submit.prevent="call_store(`update_site_logo`,$event.target)" class="logo_update" autocomplete="false">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1" v-if="this[`get_site_logo`]">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Site logo`"
                                        :name="`logo`"
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
            route_prefix,
        }
    },
    created: function () {
        // this[`fetch_${store_prefix}`]({id: this.$route.params.id});
        this.fetch_site_logo();
    },
    methods: {
        ...mapActions([
            `update_site_logo`,
            `fetch_site_logo`,
        ]),
        ...mapMutations([
            `set_site_logo`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([`get_site_logo`])
    }
};
</script>

<style>
</style>
